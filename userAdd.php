<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY>
<?php
//  $user=$_POST['user']; // login z formularza
//  $pass=$_POST['pass']; // hasło z formularza
 $user = htmlentities ($_POST['user'], ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $user
 $pass = htmlentities ($_POST['pass'], ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $pass
 $pass2 = htmlentities ($_POST['pass2'], ENT_QUOTES, "UTF-8");
 
 if($pass !=  $pass2){
    echo "Hasła nie są identyczne!";
    echo '<a href = "rejestruj.php"> Spróbuj ponownie </a>';
    return;
 }
 
 $dbhost="localhost"; $dbuser="u781260265_user_VI_z8_ML"; $dbpassword="zaq1@WSX"; $dbname="u781260265_VI_z8_ML";
 $link = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
 $result = mysqli_query($link, "SELECT * FROM `users` WHERE username = '$user'") or die ("Błąd zapytania do bazy: $dbname"); // wiersza, w którym login=login z formularza
 $rekord = mysqli_fetch_array($result); // wiersza z BD, struktura zmiennej jak w BD
 if($rekord) 
 {
 mysqli_close($link);
 echo "Jest już użytkownik o takim loginie";
 echo '<a href = "rejestruj.php"> Spróbuj ponownie </a>';
 return;
 }
 
 $link = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
 if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); } // obsługa błędu połączenia z BD
 mysqli_query($link, "SET NAMES 'utf8'"); // ustawienie polskich znaków
 
 $addUser = mysqli_query($link, "INSERT INTO `users` (`username`, `password`) VALUES ('$user', '$pass')");
 $idp = mysqli_insert_id($link);
 mysqli_close($link);
 
 
    $message = "Pomyślnie dodano użytkownika";
    header('Location: index.php');
    exit();
 
?>
</BODY>
</HTML>