<?php

    require_once "notes_actionCRUD.php";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $criteria = $_POST['criteria'];
        $finding = $_POST['search'];

        $sql = "SELECT * FROM `User_Details` WHERE `$criteria`='$finding'";

        $result = mysqli_query( $conn , $sql );

        if( !$result )  //this is not work
        {
                 var_dump($result);
        }

        $num_of_rows = mysqli_num_rows( $result );
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <script type="text/javascript">
        function active() 
        {
            var searchbar = document.getElementById('searchbar');

            if (searchbar.value == 'Search..') {
                searchbar.value = '';
                searchbar.placeholder = 'Search..';
            }
        }
        function inactive()
        {
            var  searchbar = document.getElementById('searchbar');

            if( searchbar.value=='' )
            {
                searchbar.value = "Search..";
                search.placeholder = '';
            }
        }
    </script>
</head>
<body>

    <a href="user_account.php">Back</a>
    
    <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="POST">
        
        <select name="criteria" required>
            <option value="">Selection Criteria</option>
            <option value="full_name">Full Name</option>
            <option value="user_name">User Name</option>
            <option value="email_id">Email ID</option>
        </select>

        <input type="text" name="search" id="searchbar" placeholder="" value="Search.." maxlength="254" autocomplete="off" onmousedown="active();" onblur="inactive();" required>
            
        <input type="submit" value="Go!" id="searchbtn">
        
    </form>

    <?php if(!$num_of_rows) die($num_of_rows); ?>

    <table>
        <tbody>
            <tr>
                <th>Index</th>
                <th><?php echo $criteria; ?></th>
                <th>Action</th>
            </tr>
            <?php
                $count = 1;
                while( $row=mysqli_fetch_assoc($result) )
                {
                                //if user's searching data is match with him self then we are not gong show his his own data that way i
                                //wrote this line
                    if( $ID==$row["ID"] )
                            continue;
                            
                    echo "<tr>";
                    echo "<td>$count</td>";
                    $col_name = $row["$criteria"];
                    $flag = $row["ID"];
                    echo "<td>$col_name</td>";
                    echo "<td><a href='send_request.php?flag=$flag'>Send Request</a></td>";                    
                    echo "</tr>";
                    $count++;
                }
            ?>

        </tbody>
    </table>

</body>
</html>