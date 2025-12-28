<?php
// config.php
$DB_HOST = '127.0.0.1';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'salon_billing';

$connection = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($connection->connect_error) {
    die("DB Connect Error: " . $connection->connect_error);
}
$connection->set_charset('utf8mb4');
?>
