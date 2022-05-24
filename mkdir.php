<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}

$folderName = $_POST['folderName'];
$folderDir = $_POST['folderDir'];

if (!mkdir($folderDir . "/" . $folderName, 0777)) {
    die('Failed to create directories...');
}

$dbhost="localhost"; $dbuser="u781260265_user_VI_z8_ML"; $dbpassword="zaq1@WSX"; $dbname="u781260265_VI_z8_ML";
$con = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
if (!$con) {
    echo " MySQL Connection error." . PHP_EOL;
    echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$folderDir = mysqli_escape_string($con, $folderDir);
$folderName = mysqli_escape_string($con, $folderName);

$user = $_SESSION['idu'];

$query = mysqli_query($con, "INSERT INTO `files`(`idu`, `nazwa_pliku`, `sciezka_pliku`) VALUES ('$user', '$folderName', '$folderDir')") or die("DB error: $dbname");
echo ('Question has been saved');

exit();
