<?php 
    if(isset($_POST['login_btn'])){
        $uname = remove_bad_character($_POST['uname']);
        $psw = addslashes($_POST['psw']);
        $sql = "SELECT * FROM users WHERE username='$uname'  AND password='$psw'"; 
        $result= $conn->query($sql); 

        if($result->num_rows >0){ 
            // $secret = "M@inguy&n30";
            // setcookie('cookie',$uname,time()+3600);
            // $client_stamp = generateStamp($uname, $secret, $_SERVER['HTTP_USER_AGENT'],$_SERVER['REMOTE_ADDR']);
            // setcookie('stamp', $client_stamp,time()+3600);

            $_SESSION['session'] = $uname;
            header('location: index.php');
            exit();
        }
        else{
            echo "<script>alert('Error!!!')</script>";
        }
        
    }
?>

<div class="container">
    <div class="row">
        <div class="col-xl-5 col-md-4 m-auto ">
            <p>Login to your account.</p>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="username"><b>Username</b></label>
                    <input type="username" name="uname" placeholder="Enter Username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="psw"><b>Password</b></label>
                    <input type="password" name="psw" placeholder="Enter Password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <input type="submit" name="login_btn" class="btn btn-primary" value="Login">
                </div>
                <div>
                    <p>If you don't have an account, Sign up <a href="?page=./module/user&action=signup" > here </a></p>
                </div>
            </form>
        </div>
    </div>
</div>