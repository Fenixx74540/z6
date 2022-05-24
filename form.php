<?php
    session_start();
    if (!isset($_SESSION['loggedin']))
    {
        header('Location: login.php');
        exit();
    }
?>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select JPG file to upload format:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form>