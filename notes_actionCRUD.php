<?php

    session_start();
    require_once "back_restrict.php";

    require_once "connection.php";

                        // if anyone direct use link and try to open this page
    if( !isset($_SESSION['ID']) )
        die("<script>
            alert('please do login first');
            location.replace('login.php');
            </script>");

    $ID = $_SESSION["ID"];


?>