<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!-- Favicons -->
  <link href="/lumia/assets/img/favicon.png" rel="icon">
  <link href="/lumia/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/lumia/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/lumia/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/lumia/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/lumia/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/lumia/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/lumia/assets/css/style.css" rel="stylesheet">
 @stack('style')
    <title>Dashboard</title>
  </head>
  <body>
 <!-- ======= Header ======= -->
 <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo me-auto">
        <h1><a href="/">Lumia</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="/">Home</a></li>
          <li><a class="nav-link scrollto" href="/#about">Tentang Kami</a></li>
          <li><a class="nav-link scrollto" href="/#services">Daftar Paket</a></li>
          <li><a class="nav-link scrollto " href="/#undanganonline">Undangan Online</a></li>
          @if(Auth::user())

          <li><a class="nav-link" href="{{route('customer.dashboard')}}">dashboard</a></li>
          @else
          <li><a class="nav-link" href="/login">Login</a></li>
          @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <div class="header-social-links d-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>

    </div>
  </header><!-- End Header -->
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container text-center text-md-left" data-aos="fade-up">
      <h1>Welcome to <span>Artimana Studio</span></h1>
      <h2>Jasa Photography dan Undangan Digital</h2>
      <a href="/login" class="btn-get-started scrollto">Pesan Sekarang</a>
    </div>
  </section><!-- End Hero -->
            <main>
                @yield('content')
            </main>

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Artimana Studio</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-4 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#hero">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#what-we-do">Tentang Kami</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#services">Daftar Paket</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="/register">Registrasi</a></li>
              <li>
                @if(!Auth::user())
                <i class="bx bx-chevron-right"></i> <a href="/login">Login</a></li>
                @else
                <i class="bx bx-chevron-right"></i> <a href="/login">Dashboard {{auth()->user()->id}} {{Auth::user()->name}}</a></li>
                @endif
            </ul>
          </div>


          <div class="col-lg-4 col-md-6 ">
            <h4>moto perusahaan</h4>
            <p>kami menyediakan layanan terbaik di bali</p>

          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Artimana Studio</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/lumia-bootstrap-business-template/ -->
          Designed by <a href="https://bootstrapmade.com/">Artimana Studio</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/lumia/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="/lumia/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/lumia/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/lumia/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="/lumia/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="/lumia/assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="/lumia/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/lumia/assets/js/main.js"></script>
    <script>
        $(document).ready(function (){

        });
    </script>
    @stack('script')

  </body>
</html>
