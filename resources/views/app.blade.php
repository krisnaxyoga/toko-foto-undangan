@extends('layouts.landing')
@section('title', 'Home Page')
@section('content')

    <!-- ======= What We Do Section ======= -->
    <section id="what-we-do" class="what-we-do">
        <div class="container">

          <div class="section-title">
            <h2>What We Do</h2>
            <p>Magnam dolores commodi suscipit consequatur ex aliquid</p>
          </div>

          <div class="row">
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
              <div class="icon-box">
                <div class="icon"><i class="bx bxl-dribbble"></i></div>
                <h4><a href="">Lorem Ipsum</a></h4>
                <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
              <div class="icon-box">
                <div class="icon"><i class="bx bx-file"></i></div>
                <h4><a href="">Sed ut perspiciatis</a></h4>
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
              <div class="icon-box">
                <div class="icon"><i class="bx bx-tachometer"></i></div>
                <h4><a href="">Magni Dolores</a></h4>
                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
              </div>
            </div>

          </div>

        </div>
      </section><!-- End What We Do Section -->

      <!-- ======= Services Section ======= -->
      <section id="services" class="portfolio">
        <div class="container">

          <div class="section-title">
            <h2>Daftar Paket</h2>
            <p>Sit sint consectetur velit quisquam cupiditate impedit suscipit</p>
          </div>

          <!-- Layout Card Product-->
          <div class="row portfolio-container">

            <div class="col-lg-4 col-md-6 portfolio-item filter-card wow fadeInUp">
              <div class="portfolio-wrap">
                <figure>
                  <img src="assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt="">
                  <a href="assets/img/portfolio/portfolio-4.jpg" class="link-preview portfolio-lightbox" data-gallery="portfolioGallery" title="Preview"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
                </figure>

                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html">Card 2</a></h4>
                  <p>Card</p>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-card wow fadeInUp">
              <div class="portfolio-wrap">
                <figure>
                  <img src="assets/img/portfolio/portfolio-7.jpg" class="img-fluid" alt="">
                  <a href="assets/img/portfolio/portfolio-7.jpg" class="link-preview portfolio-lightbox" data-gallery="portfolioGallery" title="Preview"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
                </figure>

                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html">Card 1</a></h4>
                  <p>Card</p>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-card wow fadeInUp" data-wow-delay="0.1s">
              <div class="portfolio-wrap">
                <figure>
                  <img src="assets/img/portfolio/portfolio-8.jpg" class="img-fluid" alt="">
                  <a href="assets/img/portfolio/portfolio-8.jpg" class="link-preview portfolio-lightbox" data-gallery="portfolioGallery" title="Preview"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
                </figure>

                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html">Card 3</a></h4>
                  <p>Card</p>
                </div>
              </div>
            </div>

          </div>
          <div class="text-center mt-3"><button class="btn btn-primary">Tampilkan Data Lainnya</button></div>
        </div>
      </section><!-- End Services Section -->

      <!-- ======= Contact Section ======= -->
      <section id="contact" class="contact section-bg">
        <div class="container">

          <div class="section-title">
            <h2>Kontak Kami</h2>
          </div>

          <div class="row mt-5 justify-content-center">

            <div class="col-lg-10">

              <div class="info-wrap">
                <div class="row">
                  <div class="col-lg-4 info">
                    <i class="bi bi-geo-alt"></i>
                    <h4>Lokasi:</h4>
                    <p>Jln. Kampus UNUD<br>Bukit Jimbaran, Badung, Bali</p>
                  </div>

                  <div class="col-lg-4 info mt-4 mt-lg-0">
                    <i class="bi bi-envelope"></i>
                    <h4>Email:</h4>
                    <p>info@example.com<br>contact@example.com</p>
                  </div>

                  <div class="col-lg-4 info mt-4 mt-lg-0">
                    <i class="bi bi-phone"></i>
                    <h4>Call:</h4>
                    <p>+1 5589 55488 51</p>
                  </div>
                </div>
              </div>

            </div>

          </div>

          <div class="row mt-5 justify-content-center">
            <div class="col-lg-10">
              <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                </div>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                </div>
                <div class="my-3">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>
                <div class="text-center"><button type="submit">Send Message</button></div>
              </form>
            </div>

          </div>

        </div>
      </section><!-- End Contact Section -->

@endsection
