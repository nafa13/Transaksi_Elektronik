<?php
include "../backend/backend.php";
$query = mysqli_query($conn, "SELECT *FROM user");
while ($record = mysqli_fetch_array($query)) {
  $result[] = $record;
}
?>
<div class="col-lg-9 mt-3">
  <div class="card">
    <div class="card-header">
      Halaman User
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col d-flex justify-content-end">
          <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modaltambahuser"> Tambah User</button>
        </div>
      </div>
      <!-- Modal tambah user-->
      <div class="modal fade" id="modaltambahuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="needs-validation" novalidate action="../backend/proses_input_user.php" method="POST">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingInput" placeholder="your name" name="nama" required>
                      <label for="floatingInput">Nama</label>
                      <div class="invalid-feedback">
                        Masukan Nama.
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-floating mb-3">
                      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" required>
                      <label for="floatingInput">Username</label>
                      <div class="invalid-feedback">
                        Masukan Username.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-floating mb-3">
                      <select class="form-select" aria-label="Default select example" name="level" required>
                      <?php
                        $data =array("admin","kasir","pelayan","dapur");
                        foreach($data as $key => $value){
                          if($row['level'] == $key+1){
                            echo "<option selected value=".($key+1).">$value</option>";
                          }else{
                            echo "<option value=".($key+1).">$value</option>";
                          }
                        }
                        ?>
                      </select>
                      <label for="floatingInput">Level User</label>
                      <div class="invalid-feedback">
                        Pilih Level User.
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-8">
                    <div class="form-floating mb-3">
                      <input type="number" class="form-control" id="floatingInput" placeholder="08xxxxx" name="nohp">
                      <label for="floatingInput">Nohp</label>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingInput" placeholder="password" value="12345" name="password" >
                    <label for="floatingpassword">Password</label>
                  </div>
                </div>
                <div class="form-floating">
                  <textarea class="form-control" id="" style="height: 100px;" name="alamat"></textarea>
                  <label for="floatinginput">Alamat</label>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="input_user_validate" value="1234">Save changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- akhir modal tambah user-->
      <?php
      foreach ($result as $row) {
      ?>
        <!-- Modal view-->
        <div class="modal fade" id="modalview<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-fullscreen-md-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="needs-validation" novalidate action="../backend/proses_input.php" method="POST">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="floatingInput" placeholder="your name" name="nama" value="<?php echo $row['nama'] ?>">
                        <label for="floatingInput">Nama</label>
                        <div class="invalid-feedback">
                          Masukan Nama.
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-floating mb-3">
                        <input disabled type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" value="<?php echo $row['username'] ?>">
                        <label for="floatingInput">Username</label>
                        <div class="invalid-feedback">
                          Masukan Username.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-floating mb-3">
                      <select disabled class="form-select" aria-label="default select example" required name="level" id="">
                      <?php
                          $data = array('admin', 'pelayan', 'kasir', 'dapur');
                          foreach($data as $key => $value){
                              $selected = ($row['level'] == $key + 1) ? 'selected' : '';
                              echo "<option value='".($key+1)."' $selected>$value</option>";
                          }
                          ?>

                        </select>
                        <label for="floatingInput">Level User</label>
                        <div class="invalid-feedback">
                          Pilih Level User.
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-8">
                      <div class="form-floating mb-3">
                        <input disabled type="number" class="form-control" id="floatingInput" placeholder="08xxxxx" name="nohp" value="<?php echo $row['nohp'] ?>">
                        <label for="floatingInput">Nohp</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-floating">
                    <textarea disabled class="form-control" id="" style="height: 100px;" name="alamat"><?php echo $row['alamat'] ?></textarea>
                    <label for="floatinginput">Alamat</label>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- akhir modal view -->

        <!-- Modal edit-->
        <div class="modal fade" id="modaledit<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-fullscreen-md-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="needs-validation" novalidate action="../backend/proses_edit.php" method="POST">
                <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="your name" name="nama" required value="<?php echo $row['nama'] ?>">
                        <label for="floatingInput">Nama</label>
                        <div class="invalid-feedback">
                          Masukan Nama.
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-floating mb-3">
                        <input <?php echo ($row['username'] == $_SESSION['username_kopiku']) ? 'disabled' : '' ;; ?> type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" required value="<?php echo $row['username'] ?>">
                        <label for="floatingInput">Username</label>
                        <div class="invalid-feedback">
                          Masukan Username.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-floating mb-3">
                        <select class="form-select" aria-label="default select example" required name="level" id="">
                        <?php
                        $data =array("admin","kasir","pelayan","dapur");
                        foreach($data as $key => $value){
                          if($row['level'] == $key+1){
                            echo "<option selected value=".($key+1).">$value</option>";
                          }else{
                            echo "<option value=".($key+1).">$value</option>";
                          }
                        }
                        ?>
                        </select>
                        <label for="floatingInput">Level User</label>
                        <div class="invalid-feedback">
                          Pilih Level User.
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-8">
                      <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" placeholder="08xxxxx" name="nohp" value="<?php echo $row['nohp'] ?>">
                        <label for="floatingInput">Nohp</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-floating">
                    <textarea class="form-control" id="" style="height: 100px;" name="alamat"><?php echo $row['alamat'] ?></textarea>
                    <label for="floatinginput">Alamat</label>
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="input_user_validate" value="1234">Save changes</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- akhir modal edit -->
        <!-- Modal Delete-->
        <div class="modal fade" id="modaldelete<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md modal-fullscreen-md-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="needs-validation" novalidate action="../backend/proses_delete.php" method="POST">
                <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                <div class="col-lg-12">
                  <?php
                  if ($row['username'] == $_SESSION['username_kopiku']){
                    echo "<div class='alert alert-danger'>Anda tidak bisa menghapus akun sendiri!</div>";
                  }else {
                    echo "Apakah Anda Yakin Ingin Menghapus Data User <b>$row[username] ?</b>";
                  }
                  ?>
                  
                </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger" name="delete_user_validate" value="1234" 
                  <?php echo ($row['username'] == $_SESSION['username_kopiku']) ? 'disabled' : '' ; ?>>Hapus</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- akhir modal Delete -->

        <!-- Modal Reset Password-->
        <div class="modal fade" id="modalresetpassword<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md modal-fullscreen-md-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="needs-validation" novalidate action="../backend/proses_reset_pw.php" method="POST">
                <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                <div class="col-lg-12">
                  <?php
                  if ($row['username'] == $_SESSION['username_kopiku']){
                    echo "<div class='alert alert-danger'>Anda tidak bisa mereset password sendiri!</div>";
                  }else {
                    echo "Apakah Anda Yakin Ingin Mereset password <b>$row[username] menjadi password bawaan ? </b>";
                  }
                  ?>
                  
                </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success" name="input_user_validate" value="1234" 
                  <?php echo ($row['username'] == $_SESSION['username_kopiku']) ? 'disabled' : '' ; ?>>Reset Password </button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- akhir modal Reset Password-->
      <?php
      }
      if (empty($result)) {
        echo "data user tdak ada";
      } else {

      ?>
        <div class=" table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Level</th>
                <th scope="col">No HP</th>
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
                  <td><?php echo $row['nama']; ?></td>
                  <td><?php echo $row['username']; ?></td>
                  <td><?php
                      if ($row['level'] == 1) {
                        echo "admin";
                      } elseif ($row['level'] == 2) {
                        echo "kasir";
                      } elseif ($row['level'] == 3) {
                        echo "pelayan";
                      } elseif ($row['level'] == 4) {
                        echo "dapur";
                      }
                      ?></td>
                  <td><?php echo $row['nohp']; ?></td>
                  <td class="d-flek">
                    <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalview<?php echo $row['id'] ?> "><i class="bi bi-eye"></i></button>
                    <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modaledit<?php echo $row['id'] ?> "><i class="bi bi-pencil-square"></i></i></button>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modaldelete<?php echo $row['id'] ?> "><i class="bi bi-trash"></i></button>
                    <button class="btn btn-secondary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalresetpassword<?php echo $row['id'] ?> "><i class="bi bi-back"></i></i></button>
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

