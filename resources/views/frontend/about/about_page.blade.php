@extends('frontend.master')
@section('title')
    About
@endsection
@section('content')
    <!-- Content Wrapper Start -->
    <div class="content-wrapper">

        <!-- Breadcrumb Start -->
        <div class="breadcrumb-modern" style="background-image: url({{ asset($about->banner_image) }});">
            <h1>About Us</h1>
            <div class="breadcrumb-nav-modern">
                <a href="{{ route('front.page') }}">Home</a>
                <span>/</span>
                <span>About Us</span>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- About Section Start -->
        <section class="section-modern section-modern-light">
            <div class="container">
                <div class="section-header-modern" data-aos="fade-up" data-aos-duration="1200">
                    <span class="section-subtitle-modern">Who We Are</span>
                    <h2 class="section-title-modern">About Our Organization</h2>
                </div>

                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1200">
                        <div style="position: relative;">
                            <img src="{{ asset($about->image1 ?? null) }}" alt="About Us"
                                style="width: 100%; border-radius: 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.12);">
                            @if ($about->image2)
                                <img src="{{ asset($about->image2 ?? null) }}" alt="About Us"
                                    style="position: absolute; bottom: -30px; right: -30px; width: 45%; border-radius: 12px; border: 5px solid white; box-shadow: 0 8px 25px rgba(0,0,0,0.15);">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1200">
                        <div class="modern-card" style="padding: 3rem;">
                            <h3 style="color: #0a0f1e; margin-bottom: 1.5rem; font-size: 1.75rem;">About Our Program</h3>
                            <div style="font-size: 1.05rem; line-height: 1.8; color: #555;">
                                {!! $about->page_details ?? null !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Section End -->

        <!-- Testimonial Section Start -->
        <section class="section-modern" style="background: white;">
            <div class="container">
                <div class="section-header-modern" data-aos="fade-up" data-aos-duration="1200">
                    <span class="section-subtitle-modern">Client Testimonials</span>
                    <h2 class="section-title-modern">{{ $banner->title ?? 'What Our Clients Say' }}</h2>
                </div>

                <div class="testimonial-slider-two owl-carousel">
                    @foreach ($testimonials as $testimonial)
                        <div class="testimonial-card-modern" data-aos="fade-up" data-aos-duration="1200"
                            data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="testimonial-quote-modern">
                                <i class="flaticon-straight-quotes"
                                    style="font-size: 2.5rem; color: #36d1dc; opacity: 0.3; position: absolute; top: 1rem; left: 1.5rem;"></i>
                                <p style="position: relative; z-index: 1;">{!! $testimonial->review !!}</p>
                            </div>

                            <div style="margin-bottom: 1rem;">
                                @for ($i = 0; $i < $testimonial->star; $i++)
                                    <i class="ri-star-fill" style="color: #ffc107; font-size: 1.1rem;"></i>
                                @endfor
                            </div>

                            <div class="testimonial-author-modern">
                                <img src="{{ asset($testimonial->image) }}" class="testimonial-avatar-modern"
                                    alt="{{ $testimonial->name }}">
                                <div class="testimonial-author-info-modern">
                                    <h5>{{ $testimonial->name }}</h5>
                                    <p>{{ $testimonial->designation }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Testimonial Section End -->

    </div>
    <!-- Content wrapper end -->
@endsection
