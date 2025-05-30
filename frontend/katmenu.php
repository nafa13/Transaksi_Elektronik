<?php
include "../backend/backend.php";
$query = mysqli_query($conn, "SELECT *FROM tb_kategori_menu");
while ($record = mysqli_fetch_array($query)) {
  $result[] = $record;
}
?>
<div class="col-lg-9 mt-3">
  <div class="card">
    <div class="card-header bg-success ">
      <div class="row">
        <div class="col d-flex justify-content-between">
          <h5 class="text-light mt-2">Halaman Kategori Menu</h5>
          <button class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#modaltambahuser"> Tambah Kategori Menu</button>
        </div>
      </div>

    </div>
    <div class="card-body">

      <!-- Modal tambah kategori menu-->
      <div class="modal fade" id="modaltambahuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori Menu</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="needs-validation" novalidate action="../backend/proses_input_katmenu.php" method="POST">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-floating mb-3">
                      <select class="form-select" name="jenismenu" id="">
                        <?php
                        $data = array("Buah", "Sayur");
                        foreach ($data as $key => $value) {
                          if ($row['jenis_menu'] == $key + 1) {
                            echo "<option selected value=" . ($key + 1) . ">$value</option>";
                          } else {
                            echo "<option value=" . ($key + 1) . ">$value</option>";
                          }
                        }
                        ?>
                      </select>
                      <label for="floatingInput">Kategori Menu</label>
                      <div class="invalid-feedback">
                        Masukan Kategori Menu.
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingInput" placeholder="Kategori Menu" name="katmenu" required>
                      <label for="floatingInput">Jenis Menu</label>
                      <div class="invalid-feedback">
                        Masukan Jenis Menu.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="input_katmenu_validate" value="1234">Save Changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- akhir modal tambah kategori menu-->
      <?php
      foreach ($result as $row) {
      ?>

        <!-- Modal edit-->
        <div class="modal fade" id="modaledit<?php echo $row['id_kat_menu'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-fullscreen-md-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Kategori Menu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="needs-validation" novalidate action="../backend/proses_edit_katmenu.php" method="POST">
                  <input type="hidden" value="<?php echo $row['id_kat_menu'] ?>" name="id">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-floating mb-3">
                        <select class="form-select" aria-label="default select example" required name="jenismenu" id="">
                          <?php
                          $data = array("Buah", "Sayur");
                          foreach ($data as $key => $value) {
                            if ($row['jenis_menu'] == $key + 1) {
                              echo "<option selected value=" . ($key + 1) . ">$value</option>";
                            } else {
                              echo "<option value=" . ($key + 1) . ">$value</option>";
                            }
                          }
                          ?>
                        </select>
                        <label for="floatingInput">Kategori Menu</label>
                        <div class="invalid-feedback">
                          Masukan Jenis Menu.
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Kategori Menu" name="katmenu" required value="<?php echo $row['kategori_menu'] ?>">
                        <label for="floatingInput">Jenis Menu</label>
                        <div class="invalid-feedback">
                          Masukan Kategori Menu.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="input_katmenu_validate" value="1234">Save changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- akhir modal edit -->
        <!-- Modal Delete-->
        <div class="modal fade" id="modaldelete<?php echo $row['id_kat_menu'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md modal-fullscreen-md-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data kategori Menu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="needs-validation" novalidate action="../backend/proses_delete_katmenu.php" method="POST">
                  <input type="hidden" value="<?php echo $row['id_kat_menu'] ?>" name="id">
                  <div class="col-lg-12">
                    Apakah Anda Ingin Menghapus Kategori <b><?php echo $row['kategori_menu'] ?></b>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" name="hapus_kategori_validate" value="1234">Hapus</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- akhir modal Delete -->

      <?php
      }
      if (empty($result)) {
        echo "data user tdak ada";
      } else {

      ?>
        <!-- table katmenu -->
        <div class=" table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Kategori Menu</th>
                <th scope="col">Jenis Menu</th>
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
                  <td><?php echo ($row['jenis_menu'] == 1) ? "Buah" : "Sayuran" ?></td>
                  <td><?php echo $row['kategori_menu']; ?></td>
                  <td class="d-flek">
                    <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modaledit<?php echo $row['id_kat_menu'] ?> "><i class="bi bi-pencil-square"></i></i></button>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modaldelete<?php echo $row['id_kat_menu'] ?> "><i class="bi bi-trash"></i></button>
                  </td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
        <!-- akhir table katmenu -->
      <?php
      }
      ?>
    </div>
  </div>
</div>