<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY>
    <?php
    //  $user=$_POST['user']; // login z formularza
    //  $pass=$_POST['pass']; // hasło z formularza
    $user = htmlentities($_POST['user'], ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $user
    $pass = htmlentities($_POST['pass'], ENT_QUOTES, "UTF-8"); // rozbrojenie potencjalnej bomby w zmiennej $pass

    $ip = $_SERVER['REMOTE_ADDR'];

    $dbhost="localhost"; $dbuser="u781260265_user_VI_z8_ML"; $dbpassword="zaq1@WSX"; $dbname="u781260265_VI_z8_ML";
    $link = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname); // połączenie z BD – wpisać swoje dane
    if (!$link) {
        echo "Błąd: " . mysqli_connect_errno() . " " . mysqli_connect_error();
    } // obsługa błędu połączenia z BD
    mysqli_query($link, "SET NAMES 'utf8'"); // ustawienie polskich znaków
    $result = mysqli_query($link, "SELECT * FROM `users` WHERE `login` = '$user'"); // wiersza, w którym login=login z formularza
    $rekord = mysqli_fetch_array($result); // wiersza z BD, struktura zmiennej jak w BD

    if (!$rekord) //Jeśli brak, to nie ma użytkownika o podanym loginie
    {
        mysqli_close($link); // zamknięcie połączenia z BD
        echo "Brak użytkownika o takim loginie!"; // UWAGA nie wyświetlamy takich podpowiedzi dla hakerów
        echo '<a href = "login.php"> Spróbuj ponownie';
        exit();
    } else { // jeśli $rekord istnieje
        if ($rekord['password'] == $pass) // czy hasło zgadza się z BD
        {
            $idu = $rekord['idu'];
            $result2 = mysqli_query($link, "SELECT `datetime` FROM `lock_account` WHERE idu = $idu ORDER BY idla DESC LIMIT 1 ");
            $rekord2 = mysqli_fetch_array($result2);
            if ($rekord2) {
                $start_date = new DateTime($rekord2['datetime']);
                $since_start = date_diff($start_date, new DateTime());
                $minutes = $since_start->days * 24 * 60;
                $minutes += $since_start->h * 60;
                $minutes += $since_start->i;
                if ($minutes >= 1) {

                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['idu'] = $rekord['idu'];
                    $_SESSION['login'] = $rekord['login'];

                    //wpisanie do logs
                    mysqli_query($link, "INSERT INTO `logs`(`idu`, `result`, `ip_adress`) VALUES ('$idu', true, '$ip')");
                    mysqli_query($link, "UPDATE `users` SET `proby_logowania`='0' WHERE idu = $idu");

                    header('Location: index1.php');
                    exit();
                } else {
                    echo 'Ponów próbę za 1min <a href = "login.php"> Spróbuj ponownie';
                    exit();
                }
            } else {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['idu'] = $rekord['idu'];
                $_SESSION['login'] = $rekord['login'];

                //wpisanie do logs
                $idu = $rekord['idu'];
                mysqli_query($link, "INSERT INTO `logs`(`idu`, `result`, `ip_adress`) VALUES ('$idu', true, '$ip')");
                mysqli_query($link, "UPDATE `users` SET `proby_logowania`='0' WHERE idu = $idu");

                header('Location: index1.php');
                exit();
            }
        } else {
            echo "Błędne hasło!"; // UWAGA nie wyświetlamy takich podpowiedzi dla hakerów

            $idu = $rekord['idu'];
            mysqli_query($link, "INSERT INTO `logs`(`idu`, `result`, `ip_adress`) VALUES ('$idu', false, '$ip')");

            $result2 = mysqli_query($link, "SELECT `proby_logowania` FROM `users` WHERE idu");
            $rekord2 = mysqli_fetch_array($result2);

            if ($rekord2['proby_logowania'] >= 2) {
                mysqli_query($link, "INSERT INTO `lock_account`(`idu`, `ip_adress`) VALUES ('$idu','$ip')");
            } else {
                $proby = $rekord2['proby_logowania'] + 1;
                mysqli_query($link, "UPDATE `users` SET `proby_logowania`='$proby' WHERE idu = $idu");
            }
            echo '<a href = "login.php"> Spróbuj ponownie';
        }
    }
    ?>
</BODY>

</HTML>