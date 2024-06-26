<?php
session_start();
include "connect.php";

// Veryfying the UID and password and the user type 
if (isset($_POST['utype']) && isset($_POST['uname']) && isset($_POST['psw']) ){

    //Form Validation 
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $usertype = test_input($_POST['utype']);
    $username = test_input($_POST['uname']);
    $password = test_input($_POST['psw']);

    if(empty($username)){
        header("Location: index.php? error=User Name is Requred");

    }elseif (empty($password)){
        header("Location: index.php? error=User Password is Requred");

    }else{

        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['password'] === $password && $row ['user_type'] === $usertype) {

                $_SESSION['name'] = $row['name'];
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_type'] = $row['user_type'];;
                $_SESSION['username'] = $row['username'];

                header("Location: hms-dashbord.php");

            }else{
                header("Location: index.php? error=incorrect user name or password");
            }

        }else{
            header("Location: index.php? error=incorrect user name or password");
        }
    }

}else{
    header("Location: index.php");
}

?>