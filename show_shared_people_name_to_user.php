<?php

    session_start();
    require_once "notes_actionCRUD.php";

    if( isset($_GET['given']) )
        $sign=1;
    else
        $sign=0;

    if( 0==$sign )
        $sql = "SELECT DISTINCT `FROM12` FROM shared_notes WHERE `TO12`='$ID';";
    else
        $sql = "SELECT DISTINCT `TO12` FROM shared_notes WHERE `FROM12`='$ID';";

    $result = mysqli_query( $conn , $sql );

    if( !$result ) //please clear your doubt realted to this
        die("
                <script>
                alert('something is happen wrong in server');
                location.replace('user_account.php');
                </script>
            ");

    $num_of_row = mysqli_num_rows( $result );

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>

    <a href="user_account.php">Back</a>

    <?php
    if( 0==$sign )
        echo "<h2>Number of people who shared you notes is $num_of_row"; 
    else
        echo "<h2>Number of people whom you give your notes is $num_of_row";
    
    if(!$num_of_row) 
        exit(0); 

    echo "</h2>";

    ?>

    <table>
        <tbody>
            <tr>
                <th>Index</th>
                <th>User Name</th>
                <th>Action</th>
            </tr>
            <?php
                $count = 1;
                if( 0==$sign )
                    $p = "FROM12";
                else
                    $p = "TO12";                

                while( $row=mysqli_fetch_assoc($result) )
                {                            
                    echo "<tr>";
                    echo "<td>$count</td>";                    
                    $flag = $row[$p]; //you should check this due to [$p]

                    $sql = "SELECT `user_name` FROM `User_Details` WHERE `ID`='$flag'";
                    $result1 = mysqli_query( $conn , $sql );

                    $row = mysqli_fetch_assoc( $result1 );
                    $user_name = $row['user_name'];
                    
                    echo "<td>$user_name</td>";   
                    
                    
                    echo "<td><a href='show_shared_notes_to_user.php?$p=$flag'>Show Notes</a></td>";  //you should check this due to $p=$flag
                    echo "</tr>";
                    $count++;
                }
            ?>

        </tbody>
    </table>

</body>
</html>