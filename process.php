<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed');
}

// Collect form data
$name        = trim($_POST['name'] ?? '');
$phone       = trim($_POST['phone'] ?? '');
$address     = trim($_POST['address'] ?? '');
$payment     = trim($_POST['payment'] ?? 'Cash');

// Capture whether it's a Parlour or Boutique bill from the submit buttons
$action_type = trim($_POST['action_type'] ?? 'parlour'); 
$bill_type   = ($action_type === 'boutique') ? 'Boutique Service' : 'Parlour Service';

// Collect selected services
$services = $_POST['services'] ?? [];

if (!is_array($services) || count($services) === 0) {
    die('No services selected. <a href="index.php">Back</a>');
}

$service_pairs = [];
$subtotal = 0;

foreach ($services as $s) {
    // Expected format: Label|Price
    $parts = explode('|', trim($s));
    $label = trim($parts[0] ?? '');
    $price = floatval($parts[1] ?? 0);

    if ($label === '') continue;

    // Store service as Label|Price
    $service_pairs[] = $label . "|" . number_format($price, 2, '.', '');
    $subtotal += $price;
}

// No GST
$total = round($subtotal, 2);

// Final services string
$services_text = implode(",", $service_pairs);

// Prepare INSERT query (including bill_type)
$stmt = $connection->prepare("
    INSERT INTO bills
    (customer_name, customer_address, customer_phone, services, subtotal, total, payment_mode, bill_type)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");

// Bind parameters: 4 strings (name,address,phone,services) + 2 doubles (subtotal,total) + 2 strings (payment, bill_type)
$stmt->bind_param(
    "ssssddss",
    $name,
    $address,
    $phone,
    $services_text,
    $subtotal,
    $total,
    $payment,
    $bill_type
);

if (!$stmt->execute()) {
    die("DB Insert Error: " . $stmt->error);
}

// Get the inserted bill ID
$id = $stmt->insert_id;
$stmt->close();

// Redirect to edit page so you can adjust rates or add discounts before final generation
header("Location: edit_bill.php?id=" . $id);
exit;
?>