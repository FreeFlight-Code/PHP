<?php

session_start();
if(isset($_POST['submit'])) {

    include 'dbh.inc.php';
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    //error handlers
    //check if inputs are empty
    if (empty($uid) || empty($upwd)){
        header("Location: ../index.php?login=empty");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
        $result = mysql_query($conn, $sql);
        $resultCheck = mysql_num_rows(result);
        if($resultCheck < 1){
            header("Location: ../index.php?login=error");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)) {
                //Dehashing pswd
                $hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
                if ($hashedPwdCheck) {
                    header("Location: ../index.php?login=error");
                    exit();
                } elseif ($hashedPwdCheck == true) {
                    //Log in the user here
                    $_SESSION['u_id'] = $row['user_id']
                    $_SESSION['u_first'] = $row['user_id']
                    $_SESSION['u_last'] = $row['user_id']
                    $_SESSION['u_email'] = $row['user_id']
                    $_SESSION['u_uid'] = $row['user_id']
                }
            }
        }
    }

} else {
    header("Location: ../index.php?login=error");
    exit();
}

?>