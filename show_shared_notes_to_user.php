<?php

    session_start();
    require_once "notes_actionCRUD.php";

    // if user directly come here
    if( !isset($_GET['FROM12']) && !isset($_GET['TO12']) )
        die("
                <script>
                alert('You are trying to directly come here');
                location.replace('user_account.php');
                </script>
            ");

    if( isset($_GET['FROM12']) )
    {
        $other_ID = $_GET['FROM12'];
        $sign = 0;
        $p2 = "TO12";
        $p1 = "FROM12";
    }
    else
    {
        $other_ID = $_GET['TO12'];
        $sign = 1;
        $p1 = "TO12";
        $p2 = "FROM12";
    }

    $_SESSION["$p1"] = $other_ID;    

    $sql = "SELECT * FROM `shared_notes` WHERE `$p1`='$other_ID' AND `$p2`='$ID';";

    $result = mysqli_query( $conn , $sql );    

    $num_of_row = mysqli_num_rows( $result );

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    <?php
        if( 0==$sign )
            echo "<a href='show_shared_people_name_to_user.php'>Back</a>";
        else
            echo "<a href='show_shared_people_name_to_user.php?given=1'>Back</a>";
    ?>
    
    <table>
        <tbody>
            <tr>
                <th>Index</th>
                <th>Title</th>
                <th>Date</th>
                <th colspan='2'>Action</th>
            </tr>            
            <?php
                $count = 1 ;
                while( $row=mysqli_fetch_assoc($result) )
                {
                    echo "<tr>";
                    echo "<td>$count</td>";
                    $title = $row['title'];
                    $date = $row['date'];
                    echo "<td>$title</td>";
                    echo "<td>$date</td>";
                    
                    echo "<td><a href='show_desc.php?title=$title'>Show</a></td>";  //set this line
                    echo "</tr>";

                    $count++;
                }
            ?>

        </tbody>
    </table>

</body>
</html>