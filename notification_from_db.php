<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}
$dbhost="localhost"; $dbuser="u781260265_user_VI_z8_ML"; $dbpassword="zaq1@WSX"; $dbname="u781260265_VI_z8_ML";
$connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
if (!$connection) {
    echo " MySQL Connection error." . PHP_EOL;
    echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$idu = $_SESSION['idu'];

header("Content-Type: application/json");

$result = mysqli_query($connection, "SELECT `datetime`, `ip_adress`, `ACK` FROM `lock_account` WHERE idu = '$idu' ORDER BY datetime DESC LIMIT 1;") or die("DB error: $dbname");
mysqli_query($connection, "UPDATE `lock_account` SET `ACK`=true WHERE idu = '$idu' ORDER BY datetime DESC LIMIT 1;") or die("DB error: $dbname");

$array = array();
$i = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $array[$i] = $row;
    $i = $i + 1;
}
echo json_encode($array);
mysqli_close($connection);
