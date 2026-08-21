<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bill_id = intval($_POST['bill_id']);
    $customer_name = trim($_POST['customer_name']);
    $customer_phone = trim($_POST['customer_phone']);
    $payment_mode = trim($_POST['payment_mode']);
    $discount = floatval($_POST['discount']);
    $total = floatval($_POST['total']);

    $service_names = $_POST['service_names'] ?? [];
    $service_prices = $_POST['service_prices'] ?? [];

    $recombined_services = [];
    for ($i = 0; $i < count($service_names); $i++) {
        $name = trim($service_names[$i]);
        $price = floatval($service_prices[$i]);
        $recombined_services[] = $name . "|" . $price;
    }
    
    $services_string = implode(",", $recombined_services);

    // If your database doesn't have a 'discount' column yet, run: 
    // ALTER TABLE bills ADD COLUMN discount DECIMAL(10,2) DEFAULT 0.00;
    $stmt = $connection->prepare("UPDATE bills SET customer_name=?, customer_phone=?, payment_mode=?, services=?, discount=?, total=? WHERE id=?");
    $stmt->bind_param("ssssddi", $customer_name, $customer_phone, $payment_mode, $services_string, $discount, $total, $bill_id);
    
    if ($stmt->execute()) {
        $stmt->close();
        // Redirect back to edit page to confirm update, or straight to view_invoice.php if preferred
        header("Location: edit_bill.php?id=" . $bill_id);
        exit();
    } else {
        echo "Error updating record: " . $connection->error;
    }
}
?>