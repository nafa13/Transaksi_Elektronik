<?php
session_start();
include "backend.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$passwordlama = (isset($_POST['passwordlama'])) ? md5(htmlentities($_POST['passwordlama']))  : "";
$passwordbaru = (isset($_POST['passwordbaru'])) ? md5(htmlentities($_POST['passwordbaru']))  : "";
$repasswordbaru = (isset($_POST['repasswordbaru'])) ? md5(htmlentities($_POST['repasswordbaru']))  : "";

if (!empty($_POST['ubah_pw_validate'])) {
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$_SESSION[username_kopiku]' AND password = '$passwordlama'");
    $hasil = mysqli_fetch_array($query);
    if ($hasil) {
        if ($passwordbaru == $repasswordbaru) {
            $query = mysqli_query($conn, "UPDATE user SET password='$passwordbaru' WHERE username = '$_SESSION[username_kopiku]'");
            if ($query) {
                $massage = '<script>alert("password berhasil diubah");
                window.history.back()</script>
                </script>';
            } else {
                $massage = '<script>alert("password gagal di ubah");
                window.history.back()</script>
                </script>';
            }
        }else {
            $massage = '<script>alert("password baru tidaksama");
                window.history.back()</script>
                </script>';
        }
    } else { 
        $massage = '<script>alert("password lama tidak sesuai");
        window.history.back()</script>
        </script>';
    }
}else {
    header('location:../home');
}
echo $massage;
?>