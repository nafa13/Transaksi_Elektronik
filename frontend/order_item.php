<?php
include "../backend/backend.php";
$query = mysqli_query($conn, "SELECT *, SUM(harga*jumlah) AS harganya FROM tb_list_order
  LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order
  LEFT JOIN menu ON menu.id = tb_list_order.menu
  LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
  GROUP BY id_list_order
  HAVING tb_list_order.kode_order = $_GET[order]");

$kode = $_GET['order'];
$meja = $_GET['meja'];
$pelanggan = $_GET['pelanggan'];

while ($record = mysqli_fetch_array($query)) {
  $result[] = $record;
  // $kode = $record['id_order'];
  // $meja = $record['meja'];
  // $pelanggan = $record['pelanggan'];
}

$select_menu = mysqli_query($conn, "SELECT id,nama_menu FROM menu");
?>
<div class="col-lg-9 mt-3">
  <div class="card">
    <div class="card-header">
      Halaman Order Item
    </div>
    <div class="card-body">
      <a href="order" class="btn btn-dark mb-2">Back</a>
      <div class="row">
        <div class="col-lg-3">
          <div class="form-floating mb-3">
            <input disabled type="text" class="form-control" id="kodeorder" value="<?php echo $kode; ?>">
            <label for="uploadfoto">Kode Order</label>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="form-floating mb-3">
            <input disabled type="text" class="form-control" id="meja" value="<?php echo $meja; ?>">
            <label for="uploadfoto">Meja</label>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="form-floating mb-3">
            <input disabled type="text" class="form-control" id="pelanggan" value="<?php echo $pelanggan; ?>">
            <label for="uploadfoto">Pelanggan</label>
          </div>
        </div>
      </div>

      <!-- Modal tambah Item-->
      <div class="modal fade" id="tambahitem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="needs-validation" novalidate action="../backend/proses_input_order_item.php" method="POST">
                <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                <input type="hidden" name="meja" value="<?php echo $meja ?>">
                <input type="hidden" name="pelanggan" value="<?php echo $kode ?>">
                <div class="row">
                  <div class="col-lg-9">
                    <div class="form-floating">
                      <select class="form-select" name="menu" id="">
                        <option selected hidden value="">Pilih Menu</option>
                        <?php
                        foreach ($select_menu as $value) {
                          echo "<option value='" . $value['id'] . "'>" . $value['nama_menu'] . "</option>";
                        }
                        ?>
                      </select>
                      <label for="menu">Menu Minuman</label>
                      <div class="invalid-feedback py-3">
                        Pilih Menu
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-floating mb-3">
                      <input type="number" class="form-control" id="floatinginput" placeholder="jumlah porsi" name="jumlah" required>
                      <label for="floatingInput">Jumlah Porsi</label>
                      <div class="invalid-feedback">
                        Masukan Jumlah Porsi.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="catatan" name="catatan">
                    <label for="floatingpassword">Catatan</label>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="input_order_item_validate" value="1234">Save changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- akhir modal tambah Item-->
      <?php
      if (empty($result)) {
        echo "data menu tdak ada";
      } else {
        foreach ($result as $row) {
      ?>
          <!-- Modal edit Menu-->
          <div class="modal fade" id="modaledit<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-fullscreen-md-down">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="needs-validation" novalidate action="../backend/proses_edit_order_item.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id_list_order'] ?>">
                    <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                    <input type="hidden" name="meja" value="<?php echo $meja ?>">
                    <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                    <div class="row">
                      <div class="col-lg-9">
                        <div class="form-floating">
                          <select class="form-select" name="menu" id="">
                            <option selected hidden value="">Pilih Menu</option>
                            <?php
                            foreach ($select_menu as $value) {
                              if ($row['menu'] == $value['id']) {
                                echo "<option selected value='" . $value['id'] . "'>" . $value['nama_menu'] . "</option>";
                              } else {
                                echo "<option value='" . $value['id'] . "'>" . $value['nama_menu'] . "</option>";
                              }
                            }
                            ?>
                          </select>
                          <label for="menu">Menu Minuman</label>
                          <div class="invalid-feedback py-3">
                            Pilih Menu
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-floating mb-3">
                          <input type="number" class="form-control" id="floatinginput" placeholder="jumlah porsi" name="jumlah" required value="<?php echo $row['jumlah'] ?>">
                          <label for="floatingInput">Jumlah Porsi</label>
                          <div class="invalid-feedback">
                            Masukan Jumlah Porsi.
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="catatan" name="catatan" value="<?php echo $row['catatan'] ?>">
                        <label for="floatingpassword">Catatan</label>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" name="edit_order_item_validate" value="1234">Save changes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- akhir modal edit menu-->

          <!-- Modal Delete-->
          <div class="modal fade" id="modaldelete<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-fullscreen-md-down">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data Menu</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="needs-validation" novalidate action="../backend/proses_delete_order_item.php" method="POST">
                    <input type="hidden" value="<?php echo $row['id_list_order'] ?>" name="id">
                    <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                    <input type="hidden" name="meja" value="<?php echo $meja ?>">
                    <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                    <div class="col-lg-12">
                      Apakah anda ingin menghapus data menu ini? <b><?php echo $row['nama_menu'] ?></b>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-danger" name="delete_order_item_validate" value="1234">Hapus</button>
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

        <!-- Modal bayar Item-->
        <div class="modal fade" id="bayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-fullscreen-md-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <div class=" table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr class="text-nowrap">
                        <th scope="col">Menu</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Status</th>
                        <th scope="col">Catatan</th>
                        <th scope="col">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $total = 0;
                      foreach ($result as $row) {
                      ?>
                        <tr>
                          <td><?php echo $row['nama_menu'] ?></td>
                          <td>
                            <?php echo number_format($row['harga'], 0, ',', '.') ?>
                          </td>
                          <td><?php echo $row['jumlah'] ?></td>
                          <td><?php echo $row['status'] ?></td>
                          <td><?php echo $row['catatan'] ?></td>
                          <td>
                            <?php echo number_format($row['harganya'], 0, ',', '.') ?>
                          </td>
                        </tr>
                      <?php
                        $total += $row['harganya'];
                      }
                      ?>
                      <tr>
                        <td class="fw-bold" colspan="5">Total Harga</td>
                        <td><?php echo number_format($total, 0, ',', '.') ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <span class="text-danger fs-5 fw-semibold">Apakah anda yakin ingin melakukan pembayaran?</span>
                <form class="needs-validation" novalidate action="../backend/proses_bayar.php" method="POST">
                  <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                  <input type="hidden" name="meja" value="<?php echo $meja ?>">
                  <input type="hidden" name="pelanggan" value="<?php echo $kode ?>">
                  <input type="hidden" name="total" value="<?php echo $total ?>">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatinginput" placeholder="nominal uang" name="uang" required>
                        <label for="floatingInput">Nominal Uang</label>
                        <div class="invalid-feedback">
                          Masukan Nominal Uang.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mb-2">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" name="bayar_validate" value="1234">Bayar</button>
                      </div>
              </div>
              </form>
            </div>
          </div>
        </div>
    </div>
    <!-- akhir modal bayar Item-->

    <div class=" table-responsive">
      <table class="table table-hover">
        <thead>
          <tr class="text-nowrap">
            <th scope="col">Menu</th>
            <th scope="col">Harga</th>
            <th scope="col">Qty</th>
            <th scope="col">Status</th>
            <th scope="col">Catatan</th>
            <th scope="col">Total</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $total = 0;
          foreach ($result as $row) {
          ?>
            <tr>
              <td><?php echo $row['nama_menu'] ?></td>
              <td>
                <?php echo number_format($row['harga'], 0, ',', '.') ?>
              </td>
              <td><?php echo $row['jumlah'] ?></td>
              <td><?php echo $row['status'] ?></td>
              <td><?php echo $row['catatan'] ?></td>
              <td>
                <?php echo number_format($row['harganya'], 0, ',', '.') ?>
              <td>
                <div class="d-flek">
                  <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-sm me-1 btn-secondary disabled" : "btn btn-warning btn-sm me-1" ;?> " data-bs-toggle="modal" data-bs-target="#modaledit<?php echo $row['id_list_order'] ?> "><i class="bi bi-pencil-square"></i></i></button>
                  <button class=" <?php echo (!empty($row['id_bayar'])) ? "btn btn-sm me-1 btn-secondary disabled" : "btn btn-danger btn-sm me-1" ;?>" data-bs-toggle="modal" data-bs-target="#modaldelete<?php echo $row['id_list_order'] ?> "><i class="bi bi-trash"></i></button>
                </div>
              </td>
            </tr>
          <?php
            $total += $row['harganya'];
          }
          ?>
          <tr>
            <td class="fw-bold" colspan="5">Total Harga</td>
            <td><?php echo number_format($total, 0, ',', '.') ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  <?php
      }
  ?>
  <div class="container mb-2">
    <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : "btn btn-primary" ;?>" data-bs-toggle="modal" data-bs-target="#tambahitem">Item</button>
    <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : "btn btn-success" ;?>" data-bs-toggle="modal" data-bs-target="#bayar">Bayar</button>
  </div>
  </div>
</div>
</div>