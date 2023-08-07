@extends('layouts.landing')
@section('title', 'Home Page')
@section('content')
<style>
  svg,.w-5 .h-5{
    width: 20px;
  }
</style>
    <!-- ======= What We Do Section ======= -->
    <section id="about" class="what-we-do">
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
          </div>

          <!-- Layout Card Product-->
          <div class="row portfolio-container">
            @foreach ($package as $key=>$item)
            <div class="col-lg-4 col-md-6 portfolio-item filter-card wow fadeInUp">
                <div class="portfolio-wrap">
                  <figure>
                    <img src="/images/{{ $item->image }}" class="img-fluid" alt="">
                    <a href="/images/{{ $item->image }}" class="link-preview portfolio-lightbox" data-gallery="portfolioGallery" title="Preview"><i class="bi bi-eye"></i></a>
                    <a href="#" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
                    <a href="#" class="link-details" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key }}">
                        <i class="bi bi-bag-plus"></i>
                      </a>
                  </figure>

                  <div class="portfolio-info">
                    <h4><a href="#">{{ $item->name }}</a></h4>
                    <p class="text-success mb-3">Rp. {{ number_format($item->price , 0, ',', '.')}}</p>
                  </div>
                </div>
              </div>
              <!-- Modal -->
                <div class="modal fade" id="exampleModal{{ $key }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $item->name }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        {{ $item->description }}
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        {{-- <a href="{{route('customer.order',$item->id)}}" class="btn btn-primary">Order</a> --}}
                        @if($item->is_active == 1)
                        <a href="{{route('customer.order',$item->id)}}" class="btn btn-primary">Order</a>
                        @else

                        <a href="#" onclick="alert('full booking')" class="btn btn-primary">full book</a>
                        @endif
                        </div>
                    </div>
                    </div>
                </div>
            @endforeach

          </div>
          <div class="text-center mt-3">{{$package->links()}}</div>
          <div class="text-center mt-3"><a href="{{route('list_package')}}" class="btn btn-primary">Tampilkan Data Lainnya</a></div>
        </div>
      </section><!-- End Services Section -->

       <!-- ======= Services Section ======= -->
       <section id="undanganonline" class="portfolio">
        <div class="container">

          <div class="section-title">
            <h2>Theme undangan</h2>
          </div>

          <!-- Layout Card Product-->
          <div class="row portfolio-container">
            @foreach ($theme as $key=>$item)
            <div class="col-lg-4 col-md-6 portfolio-item filter-card wow fadeInUp">
                <div class="portfolio-wrap">
                  <figure>
                    <img src="/mockup_img/{{ $item->img_mockup }}" class="img-fluid" alt="">
                    <a href="/mockup_img/{{ $item->img_mockup }}" class="link-preview portfolio-lightbox" data-gallery="portfolioGallery" title="Preview"><i class="bi bi-eye"></i></a>
                    <a href="#" class="link-details" title="More Details"><i class="bx bx-link"></i></a>
                    <a href="{{route('customer.orderundangan',$item->id)}}" class="link-details">
                        <i class="bi bi-bag-plus"></i>
                      </a>
                  </figure>

                  <div class="portfolio-info">
                    <h4><a href="#">{{ $item->name }}</a></h4>
                    <p class="text-success mb-3">Rp. {{ number_format($item->price , 0, ',', '.')}}</p>
                  </div>
                </div>
              </div>
              <!-- Modal -->
                {{-- <div class="modal fade" id="exampleModalx{{ $key }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $item->name }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        {{ $item->description }}
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="{{route('customer.order',$item->id)}}" class="btn btn-primary">Order</a>
                        </div>
                    </div>
                    </div>
                </div> --}}
            @endforeach

          </div>
          <div class="text-center mt-3">{{$theme->links()}}</div>
          <div class="text-center mt-3"><a href="{{route('list_theme')}}" class="btn btn-primary">Tampilkan Data Lainnya</a></div>
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
              {{-- <form action="forms/contact.php" method="post" role="form" class="php-email-form">
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
              </form> --}}
            </div>

          </div>

        </div>
      </section><!-- End Contact Section -->

@endsection
