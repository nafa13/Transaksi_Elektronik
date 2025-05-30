<?php
include "backend.php";
$name = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
$level = (int)(isset($_POST['level'])) ? htmlentities($_POST['level']) : "";
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";
$password = (isset($_POST['password'])) ? md5(htmlentities($_POST['password']))  : "";

if (!empty($_POST['input_user_validate'])) {
    $select = mysqli_query($conn, "SELECT *FROM user WHERE username= '$username'");
    if (mysqli_num_rows($select) > 0) {
        $massage = '<script>alert("username telah ada ");
        window.location="../frontend/user"</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO user (nama,username,level,nohp,alamat,password) values('$name','$username','$level','$nohp','$alamat','$password')");
        if ($query) {
            $massage = '<script>alert("sukses memasukandata data");
        window.location="../frontend/user"</script>';
        } else {
            $massage = '<script>alert("gagal memasukan data")</script>';
        }
    }
}
echo $massage;
