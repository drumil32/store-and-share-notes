<?php

    session_start();
    require_once "notes_actionCRUD.php";
    
    $sql = "SELECT * FROM `request` WHERE `FROM12`='$ID';";

    $result = mysqli_query( $conn , $sql );

    if( !$result )
        die("
                <script>
                alert('Some thing is wrong Please try again');
                location.replace('user_account.php');
                </script>
            ");

    $num_of_rows = mysqli_num_rows( $result ) ;
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    <a href="user_account.php">Back</a>

    <h2>You Sent <?php echo $num_of_rows; ?> Requests</h2>
    
    <?php if(!$num_of_rows) exit(0); ?>
    <table>
        <tbody>
            <tr>
                <th>Index</th>
                <th>User Name</th>
                <th>Action</th>
            </tr>
            <?php
                $count = 1;
                while( $row=mysqli_fetch_assoc($result) )
                {                            
                    echo "<tr>";
                    echo "<td>$count</td>";
                    $flag = $row["TO12"];
                    $sno = $row['sno'];

                    $sql = "SELECT `user_name` FROM `User_Details` WHERE `ID`='$flag'";
                    $result1 = mysqli_query( $conn , $sql );

                    $row = mysqli_fetch_assoc( $result1 );
                    $user_name = $row['user_name'];

                    echo "<td>$user_name</td>";
                    echo "<td><a href='show_request_message.php?sno=$sno'>Show Request Message</a></td>";
                    echo "</tr>";
                    $count++;
                }
            ?>

        </tbody>
    </table>
</body>
</html>