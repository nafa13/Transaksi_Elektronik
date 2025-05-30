<?php
include "backend.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$nama_menu = (isset($_POST['nama_menu'])) ? htmlentities($_POST['nama_menu']) : "";
$keterangan = (isset($_POST['keterangan'])) ? htmlentities($_POST['keterangan']) : "";
$kat_menu = (isset($_POST['kat_menu'])) ? htmlentities($_POST['kat_menu']) : "";
$harga = (isset($_POST['harga'])) ? htmlentities($_POST['harga']) : "";
$stok = (isset($_POST['stok'])) ? htmlentities($_POST['stok']) : "";


$kode_rndm = rand(10000, 99999) . "-";
$target_dir = "../assets/img/" . $kode_rndm;
$target_file = $target_dir . basename($_FILES["foto"]["name"]);
$imgtype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (!empty($_POST['input_menu_validate'])) {

    //cek apakah file gambar?
    $cek  = getimagesize($_FILES['foto']['tmp_name']);
    if ($cek === false) {
        $massage = "ini bukan file gambar";
        $statusUpload = 0;
    } else {
        $statusUpload = 1;
        if (file_exists($target_file)) {
            $massage = "file sudah ada";
            $statusUpload = 0;
        } else {
            if ($_FILES["foto"]['size'] > 500000) { //500kb
                $massage = "file foto yang di upload terlalu besar";
                $statusUpload = 0;
            } else {
                if ($imgtype != "jpg" and $imgtype != "png" and $imgtype != "jpeg") {
                    $massage = "hanya diperbolehkan gambar dengan format JPG,PNG,JPEG";
                    $statusUpload = 0;
                }
            }
        }
    }

    if ($statusUpload == 0) {
        $massage = '<script>alert("' . $massage . ',gambar tidak dapat di upload");
        window.location="../frontend/menu"</script>';
    } else {
        $select = mysqli_query($conn, "SELECT *FROM menu WHERE nama_menu= '$nama_menu'");
        if (mysqli_num_rows($select) > 0) {
            $massage = '<script>alert("Nama menu telah ada ");
        window.location="../frontend/menu"</script>';
        } else {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                $query = mysqli_query($conn, "UPDATE menu SET foto='".$kode_rndm.$_FILES['foto']['name']."',nama_menu='$nama_menu',keterangan='$keterangan',kategori='$kat_menu',harga='$harga',stok='$stok' WHERE id='$id'");
                if ($query) {
                    $massage = '<script>alert("sukses memasukandata data");
        window.location="../frontend/menu"</script>';
                } else {
                    $massage = '<script>alert("gagal memasukandata data");
                    window.location="../frontend/menu"</script>';
                }
            } else {
                $massage = '<script>alert("maaf terjadi kesalahan file tidak dapat di upload");
                    window.location="../frontend/menu"</script>';
            }
        }
    }
}
echo $massage;
