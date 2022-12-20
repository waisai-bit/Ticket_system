<?php
session_start();
include('connect.php');
$con=mysqli_connect($host,$user,$pass,$database);

	if(!$con){
		die("Connection Failed:".mysqli_connect_error());
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="resources\img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="resources\img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="resources\img/favicon-16x16.png">
    <link rel="manifest" href="resources\img/site.webmanifest">
    <link rel="mask-icon" href="resources\img/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="resources\img/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="resources\img/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
   <!-- data table -->
   <link rel="stylesheet" href="vendors/css/datatables.min.css">
   <!-- font-awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- custom css -->
    <link rel="stylesheet" href="resources/css/style.css" />
    <title>Ticket System</title>
  </head>
  <body>