<nav class="navbar navbar-expand navbar-success bg-success sticky-top ">
  <div class="container-lg">
    <a class="navbar-brand text-light" href="."><i class="bi bi-strava text-light"></i> AVS Store</a>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav dropdown-menu-end ">
        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $hasil['username']; ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end mt-2">
            <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle"></i> Profile</a></li>
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalubahpassword"><i class="bi bi-key"></i> Ubah password</a></li>
            <li><a class="dropdown-item" href="logout"><i class="bi bi-door-closed"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Modal edit-->
<div class="modal fade" id="modalubahpassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="needs-validation" novalidate action="backend/proses_ubah_pw.php" method="POST">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-floating mb-3">
                <input disabled type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" required value="<?php echo $_SESSION['username_kopiku'] ?>">
                <label for="floatingInput">Username</label>
                <div class="invalid-feedback">
                  Masukan Username.
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingpassword" name="passwordlama" required>
                <label for="floatingInput">Password Lama</label>
                <div class="invalid-feedback">
                  Masukan Password Lama.
                </div>
              </div>
            </div>
            <div class="row"></div>
            <div class="col-lg-12">
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingpassword" name="passwordbaru" required>
                <label for="floatingInput">Masukan Password Baru</label>
                <div class="invalid-feedback">
                  Masukan Password Baru.
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingpassword" name="repasswordbaru" required>
                <label for="floatingInput">Ulangi Password Baru</label>
                <div class="invalid-feedback">
                  Ulangi Password Baru.
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="ubah_pw_validate" value="1234">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>

<!-- akhir modal edit -->