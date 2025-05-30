<?php
include "backend.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";


if (!empty($_POST['delete_user_validate'])){
    $query = mysqli_query($conn, "DELETE FROM user WHERE id = '$id'");
    if($query){
        $massage = '<script>alert("sukses menghapus data");
        window.location="../frontend/user"</script>';
    }else{
        $massage = '<script>alert("gagal menghapus data")
        window.location="../frontend/user"</script>';
    }
}echo $massage;
?>