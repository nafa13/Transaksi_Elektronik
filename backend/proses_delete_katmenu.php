<?php
include "backend.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";


if (!empty($_POST['hapus_kategori_validate'])){
    $select = mysqli_query($conn, "SELECT kategori FROM menu WHERE kategori= '$id'");
    if (mysqli_num_rows($select) > 0) {
        $massage = '<script>alert("kategori telah digunakan pada daftar menu. kategori tidak dapat dihapus");
        window.location="../frontend/katmenu"</script>';
    }else{
    $query = mysqli_query($conn, "DELETE FROM tb_kategori_menu WHERE id_kat_menu = '$id'");
    if($query){
        $massage = '<script>alert("sukses menghapus data");
        window.location="../frontend/katmenu"</script>';
    }else{
        $massage = '<script>alert("gagal menghapus data")
        window.location="../frontend/katmenu"</script>';
    }
}
}echo $massage;
?>