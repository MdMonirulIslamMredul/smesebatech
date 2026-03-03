<section class="section-modern" id="testimonial-section" style="background: #f8f9fa;">
    <div class="container">
        <div class="section-header-modern" data-aos="fade-up" data-aos-duration="1200">
            <span class="section-subtitle-modern">Client Success Stories</span>
            @foreach ($titles as $data)
                @if ($data->page == 'testimonial')
                    <h2 class="section-title-modern">{{ $data->title }}</h2>
                @endif
            @endforeach
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
