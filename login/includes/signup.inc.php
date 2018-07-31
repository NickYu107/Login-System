<?php
//if else statement will forbid user from directly accessing this file
if(isset($_POST['submit'])) {
    //Include the database handler
    include_once 'dbh.inc.php';
    //Get data from form
    $first = mysqli_real_escape_string($conn, $_POST['first']);     //using mysqli_real_escape_string to prevent user from writing code in box
    $last = mysqli_real_escape_string($conn, $_POST['last']);       //Alternatively, a prepared statement can be used to achieve the same thing
    $email = mysqli_real_escape_string($conn, $_POST['email']);     //And it is the preffered method
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);


    //Check if inputs are empty
    if(empty($first)|| empty($last)|| empty($email)|| empty($uid)|| empty($pwd)) {
        header("Location: ../signup.php?signup=empty&first=$first&last=$last&email=$email&uid=$uid");
        exit();
    } else {
        //Check if input characters are valid
        if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
            header("Location: ../signup.php?signup=invalid&email=$email&uid=$uid");
            exit();
        } else {
            //Check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                header("Location: ../signup.php?signup=invalidemail&first=$first&last=$last&uid=$uid");
                exit();
            } else {
                //Check if username already exists
                $sql = "SELECT * FROM users WHERE user_uid='$uid';";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);

                if($resultCheck > 0) {
                    header("Location: ../signup.php?signup=usertaken&first=$first&last=$last&email=$email");
                    exit();
                } else {
                    //Password Hashing
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

                    //SQL code, insert into the database when all inputs are valid
                    $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd)
                    VALUES ('$first', '$last', '$email', '$uid', '$hashedPwd');";
                    mysqli_query($conn, $sql);
                    header("Location: ../signup.php?signup=success");
                    exit();
                }

            }
        }
    }
} else {
    //Form not submitted
    header("Location: ../signup.php?signup=error");
    exit();
}
