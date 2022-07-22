<?php


require_once "connection.php";

// declaration of variable in which we are going to store data
$full_name = $user_name = $email = $primary_password = $confirm_password = $captcha_num = $given_captcha_num = "";

// declaration of variable in which we are going to store error
$full_name_error = $user_name_error = $email_error = $primary_password_error = $confirm_password_error = $given_captcha_num_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // full name validation
    $full_name = $_POST["full_name"];
    $full_name = trim($full_name);
    if (empty($full_name)) {
        $full_name_error = "Please give your full name";
    } elseif (!filter_var($full_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $full_name_error = "Please give valid full name";
    }

    // user name validation

    $user_name = $_POST["user_name"];
    $user_name = trim($user_name);
    if (empty($user_name)) {
        $user_name_error = "Please give your user name";
    } elseif (!filter_var($user_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $user_name_error = "Please give valid user name";
    }

    // email id
    $email = $_POST["email"];
    $email = trim($email);
    if (empty($email)) {
        $email_error = "Please give email id";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format";
    }




    // primary password
    $primary_password = $_POST["primary_passsword"];
    $primary_password = trim($primary_password);
    if (empty($primary_password)) {
        $primary_password_error = "Please give primary password";
    }

    // confirm password
    $confirm_password = $_POST["confirm_password"];
    $confirm_password = trim($confirm_password);
    if (empty($confirm_password)) {
        $confirm_password_error = "Please give confirm passwrod";
    } elseif (strcmp($confirm_password, $primary_password)) {
        $confirm_password_error = "Both password are missmatch";
    }

    // captcha validation
    $captcha_num = $_POST["captch"];
    $given_captcha_num = $_POST["captcha"];
    if (empty($given_captcha_num)) {
        $given_captcha_num_error = "Please fill this data";
    } elseif ($given_captcha_num != $captcha_num) {
        $given_captcha_num_error = "Number is missmatch";
    }

    // if all data is valid for put data in database
    if (empty($full_name_error) && empty($user_name_error) && empty($email_error) && empty($primary_password_error) && empty($confirm_password_error) && empty($given_captcha_num_error)) {

        $options = [
            'cost' => 12,
        ];

        $str_password = password_hash($primary_password, PASSWORD_BCRYPT, $options);

        $sql = "INSERT INTO `User_Details`(`ID`, `full_name`, `user_name`, `email_id`, `password`) VALUES (NULL,'$full_name','$user_name','$email','$str_password')";

        $result = mysqli_query($conn, $sql);

        if (!$result) {
            // As a rule :- we know all user have their unique email address so we check given email is unique or not if a email is not unique then we will give alert by script and then redirect user to then index.php
            if( mysqli_errno($conn)==1062 )
                die("  <script>
                    alert('You aleready have an account ');
                    location.replace('index.php');
                    </script>");

            die("something went to wrong please try again" . mysqli_error($conn));
        } else {
            echo "  <script>
                    alert('Sign Up sucessfully');
                    location.replace('index.php');
                    </script>";
        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>facebook.com</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body class="body">
    <header class="header">
        <span class="Name">CRUD</span>
<button class="login"> <a href="http://registrationform123.atwebpages.com/login.php"> Login In Existing Account </a> </button>
    </header>
    <div class="containner">
        <div class="title">
            <span class="heading">Create a new account</span>
            <span class="kick">It's quick and easy</span>
        </div>
    <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                                    <!-- Full Name -->
        <input type="text" id="fname"  name="full_name" style="width: 11.4cm;"  placeholder=" give your Full Name" value="<?php echo $full_name ?>">
        <span><?php echo $full_name_error; ?></span><br>



                                    <!-- User Name -->
        <input type="text" id="lname" name="user_name" maxlength='20' title='length<=20 and contain only albhabets'  style="width: 11.4cm;"  placeholder="User Name" value="<?php echo $user_name ?>">
        <span><?php echo $user_name_error; ?></span><br>



                                    <!-- email address we can take here type as email id so work is easy but we don't do this because we are in learning phase -->
        <input type="text" id="contac" name="email"   placeholder="abC23@gmail.con" value="<?php echo $email; ?>">
        <span><?php echo $email_error; ?></span><br>

                                    <!-- primary passoword -->
        <input type="password" id='pass' name="primary_passsword"      pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters " placeholder="Give Password in this format Abcd@123" minlength="8" maxlength="15" value="<?php echo $primary_password; ?>">
        <span><?php echo $primary_password_error; ?></span><br>

                                    <!-- confirm password -->
        <input type="password" id='pass' name="confirm_password"     pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters " placeholder="Give confirm Password in this format Abcd@123" minlength="8" maxlength="15" value="<?php echo $confirm_password; ?>">
        <span><?php echo $confirm_password_error; ?> </span><br>

                                    <!-- For checking a robot is not fill form -->

        <p id='captc'  >
            <?php
$captcha_num = rand();
echo $captcha_num;
$_SESSION["captcha_num"] = $captcha_num;
?>
        </p>
<input type="hidden" name="captch" value="<?php echo $captcha_num; ?>">
<input type="number" name="captcha" id="contac"  placeholder="Write Shown Number Here" value="<?php echo $given_captcha_num; ?>" >
        <span><?php echo $given_captcha_num_error; ?></span><br>
        <input type="submit" value="Sign Up" id="submit">

    </form>
    </form>
    </div>
</body>
</html>