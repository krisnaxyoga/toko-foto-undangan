@extends('layouts.page')
@section('title', 'Detail Package')
@section('content')

    <!-- ======= What We Do Section ======= -->
    <section id="what-we-do" class="what-we-do">

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
        </div>
      </section><!-- End Services Section -->

@endsection
