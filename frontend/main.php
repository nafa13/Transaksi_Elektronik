<?php 
  // session_start();
  if (empty ($_SESSION['username_kopiku'])){
    header('location: login.php');

  }
  include "../backend/backend.php";
  $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$_SESSION[username_kopiku]'");
  $hasil = mysqli_fetch_array($query);
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AVS Strawberry & Vegetables</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
  <!-- header -->
  <?php include "header.php"; ?>
  <!-- end header -->
  <div class="container-lg">
    <div class="row">
      <!-- sidebar -->
      <?php include "sidebar.php"; ?>
      <!-- end sidebar -->
      <!-- content -->
      <?php
        include $page;
      ?>
      <!-- end content -->
    </div>
  </div>
  <!-- Remove the container if you want to extend the Footer to full width. -->
  <div class="container-fluid mt-5 bg-success">

    <footer class="footer footer-expend  text-center text-white bg-success">
      <!-- Grid container -->
      <div class="container p-4 pb-0 ">
        <!-- Section: Social media -->
        <section class="mb-4 ">
          <!-- Facebook -->
          <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-facebook-f"><i class="bi bi-facebook"></i></i></a>

          <!-- Twitter -->
          <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-twitter"><i class="bi bi-twitter-x"></i></i></a>

          <!-- Google -->
          <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-google"><i class="bi bi-google"></i></i></a>

          <!-- Instagram -->
          <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-instagram"><i class="bi bi-instagram"></i></i></a>

        </section>
        <!-- Section: Social media -->
      </div>
      <!-- Grid container -->

      <!-- Copyright -->
      <div class="text-center bg-success p-3" >
        ©2025 Copyright |
        <a class="text-white" href="#">AVS Store</a>
      </div>
      <!-- Copyright -->
    </footer>

  </div>
  <!-- End of .container -->
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
  })()
</script>
</body>

</html>