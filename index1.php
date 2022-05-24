<!doctype html>
<html lang="en">

<head>
    <?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: login.php');
        exit();
    }
    ?>
    <?php
    $session_value_idu = (isset($_SESSION['idu'])) ? $_SESSION['idu'] : '';
    $session_value_login = (isset($_SESSION['login'])) ? $_SESSION['login'] : '';
    ?>
    <script type="text/javascript">
        var idu_global = '<?php echo $session_value_idu; ?>';
        var login_global = '<?php echo $session_value_login; ?>';
    </script>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>

<body onload="drawTable()">

    <p id="warning" style="background-color: red">

    </p>

    <a href="logout.php"> Logout </a>

    <form name="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="path" id="path"><br>
        Select file to upload:
        <input type="file" name="fileToUpload" id="fileToUpload"><br>
        <input type="submit" value="Upload" name="submit">
    </form>
    <br>
    <form id="createFolderForm" name="createFolder" action="" method="post">
        <input type="hidden" name="path" id="path">
        Enter a name for the directory:
        <input type="text" name="folderName" id="folderName">
        <input type="submit" value="Stwórz" name="s">
    </form>
    <br>
    
    <button id="switchBT">Change view</button>
    <table id='table' cellpading="3" border="0">
        <tbody>
            <tr id="main_TR">
                <td>Miniature</td>
                <td>File name</td>
            </tr>
    </table>
    <table id='table_small'>
        <tbody>
            <tr id="main_TR">
                <td>File name</td>
            </tr>
    </table>

    <script>
        var path = document.forms["uploadForm"]["path"];
        var path_create = document.forms["createFolder"]["path"];

        $('#createFolderForm').on('submit', createFolder);
        $('#switchBT').on('click', switchTable);

        path.value = "users/" + login_global;
        path_create.value = path.value;

        var TR = document.createElement('TR');
        var TD_miniatura = document.createElement('TD');
        img = document.createElement('img');
        img.src = "back.png";
        img.width = "60";

        TD_miniatura.appendChild(img);

        var TD_plik = document.createElement('TD');
        P = document.createElement('button');
        P.innerText = "Go back";
        P.style.margin = "0px 2px 5px 5px";
        P.onclick = function() {
            if (path.value != "users/" + login_global) {
                var n = path.value.lastIndexOf('/');
                path.value = path.value.substring(0, n != -1 ? n : s.length);
                drawTable();
            }
        };
        TD_plik.appendChild(P);

        TR.appendChild(TD_miniatura);
        TR.appendChild(TD_plik);

        table.appendChild(TR);
        
        var TR2 = document.createElement('TR');

        var TD_plik2 = document.createElement('TD');
        P2 = document.createElement('button');
        P2.innerText = "Go back";
        P2.style.margin = "0px 2px 5px 5px";
        P2.onclick = function() {
            if (path.value != "users/" + login_global) {
                var n = path.value.lastIndexOf('/');
                path.value = path.value.substring(0, n != -1 ? n : s.length);
                drawTable();
            }
        };
        TD_plik2.appendChild(P2);

        TR2.appendChild(TD_plik2);

        table_small.appendChild(TR2);
        

        function drawTable() {
            while (table.childElementCount > 2) {
                table.removeChild(table.lastChild);
            }
            
            while (table_small.childElementCount > 2) {
                table_small.removeChild(table_small.lastChild);
            }

            $.ajax({
                url: 'file_from_db.php',
                data: {
                    pathvalue: path.value
                },
                dataType: 'json',
                type: 'get',
                success: function(resp) {
                    resp.forEach(row => {
                        var TR = document.createElement('TR');

                        if (!row.nazwa_pliku.includes('.')) {

                            var TD_miniatura = document.createElement('TD');
                            img = document.createElement('img');
                            img.src = "folder.png";
                            img.width = "100";

                            TD_miniatura.appendChild(img);

                            var TD_plik = document.createElement('TD');
                            var TD_plik2 = document.createElement('TD');

                            P = document.createElement('button');
                            P2 = document.createElement('button');
                            P.innerText = row.nazwa_pliku;
                            P.style.margin = "0px 2px 5px 5px";
                            P.onclick = function() {
                                //zmiana path i odświerzenie tabeli
                                path.value = row.sciezka_pliku + "/" + row.nazwa_pliku;
                                drawTable();
                            };
                            P2.innerText = row.nazwa_pliku;
                            P2.style.margin = "0px 2px 5px 5px";
                            P2.onclick = function() {
                                //zmiana path i odświerzenie tabeli
                                path.value = row.sciezka_pliku + "/" + row.nazwa_pliku;
                                drawTable();
                            };
                        } else {
                            var fileExtention = row.nazwa_pliku.split('.').slice(-1);
                            console.log(fileExtention);

                            var TD_miniatura = document.createElement('TD');
                            img = document.createElement('img');

                            if (fileExtention == "jpg" || fileExtention == "png" || fileExtention == "jpeg") {
                                img.src = row.sciezka_pliku + "/" + row.nazwa_pliku;
                            } else if (fileExtention == "mp4") {
                                img.src = "play.png";
                            } else if (fileExtention == "mp3") {
                                img.src = "song.png";
                            } else {
                                img.src = "file.png";
                            }

                            img.width = "100";
                            TD_miniatura.appendChild(img);

                            var TD_plik = document.createElement('TD');
                            //pobranie pliku
                            P = document.createElement('a');
                            P.innerText = row.nazwa_pliku;
                            P.href = row.sciezka_pliku + "/" + row.nazwa_pliku;
                            var TD_plik2 = document.createElement('TD');
                            //pobranie pliku
                            P2 = document.createElement('a');
                            P2.innerText = row.nazwa_pliku;
                            P2.href = row.sciezka_pliku + "/" + row.nazwa_pliku;
                        }


                        TD_plik.appendChild(P);
                        TD_plik2.appendChild(P2);

                        TR.appendChild(TD_miniatura);
                        TR.appendChild(TD_plik);
                        
                        var TR2 = document.createElement('TR');
                        TR2.appendChild(TD_plik2);
                        
                        table_small.appendChild(TR2);
                        table.appendChild(TR);
                    });
                },
                error: function() {
                    console.log('Error!');
                }
            });
        }
        
        function switchTable(){
            const table = document.getElementById('table');
            const table2 = document.getElementById('table_small');
            if (table.style.display === 'none') {
                table2.style.display = 'none';
                table.style.display = 'block';
            } else {
                table.style.display = 'none';
                table2.style.display = 'block';
            }
        }

        $.ajax({
            url: 'warning_from_db.php',
            dataType: 'json',
            type: 'get',
            success: function(resp) {
                resp.forEach(row => {
                    if(row.ACK == 0){
                        var p = document.getElementById("warning");
                        p.innerText = "Na twoje konto próbowano zalogować się z adresu IP: " + row.ip_adress + " dnia: " + row.datetime;
                    }
                });
                const table = document.getElementById('table_small');
                table.style.display = 'none';
            },
            error: function() {
                console.log('Error!');
            }
        });

        function createFolder() {
            console.log("createFolder");
            if ((path.value.match(/\//g) || []).length > 5) {
                return;
            }
            if (document.forms["createFolder"]["folderName"].value != "") {

                var folderName = document.forms["createFolder"]["folderName"].value;
                var folderDir = path.value;

                var urlString = "folderDir=" + folderDir + "&folderName=" + folderName;

                console.log(urlString);

                $.ajax({
                    url: "mkdir.php",
                    type: "POST",
                    cache: false,
                    data: urlString,
                    success: function(response) {
                    }
                });
            }
        }
    </script>
</body>