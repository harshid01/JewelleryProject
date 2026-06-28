<?php

include '../config/db.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="orders-report.csv"');

$output = fopen('php://output', 'w');

fputcsv($output, [
    'Order Number',
    'Customer',
    'Amount',
    'Payment Method',
    'Payment Status',
    'Order Status',
    'Tracking Number',
    'Order Date'
]);

$query = mysqli_query($conn,"
SELECT
    orders.order_number,
    users.full_name,
    orders.total_amount,
    orders.payment_method,
    orders.payment_status,
    orders.order_status,
    orders.tracking_number,
    orders.order_date
FROM orders
LEFT JOIN users
ON users.id = orders.user_id
ORDER BY orders.id DESC
");

while($row = mysqli_fetch_assoc($query))
{
    fputcsv($output, [
        $row['order_number'],
        $row['full_name'],
        $row['total_amount'],
        $row['payment_method'],
        $row['payment_status'],
        $row['order_status'],
        $row['tracking_number'],
        date('d-m-Y', strtotime($row['order_date']))
    ]);
}

fclose($output);
exit();
?>