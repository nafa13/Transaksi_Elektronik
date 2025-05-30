<?php
include "backend.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$foto = (isset($_POST['foto'])) ? htmlentities($_POST['foto']) : "";


if (!empty($_POST['delete_menu_validate'])){
    $query = mysqli_query($conn, "DELETE FROM menu WHERE id = '$id'");
    if($query){
        unlink("../assets/img/$foto");
        $massage = '<script>alert("sukses menghapus data");
        window.location="../frontend/menu"</script>';
    }else{
        $massage = '<script>alert("gagal menghapus data")
         window.location="../frontend/menu"</script>';
    }
}echo $massage;
?>