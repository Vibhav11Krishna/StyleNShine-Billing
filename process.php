<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed');
}

// Collect form data
$name    = trim($_POST['name'] ?? '');
$phone   = trim($_POST['phone'] ?? '');
$address = trim($_POST['address'] ?? '');
$payment = trim($_POST['payment'] ?? 'Cash');

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

// Prepare INSERT query
$stmt = $connection->prepare("
    INSERT INTO bills
    (customer_name, customer_address, customer_phone, services, subtotal, total, payment_mode)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");

// Bind parameters: 4 strings (name,address,phone,services) + 2 doubles (subtotal,total) + string (payment)
$stmt->bind_param(
    "ssssdds",
    $name,
    $address,
    $phone,
    $services_text,
    $subtotal,
    $total,
    $payment
);

if (!$stmt->execute()) {
    die("DB Insert Error: " . $stmt->error);
}

// Get the inserted bill ID
$id = $stmt->insert_id;
$stmt->close();

// Redirect to invoice page
header("Location: invoice.php?id=" . $id);
exit;
?>
