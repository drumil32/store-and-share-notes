<?php
        
   require_once "notes_actionCRUD.php";

   $count = 1;   
   
   if( isset($_GET['sno']) )  // it is needed  Because this page is use as two page 1.Show Notes and 2.show note to user in order to share anyone of them
   {
           $_SESSION['sno']= $_GET['sno'];
   }
   if( isset($_SESSION['sno']) )
   {
           $sno = $_SESSION['sno'];
   }
   else
       $sno = -1;
       
       if( isset($_SESSION['TO12']) )
               $TO12 = $_SESSION['TO12'];

   if( !($_SERVER["REQUEST_METHOD"] == "POST") )
   {
        $sql = "SELECT * FROM `Notes` WHERE `user_id`='$ID'";

        $result = mysqli_query( $conn , $sql );

        if( !$result )
            die(    "<script>
                    alert('Something heppen wrong in server please try again');
                    location.replace('user_home_page.php');
                    </script>"
                );

        $num_of_notes = mysqli_num_rows($result);
        if(-1==$sno)
                echo '<a href="user_home_page.php">Back</a>';
    }
    else
    {
        if(-1==$sno)
                echo '<a href="show_notes_to_user.php">Back</a>';

        
        $search = $_POST['search'];
        var_dump($search);
//        $sql  = "SELECT * FROM `Notes` WHERE `user_id`='$ID' AND `title`='$search';";  //we must modify it
        
        $sql = "SELECT * FROM `Notes` WHERE `title` LIKE '$search%';";

        $result = mysqli_query( $conn , $sql );

        if( !$result )
            die(    "<script>
                    alert('Somethinghe heppen wrong in server please try again');
                    location.replace('user_home_page.php');
                    </script>"
                );

        $num_of_notes = mysqli_num_rows($result);
                
    }
    
    if(-1!=$sno)
                echo "<a href="."show_request_message.php?sno=$sno&TO12=$TO12".">Back</a>";           

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
    <h3>You have <?php echo $num_of_notes; ?> Notes</h3>
    

    
    
    <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="POST">
    
        <input type="text" name="search" id="searchbar" placeholder="" value="Search.." maxlength="254" autocomplete="off" onmousedown="active();" onblur="inactive();">
            
        <input type="submit" value="Go!" id="searchbtn">
        
    </form>

    <?php if(!$num_of_notes) die($num_of_notes); ?>

    <table>
        <tbody>
            <tr>
                <th>Index</th>
                <th>Title</th>
                <th>Date</th>
                <th colspan='2'>Action</th>
            </tr>            
            <?php

                while( $row=mysqli_fetch_assoc($result) )
                {
                    echo "<tr>";
                    echo "<td>$count</td>";
                    $title = $row['title'];                    
                    $date = $row['date'];
                    echo "<td>$title</td>";
                    echo "<td>$date</td>";             //i think here is ERROR
                    
                    $note_id = $row['note_id'];

                    if( -1!=$sno )
                        echo "<td><a href='share_note.php?title=$title&sno=$sno'>Share This</a></td>";
                    else
                    {
                            echo "<td><a href='delete_note.php?note_id=$note_id'>Delete</a></td>";
                            echo "<td><a href='show_desc.php?note_id=$note_id'>Show</a></td>";
                            echo "<td><a href='update.php?note_id=$note_id'>Upadate</a></td>";
                    }
                    echo "</tr>";
                    $count++;
                }
            ?>

        </tbody>
    </table>
</body>
</html>