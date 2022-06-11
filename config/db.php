<?php
$conn = mysqli_connect("localhost", "root", "1234");
$query = "CREATE DATABASE IF NOT EXISTS myapp";

$run = mysqli_query($conn,$query);

if($run){
    $conn = mysqli_connect("localhost", "root", "1234", "myapp");
}

// $products = "CREATE TABLE IF NOT EXISTS `products` (
//     `id` int(11) NOT NULL AUTO_INCREMENT,
//     `pdt_id` varchar(225) NOT NULL,
//     `pdt_name` varchar(225) NOT NULL,
//     `price` int(11) NOT NULL,
//     `desc` varchar(225) NOT NULL,
//     `pdt_img` varchar(225) NOT NULL,
//     PRIMARY KEY (`id`)
// ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

// mysqli_query($conn, $products);

// $orders = "CREATE TABLE IF NOT EXISTS `orders` (
//     `id` int(11) NOT NULL AUTO_INCREMENT,
//     `pdt_id` varchar(225) NOT NULL,
//     `pdt_name` varchar(225) NOT NULL,
//     `amount` int(11) NOT NULL,
//     `description` varchar(225) NOT NULL,
//     `trx_id` varchar(50) NOT NULL,
//     `time` varchar(50) NOT NULL,
//     `date` varchar(50) NOT NULL,
//     PRIMARY KEY (`id`)
// ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

// mysqli_query($conn, $orders);

session_start();

$payment_key = "FLWSECK_TEST-e935d657e8b871cb55b7c4eec8291cf8-X";
?>