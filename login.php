<?php
    session_start();
    if(isset($_SESSION["locked"]))
    {
        $differences = time() - $_SESSION["locked"];
        if ($differences > 10)
        {
            unset($_SESSION["locked"]);
            unset($_SESSION["login_attempts"]);
        }
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
       $username = $_POST ["username"];
       $password = $_POST ["password"];
       
       
     $dbhost="localhost"; $dbuser="u781260265_user_VI_z8_ML"; $dbpassword="zaq1@WSX"; $dbname="u781260265_VI_z8_ML";
     $link = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname); 
     
     $result = mysqli_query($link, "SELECT * FROM users WHERE username = '$username'");
     
     if (mysqli_num_rows($result) > 0)
     {
        $row = mysqli_fetch_object($result);
        if (password_verify($password, $row->password))
        {
            //
        } else {
            $_SESSION["login_attempts"] += 1;
            $_SESSION["error"] = "Złe hasło";
        }
     } else {
        $_SESSION["login_attempts"] += 1;
        $_SESSION["error"] = "Nie ma takiego użytkownika";
     }
    }

?>


<!DOCTYPE html>
<html lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Łassa</title>
</head>
<BODY>
    <h1>Formularz logowania</h1>
    <?php 
    if (isset ($_SESSION["error"])){ 
    echo '<p style="color: red;"><?= $_SESSION["error"]; ?></>';
    unset ($_SESSION ["error"]);} 
    ?>
    <form method="post" action="weryfikuj1.php">
        Login:<input type="text" name="user" maxlength="20" size="20"><br>
        Hasło:<input type="password" name="pass" maxlength="20" size="20"><br>
        <?php
        if ($_SESSION ["login_attempts"]>2){
            $_SESSION ["locked"]=time( );
            echo '<p>Poczekaj 10 sekund</p>';
        } else {
        echo '<input type="submit" value="Send"/><br>';
        echo '<a href="rejestruj.php">Zarejestruj się</a><br>';
        }
        ?>
    </form>
    
</BODY>

</body>
</html>