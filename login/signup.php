<?php
    include_once 'header.php';
?>
<section class="main-container">
    <div class="main-wrapper">
        <h2>Singup</h2>
        <form class="signup-form" action="includes/signup.inc.php" method="POST">
            <?php
                //The entirety of below is to make sure that the user inputted field will not be emptied when mistakes are made
                if(isset($_GET['first'])){
                    $first = $_GET['first'];
                    echo '<input type="text" name="first" placeholder="Firstname" value="'.$first.'">';
                }
                else {
                    echo '<input type="text" name="first" placeholder="Firstname">';
                }
                if(isset($_GET['last'])){
                    $last = $_GET['last'];
                    echo '<input type="text" name="last" placeholder="Lastname" value="'.$last.'">';
                }
                else {
                    echo '<input type="text" name="last" placeholder="Lastname">';
                }
                if(isset($_GET['email'])){
                    $email = $_GET['email'];
                    echo '<input type="text" name="email" placeholder="E-mail" value="'.$email.'">';
                }
                else {
                    echo '<input type="text" name="email" placeholder="E-mail">';
                }
                if(isset($_GET['uid'])){
                    $uid = $_GET['uid'];
                    echo '<input type="text" name="uid" placeholder="Username" value="'.$uid.'">';
                }
                else {
                    echo '<input type="text" name="uid" placeholder="Username">';
                }
            ?>
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" name="submit">Sign up</button>
        </form>
        <?php
            //First method
            /*
            $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            //Check if string present
            if (strpos($fullUrl, "signup=empty")) {
                echo "<p class='errormsg'>You did not fill in all fields!</p>";
            }
            elseif (strpos($fullUrl, "signup=invalid")) {
                echo "<p class='errormsg'>You used invalid characters!</p>";
            }
            elseif (strpos($fullUrl, "signup=invalidemail")) {
                echo "<p class='errormsg'>You used an invalid E-mail!</p>";
            }
            elseif (strpos($fullUrl, "signup=success")) {
                echo "<p class='successmsg'>Signup Successful!</p>";
            }*/

            if(!isset($_GET['signup'])){
                exit();
            }
            else{
                $signupCheck = $_GET['signup'];
                if($signupCheck == "empty") {
                    echo "<p class='errormsg'>You did not fill in all fields!</p>";
                }
                elseif($signupCheck == "invalid") {
                    echo "<p class='errormsg'>You used invalid characters!</p>";
                }
                elseif($signupCheck == "invalidemail") {
                    echo "<p class='errormsg'>You used an invalid E-mail!</p>";
                }
                elseif($signupCheck == "usertaken") {
                    echo "<p class='errormessage'> Username already taken!</p>";
                }
                elseif($signupCheck == "success") {
                    echo "<p class='successmsg'>Signup Successful!</p>";
                }
            }

        ?>
    </div>
</section>
<?php
    include_once 'footer.php'
?>