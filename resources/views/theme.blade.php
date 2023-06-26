@extends('layouts.page')
@section('title', 'Detail Theme')
@section('content')

    <!-- ======= What We Do Section ======= -->
    <section id="what-we-do" class="what-we-do">

      </section><!-- End What We Do Section -->

      <!-- ======= Services Section ======= -->
      <section id="services" class="portfolio">
        <div class="container">

          <div class="section-title">
            <h2>Theme undangan</h2>
            <p>Sit sint consectetur velit quisquam cupiditate impedit suscipit</p>
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
                    <p class="text-success mb-3">{{ $item->price }}</p>
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
        </div>
      </section><!-- End Services Section -->

@endsection
