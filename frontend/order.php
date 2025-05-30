<?php
include "../backend/backend.php";
$query = mysqli_query($conn, "SELECT tb_order.*,tb_bayar.*,nama, SUM(harga*jumlah) AS harganya FROM tb_order
  LEFT JOIN user ON user.id = tb_order.pelayan
  LEFT JOIN tb_list_order ON tb_list_order.kode_order = tb_order.id_order
  LEFT JOIN menu ON menu.id = tb_list_order.menu
   LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
  GROUP BY id_order
  ");
while ($record = mysqli_fetch_array($query)) {
  $result[] = $record;
}

// $select_kat_menu = mysqli_query($conn, "SELECT id_kat_menu,kategori_menu FROM tb_kategori_menu");
?>
<div class="col-lg-9 mt-3">
  <div class="card">
    <div class="card-header">
      Halaman Order
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col d-flex justify-content-end">
          <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modaltambahuser"> Tambah Order</button>
        </div>
      </div>
      <!-- Modal tambah order-->
      <div class="modal fade" id="modaltambahuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Order</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="needs-validation" novalidate action="../backend/proses_input_order.php" method="POST">
                <div class="row">
                  <div class="col-lg-3">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="kode_order" name="kode_order" value="<?php echo date('ymdHi') . rand(100, 999) ?>" readonly>
                      <label for="uploadfoto">Kode Order</label>
                      <div class="invalid-feedback">
                        Masukan Kode Order
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-floating mb-2">
                      <input type="number" class="form-control" id="meja" placeholder="nomor meja" name="meja" required>
                      <label for="meja">Meja</label>
                      <div class="invalid-feedback">
                        Masukan No Meja
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-7">
                    <div class="form-floating mb-2">
                      <input type="text" class="form-control" id="pelanggan" placeholder="nama pelanggan" name="pelanggan" required>
                      <label for="pelanggan">Nama Pelanggan</label>
                      <div class="invalid-feedback">
                        Masukan Nana Pelanggan
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="catatan" placeholder="catatan" name="catatan">
                    <label for="catatan">Catatan</label>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="input_order_validate" value="1234">Buat Order</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- akhir modal tambah order-->
      <?php
      if (empty($result)) {
        echo "data menu tdak ada";
      } else {
        foreach ($result as $row) {
      ?>

          <!-- Modal edit Menu-->
          <div class="modal fade" id="modaledit<?php echo $row['id_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-fullscreen-md-down">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Order</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="needs-validation" novalidate action="../backend/proses_edit_order.php" method="POST">
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="form-floating mb-3">
                          <input readonly type="text" class="form-control" id="kode_order" name="kode_order" value="<?php echo $row['id_order'] ?>" readonly>
                          <label for="uploadfoto">Kode Order</label>
                          <div class="invalid-feedback">
                            Masukan Kode Order
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-2">
                        <div class="form-floating mb-2">
                          <input type="number" class="form-control" id="meja" placeholder="nomor meja" name="meja" value="<?php echo $row['meja'] ?>" required>
                          <label for="meja">Meja</label>
                          <div class="invalid-feedback">
                            Masukan No Meja
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <div class="form-floating mb-2">
                          <input type="text" class="form-control" id="pelanggan" placeholder="nama pelanggan" name="pelanggan" value="<?php echo $row['pelanggan'] ?>" required>
                          <label for="pelanggan">Nama Pelanggan</label>
                          <div class="invalid-feedback">
                            Masukan Nana Pelanggan
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" name="edit_order_validate" value="1234">Edit Order</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- akhir modal edit menu-->

          <!-- Modal Delete-->
          <div class="modal fade" id="modaldelete<?php echo $row['id_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-fullscreen-md-down">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data Menu</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="needs-validation" novalidate action="../backend/proses_delete_order.php" method="POST">
                    <input type="hidden" value="<?php echo $row['id_order'] ?>" name="kode_order">
                    <div class="col-lg-12">
                      Apakah anda ingin menghapus order atas nama ? <b><?php echo $row['pelanggan'] ?></b>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-danger" name="delete_order_validate" value="1234">Hapus</button>
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
                <th scope="col">Kode Order</th>
                <th scope="col">Pelanggan</th>
                <th scope="col">Meja</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Pelayan</th>
                <th scope="col">Status</th>
                <th scope="col">Waktu Order</th>
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
                  <td><?php echo $row['id_order'] ?></td>
                  <td><?php echo $row['pelanggan'] ?></td>
                  <td><?php echo $row['meja'] ?></td>
                  <td><?php echo number_format((int)$row['harganya'], 0, ',', '.')  ?></td>
                  <td><?php echo $row['nama'] ?></td>
                  <td><?php echo (!empty($row['id_bayar'])) ? "<span class='badge text-bg-success'>dibayar</span>" : "" ; ?></td>
                  <td><?php echo $row['waktu_order'] ?></td>
                  <td>
                    <div class="d-flek">
                      <a class="btn btn-info btn-sm me-1" href="./?x=orderitem&order=<?php echo $row['id_order'] . "&meja=" . $row['meja'] . "&pelanggan=" . $row['pelanggan'] ?>"><i class="bi bi-eye"></i></a>
                      <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-sm me-1 btn-secondary disabled" : "btn btn-warning btn-sm me-1"; ?> " data-bs-toggle="modal" data-bs-target="#modaledit<?php echo $row['id_order'] ?> "><i class="bi bi-pencil-square"></i></i></button>
                      <button class=" <?php echo (!empty($row['id_bayar'])) ? "btn btn-sm me-1 btn-secondary disabled " : "btn btn-danger btn-sm me-1"; ?>" data-bs-toggle="modal" data-bs-target="#modaldelete<?php echo $row['id_order'] ?> "><i class="bi bi-trash"></i></button>
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