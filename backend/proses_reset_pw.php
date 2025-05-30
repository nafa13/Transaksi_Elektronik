<?php
include "backend.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";


if (!empty($_POST['input_user_validate'])){
    $query = mysqli_query($conn, "UPDATE user SET password=md5('$password') WHERE id = '$id'");
    if($query){
        $massage = '<script>alert("password berhasil di reset");
        window.location="../frontend/user"</script>
        </script>';
    }else{
        $massage = '<script>alert("gagal mereset password")
        window.location="../frontend/user"</script></script>';
    }
}echo $massage;
?>