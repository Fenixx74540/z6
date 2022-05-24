<?php
session_start(); 
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}

$target_dir = $_POST['path'];
$target_file = $target_dir . "/" . basename($_FILES["fileToUpload"]["name"]);

echo $target_file;
echo "<br>";
echo $_POST['path'];

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

    echo htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " uploaded.";
    echo "as $target_file";

    $idu = $_SESSION['idu'];
    $dbhost="localhost"; $dbuser="u781260265_user_VI_z8_ML"; $dbpassword="zaq1@WSX"; $dbname="u781260265_VI_z8_ML";
    $connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
    if (!$connection) {
        echo " MySQL Connection error." . PHP_EOL;
        echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $result = mysqli_query($connection, "INSERT INTO `files`(`idu`, `nazwa_pliku`, `sciezka_pliku`) VALUES ('$idu', '$file_name', '$target_dir')") or die("DB error: $dbname");
    mysqli_close($connection);

    header('Location: index1.php');
} else {
    echo "Error uploading file.";
}
