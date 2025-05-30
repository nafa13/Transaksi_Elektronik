<?php
include "backend.php";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";


if (!empty($_POST['delete_order_validate'])) {
    $select = mysqli_query($conn, "SELECT kode_order FROM tb_list_order WHERE kode_order ='$kode_order'");
    if (mysqli_num_rows($select) > 0) {
        $massage = '<script>alert(order telah memiliki item order, data ini tidak dapat di hapus ")
        window.location="../frontend/order"</script>';
    } else {
        $query = mysqli_query($conn, "DELETE FROM tb_order WHERE id_order = '$kode_order'");
        if ($query) {
            $massage = '<script>alert("sukses menghapus data")
        window.location="../frontend/order"</script>';
        } else {
            $massage = '<script>alert("gagal menghapus data")
        window.location="../frontend/order"</script>';
        }
    }
}



echo $massage;

