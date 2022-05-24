<?php
 $dbhost="localhost"; $dbuser="u781260265_user_VI_z8_ML"; $dbpassword="zaq1@WSX"; $dbname="u781260265_VI_z8_ML";
$connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
if (!$connection) {
    echo " MySQL Connection error." . PHP_EOL;
    echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$path = $_GET['pathvalue'];
$idu = $_SESSION['idu'];

header("Content-Type: application/json");
$result = mysqli_query($connection, "SELECT users.idu as id, users.login as username, lock_account.datetime as datetime, lock_account.ip_adress as ip FROM `users` JOIN lock_account on users.idu = lock_account.idu;") or die("DB error: $dbname");
$array = array();
$i = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $array[$i] = $row;
    $i = $i + 1;
}
echo json_encode($array);

mysqli_close($connection);
