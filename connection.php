<?php

    $servername = "fdb30.awardspace.net";
    $username = "3809720_sadhu";
    $database = "3809720_sadhu";
    $pass = "Drumil@1234";

    $conn = mysqli_connect( $servername , $username , $pass , $database );

    if( !$conn )
        die( "connection was not successfull" );
        
?>