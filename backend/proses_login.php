<?php
session_start();
include "backend.php";
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
$password = (isset($_POST['password'])) ? md5(htmlentities($_POST['password']))  : "";
if (!empty($_POST['submit_validate'])) {
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");
    $hasil = mysqli_fetch_array($query);
    if ($hasil) {
        $_SESSION['username_kopiku'] = $username;
        $_SESSION['level_kopiku'] = $hasil['level'];
        $_SESSION['id_kopiku'] = $hasil['id'];
        header('location:../frontend/home');
    } else { ?>
        <script>
            alert('username atau password yang anda masukan salah');
            window.location='../frontend/login'
        </script>
<?php
    }
}
?>