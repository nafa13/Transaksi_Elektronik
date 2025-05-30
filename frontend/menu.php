<?php
include "../backend/backend.php";
$query = mysqli_query($conn, "SELECT *FROM menu
  LEFT JOIN tb_kategori_menu ON tb_kategori_menu.id_kat_menu = menu.kategori");
while ($record = mysqli_fetch_array($query)) {
  $result[] = $record;
}

$select_kat_menu = mysqli_query($conn, "SELECT id_kat_menu,kategori_menu FROM tb_kategori_menu");
?>
<div class="col-lg-9 mt-3">
  <div class="card">
    <div class="card-header bg-success text-light">
      <div class="row">
        <div class="col d-flex justify-content-between">
          <h5 class="mt-2">Halaman Menu</h5>
          <button class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#modaltambahuser"> Tambah Menu</button>
        </div>
      </div>
    </div>
    <div class="card-body">



      <!-- Modal tambah Menu-->
      <div class="modal fade" id="modaltambahuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="needs-validation" novalidate action="../backend/proses_input_menu.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" id="uploadfoto" placeholder="your name" name="foto" required>
                      <label class="input-group-text" for="uploadfoto">Upload foto</label>
                      <div class="invalid-feedback py-3">
                        Masukan foto.
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingInput" placeholder="nama menu" name="nama_menu" required>
                      <label for="floatingInput">Nama Menu</label>
                      <div class="invalid-feedback">
                        Masukan Nama Menu.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="keterangan" name="keterangan">
                    <label for="floatingpassword">Keterangan</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-floating mb-3">
                      <select class="form-select" aria-label="Default select example" name="kat_menu" required>
                        <option selected hidden value="">Pilih Kategori Menu</option>
                        <?php
                        foreach ($select_kat_menu as $value) {
                          echo "<option value= " . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                        }
                        ?>
                      </select>
                      <label for="floatingInput">Kategori</label>
                      <div class="invalid-feedback">
                        Pilih Kategori.
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-floating mb-3">
                      <input type="number" class="form-control" id="floatingInput" placeholder="harga" name="harga" required>
                      <label for="floatingInput">Harga</label>
                      <div class="invalid-feedback">
                        Masukan Harga.
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-floating mb-3">
                      <input type="number" class="form-control" id="floatingInput" placeholder="stok" name="stok" required>
                      <label for="floatingInput">Stok</label>
                      <div class="invalid-feedback">
                        Masukan Stok.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="input_menu_validate" value="1234">Save changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- akhir modal tambah menu-->
      <?php
      if (empty($result)) {
        echo "data menu tdak ada";
      } else {
        foreach ($result as $row) {
      ?>

          <!-- Modal view Menu-->
          <div class="modal fade" id="modalview<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-fullscreen-md-down">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="needs-validation" novalidate action="../backend/proses_input_menu.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-floating mb-3">
                          <input disabled type="text" class="form-control" id="floatingInput" value="<?php echo $row['nama_menu'] ?>">
                          <label for="floatingInput">Nama Menu</label>
                          <div class="invalid-feedback">
                            Masukan Nama Menu.
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="floatingInput" value="<?php echo $row['keterangan'] ?>">
                        <label for="floatingpassword">Keterangan</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-floating mb-3">
                          <select disabled class="form-select" aria-label="Default select example">
                            <option selected hidden value="">Pilih Kategori Menu</option>
                            <?php
                            foreach ($select_kat_menu as $value) {
                              if ($row['kategori'] == $value['id_kat_menu']) {
                                echo "<option selected value= " . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                              } else {
                                echo "<option value= " . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                              }
                            }
                            ?>
                          </select>
                          <label for="floatingInput">Kategori</label>
                          <div class="invalid-feedback">
                            Pilih Kategori.
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-floating mb-3">
                          <input disabled type="number" class="form-control" id="floatingInput" value="<?php echo $row['harga'] ?>">
                          <label for="floatingInput">Harga</label>
                          <div class="invalid-feedback">
                            Masukan Harga.
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-floating mb-3">
                          <input disabled type="number" class="form-control" id="floatingInput" value="<?php echo $row['stok'] ?>">
                          <label for="floatingInput">Stok</label>
                          <div class="invalid-feedback">
                            Masukan Stok.
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- akhir modal view menu-->

          <!-- Modal edit Menu-->
          <div class="modal fade" id="modaledit<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-fullscreen-md-down">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="needs-validation" novalidate action="../backend/proses_edit_menu.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="input-group mb-3">
                          <input type="file" class="form-control" id="uploadfoto" placeholder="your name" name="foto" required>
                          <label class="input-group-text" for="uploadfoto">Upload foto</label>
                          <div class="invalid-feedback py-3">
                            Masukan foto.
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="floatingInput" placeholder="nama menu" name="nama_menu" required value="<?php echo $row['nama_menu'] ?>">
                          <label for="floatingInput">Nama Menu</label>
                          <div class="invalid-feedback">
                            Masukan Nama Menu.
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="keterangan" name="keterangan" value="<?php echo $row['keterangan'] ?>">
                        <label for="floatingpassword">Keterangan</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-floating mb-3">
                          <select class="form-select" aria-label="Default select example" name="kat_menu">
                            <option selected hidden value="">Pilih Kategori Menu</option>
                            <?php
                            foreach ($select_kat_menu as $value) {
                              if ($row['kategori'] == $value['id_kat_menu']) {
                                echo "<option selected value= " . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                              } else {
                                echo "<option value= " . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                              }
                            }
                            ?>
                          </select>
                          <label for="floatingInput">Kategori Minuman</label>
                          <div class="invalid-feedback">
                            Pilih Kategori.
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-floating mb-3">
                          <input type="number" class="form-control" id="floatingInput" placeholder="harga" name="harga" required value="<?php echo $row['harga'] ?>">
                          <label for="floatingInput">Harga</label>
                          <div class="invalid-feedback">
                            Masukan Harga.
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-floating mb-3">
                          <input type="number" class="form-control" id="floatingInput" placeholder="stok" name="stok" required value="<?php echo $row['stok'] ?>">
                          <label for="floatingInput">Stok</label>
                          <div class="invalid-feedback">
                            Masukan Stok.
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" name="input_menu_validate" value="1234">Save changes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- akhir modal edit menu-->

          <!-- Modal Delete-->
          <div class="modal fade" id="modaldelete<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-fullscreen-md-down">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data Menu</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="needs-validation" novalidate action="../backend/proses_delete_menu.php" method="POST">
                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                    <input type="hidden" value="<?php echo $row['foto'] ?>" name="foto">
                    <div class="col-lg-12">
                      Apakah anda ingin menghapus data menu ini? <b><?php echo $row['nama_menu'] ?></b>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-danger" name="delete_menu_validate" value="1234">Hapus</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- akhir modal Delete -->

        <?php
        }


        ?>
        <div class=" table-responsive">
          <table class="table table-hover">
            <thead>
              <tr class="text-nowrap">
                <th scope="col">No</th>
                <th scope="col">Foto</th>
                <th scope="col">Nama Menu</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Jenis Menu</th>
                <th scope="col">Kategori</th>
                <th scope="col">Harga</th>
                <th scope="col">Stok</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($result as $row) {
              ?>
                <tr>
                  <th scope="row"><?php echo $no++ ?></th>
                  <td>
                    <div style="width: 90px">
                      <img src="../assets/img/<?php echo $row['foto'] ?>" class="img-thumbnail" alt="...">
                    </div>
                  </td>
                  <td><?php echo $row['nama_menu'] ?></td>
                  <td><?php echo $row['keterangan'] ?></td>
                  <td><?php echo ($row['jenis_menu'] == 1) ? 'Buah' : 'Sayur' ?></td>
                  <td><?php echo $row['kategori_menu'] ?></td>
                  <td><?php echo $row['harga'] ?></td>
                  <td><?php echo $row['stok'] ?></td>

                  <td>
                    <div class="d-flek">
                      <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalview<?php echo $row['id'] ?> "><i class="bi bi-eye"></i></button>
                      <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modaledit<?php echo $row['id'] ?> "><i class="bi bi-pencil-square"></i></i></button>
                      <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modaldelete<?php echo $row['id'] ?> "><i class="bi bi-trash"></i></button>
                    </div>
                  </td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</div>