<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bill_id        = intval($_POST['bill_id']);
    $customer_name  = trim($_POST['customer_name']);
    $customer_phone = trim($_POST['customer_phone']);
    $bill_type      = trim($_POST['bill_type'] ?? 'Parlour');
    $payment_mode   = trim($_POST['payment_mode']);
    $discount       = floatval($_POST['discount']);
    $total          = floatval($_POST['total']);
    
    // NEW: Capture amount paid and calculate dues
    $amount_paid    = floatval($_POST['amount_paid'] ?? 0);
    $dues           = $total - $amount_paid;
    if ($dues < 0) { $dues = 0.00; } // Prevent negative dues if overpaid

    $service_names  = $_POST['service_names'] ?? [];
    $service_prices = $_POST['service_prices'] ?? [];

    $recombined_services = [];
    for ($i = 0; $i < count($service_names); $i++) {
        $name  = trim($service_names[$i]);
        $price = floatval($service_prices[$i]);
        if (!empty($name)) {
            $recombined_services[] = $name . "|" . $price;
        }
    }
    
    $services_string = implode(",", $recombined_services);

    // UPDATED: Added amount_paid and dues to the SQL update query
    $stmt = $connection->prepare("UPDATE bills SET customer_name=?, customer_phone=?, bill_type=?, payment_mode=?, services=?, discount=?, total=?, amount_paid=?, dues=? WHERE id=?");
    $stmt->bind_param("sssssddddi", $customer_name, $customer_phone, $bill_type, $payment_mode, $services_string, $discount, $total, $amount_paid, $dues, $bill_id);
    
    if ($stmt->execute()) {
        $stmt->close();

        // Redirect back to the edit page with a success flag
        header("Location: edit_bill.php?id=" . $bill_id . "&success=1");
        exit();
    } else {
        echo "Error updating record: " . $connection->error;
    }
}
?>