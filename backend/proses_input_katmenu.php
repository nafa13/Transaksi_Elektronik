<?php
include "backend.php";
$jenismenu = (isset($_POST['jenismenu'])) ? htmlentities($_POST['jenismenu']) : "";
$katmenu = (isset($_POST['katmenu'])) ? htmlentities($_POST['katmenu']) : "";

if (!empty($_POST['input_katmenu_validate'])) {
    $select = mysqli_query($conn, "SELECT kategori_menu FROM tb_kategori_menu WHERE kategori_menu= '$katmenu'");
    if (mysqli_num_rows($select) > 0) {
        $massage = '<script>alert("kategori telah ada ");
        window.location="../frontend/katmenu"</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_kategori_menu (jenis_menu,kategori_menu) values('$jenismenu','$katmenu')");
        if ($query) {
            $massage = '<script>alert("sukses memasukandata data");
        window.location="../frontend/katmenu"</script>';
        } else {
            $massage = '<script>alert("gagal memasukan data")</script>
            window.location="../frontend/katmenu"</script>';
        }
    }
}
echo $massage;
