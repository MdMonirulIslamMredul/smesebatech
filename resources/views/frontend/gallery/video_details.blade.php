@extends('frontend.master')
@section('title')
    {{ $video->title ?? 'Video Details' }}
@endsection
@section('content')

    <!-- Content Wrapper Start -->
    <div class="content-wrapper">

        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap bg-f" style="background-image: url({{ asset($banner->image ?? '') }});">
            <div class="container">
                <div class="breadcrumb-title">
                    <h2>{{ $video->title ?? 'Video' }}</h2>
                    <ul class="breadcrumb-menu list-style">
                        <li><a href="{{ route('front.page') }}">Home</a></li>
                        <li><a href="{{ route('video.gallery.page') }}">Video Gallery</a></li>
                        <li>{{ $video->title ?? 'Video Details' }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- Video Details Section Start -->
        <section class="video-details-wrap ptb-100">
            <div class="container">
                <!-- Main Content - Centered -->
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <!-- Video Player -->
                        <div class="video-details-player">
                            <div class="video-player-wrapper">
                                @php
                                    $youtubeId = $video->extractYoutubeId($video->video_link);
                                    $thumb = $video->getThumbnailUrl();
                                    if (!$thumb && $youtubeId) {
                                        $thumb = 'https://img.youtube.com/vi/' . $youtubeId . '/maxresdefault.jpg';
                                    }
                                @endphp

                                @if ($youtubeId)
                                    <div class="youtube-poster" data-youtube-id="{{ $youtubeId }}" role="button"
                                        tabindex="0" aria-label="Play video"
                                        style="background-image: url('https://img.youtube.com/vi/{{ $youtubeId }}/maxresdefault.jpg'); background-size: cover; background-position: center;">
                                        <div class="play-overlay">
                                            <div class="play-button-circle">
                                                <i class="fas fa-play"></i>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($video->video_link)
                                    {{-- Fallback: try to display raw embed code --}}
                                    <div class="video-embed-wrapper">
                                        {!! $video->video_link !!}
                                    </div>
                                @else
                                    <div class="video-error-message">
                                        <i class="fas fa-exclamation-circle"
                                            style="font-size: 48px; color: #999; margin-bottom: 15px;"></i>
                                        <p style="color: #999; font-size: 16px;">Video not available</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Video Info -->
                        <div class="video-details-content">
                            <h1 class="video-details-title">{{ $video->title }}</h1>
                            @if ($video->description)
                                <div class="video-details-description">
                                    <p>{{ $video->description }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Related Episodes Section -->
                @if ($relatedVideos->count() > 0)
                    <div class="row justify-content-center mt-5">
                        <div class="col-lg-10">
                            <div class="related-episodes-wrap">
                                <h2 class="section-heading">Our Recent Episodes</h2>
                                <div class="related-episodes-grid">
                                    @foreach ($relatedVideos as $relatedVideo)
                                        <div class="related-episode-card">
                                            <a href="{{ route('video.details', ['id' => $relatedVideo->id]) }}"
                                                class="episode-link">
                                                <div class="episode-thumb">
                                                    @php
                                                        $thumbUrl = $relatedVideo->getThumbnailUrl();
                                                        $rvId = $relatedVideo->extractYoutubeId(
                                                            $relatedVideo->video_link,
                                                        );
                                                    @endphp
                                                    @if ($thumbUrl)
                                                        <img src="{{ $thumbUrl }}" alt="{{ $relatedVideo->title }}"
                                                            loading="lazy"
                                                            onerror="this.onerror=null;this.src='https://img.youtube.com/vi/{{ $rvId }}/hqdefault.jpg'">
                                                    @else
                                                        <div class="thumb-placeholder">No Thumbnail</div>
                                                    @endif
                                                    <div class="play-icon-overlay">
                                                        <i class="fas fa-play"></i>
                                                    </div>
                                                </div>
                                                <div class="episode-info">
                                                    <h3 class="episode-title">{{ $relatedVideo->title }}</h3>
                                                    @if ($relatedVideo->description)
                                                        <p class="episode-excerpt">
                                                            {{ Str::limit($relatedVideo->description, 100) }}</p>
                                                    @endif
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="text-center mt-4">
                                    <a href="{{ route('video.gallery.page') }}" class="btn-view-all">View All Videos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <!-- Video Details Section End -->

    </div>
    <!-- Content wrapper end -->

    <style>
        .video-details-wrap {
            background: #fafafa;
        }

        .video-details-player {
            background: #000;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            margin-bottom: 40px;
        }

        .video-player-wrapper {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            background: #000;
        }

        .video-player-wrapper iframe,
        .video-player-wrapper embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .video-details-content {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        .video-details-title {
            font-size: 32px;
            font-weight: 700;
            color: #111;
            margin: 0 0 20px 0;
            line-height: 1.3;
        }

        .video-details-description {
            margin-top: 20px;
        }

        .video-details-description p {
            font-size: 17px;
            color: #555;
            line-height: 1.7;
            margin: 0;
        }

        /* Related Episodes Section */
        .related-episodes-wrap {
            margin-top: 60px;
        }

        .section-heading {
            font-size: 28px;
            font-weight: 700;
            color: #111;
            text-align: center;
            margin: 0 0 40px 0;
        }

        .related-episodes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-bottom: 20px;
        }

        .related-episode-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .related-episode-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.12);
        }

        .episode-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .episode-thumb {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            background: #f0f0f0;
            overflow: hidden;
        }

        .episode-thumb img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .related-episode-card:hover .episode-thumb img {
            transform: scale(1.05);
        }

        .thumb-placeholder {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0f0f0;
            color: #999;
            font-size: 14px;
        }

        .play-icon-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.4) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .related-episode-card:hover .play-icon-overlay {
            opacity: 1;
        }

        .episode-info {
            padding: 20px;
        }

        .episode-title {
            font-size: 18px;
            font-weight: 600;
            color: #111;
            margin: 0 0 12px 0;
            line-height: 1.4;
        }

        .episode-excerpt {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            margin: 0;
        }

        .btn-view-all {
            display: inline-block;
            padding: 12px 32px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 15px;
            transition: background 0.3s ease;
        }

        .btn-view-all:hover {
            background: #0056b3;
            color: white;
        }

        @media (max-width: 768px) {
            .video-details-title {
                font-size: 24px;
            }

            .video-details-content {
                padding: 25px;
            }

            .section-heading {
                font-size: 22px;
            }

            .related-episodes-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        /* YouTube poster/play styles */
        .youtube-poster {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            background-color: #000;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .youtube-poster .play-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.4) 100%);
        }

        .youtube-poster .play-button-circle {
            background: rgba(172, 54, 54, 0.8);
            width: 68px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s ease;
            position: relative;
        }

        .youtube-poster .play-button-circle::before {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 10px 0 10px 18px;
            border-color: transparent transparent transparent #fff;
            margin-left: 3px;
        }

        .youtube-poster .play-button-circle i {
            display: none;
        }

        .youtube-poster:hover .play-button-circle {
            background: rgba(230, 33, 23, 0.9);
        }

        .youtube-poster:focus {
            outline: 2px solid rgba(0, 123, 255, 0.6);
        }

        .thumb-placeholder-main {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .video-embed-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .video-embed-wrapper iframe,
        .video-embed-wrapper embed,
        .video-embed-wrapper object {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .video-error-message {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #f5f5f5;
        }
    </style>
    <script>
        // Debug: Log video information
        @if ($youtubeId)
            console.log('YouTube ID extracted:', '{{ $youtubeId }}');
            console.log('Embed URL will be: https://www.youtube.com/embed/{{ $youtubeId }}');
        @else
            console.log('No YouTube ID found');
            console.log('Video link:', '{{ addslashes($video->video_link ?? 'empty') }}');
        @endif

        // Check if poster element exists
        document.addEventListener('DOMContentLoaded', function() {
            var poster = document.querySelector('.youtube-poster');
            if (poster) {
                console.log('YouTube poster found in DOM');
                console.log('Poster data-youtube-id:', poster.getAttribute('data-youtube-id'));
                console.log('Click anywhere on the video preview to play');
            } else {
                console.log('No YouTube poster found in DOM');
            }
        });

        document.addEventListener('click', function(e) {
            var poster = e.target.closest('.youtube-poster');
            if (poster) {
                e.preventDefault();
                var id = poster.getAttribute('data-youtube-id');
                console.log('▶ Play button clicked! Video ID:', id);

                if (!id) {
                    console.error('❌ No video ID found on poster element');
                    return;
                }

                var wrapper = poster.closest('.video-player-wrapper');
                if (!wrapper) {
                    console.error('❌ No wrapper found');
                    return;
                }

                var iframe = document.createElement('iframe');
                var embedUrl = 'https://www.youtube.com/embed/' + id + '?autoplay=1&rel=0';
                iframe.setAttribute('src', embedUrl);
                iframe.setAttribute('allow',
                    'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
                iframe.setAttribute('allowfullscreen', '1');
                iframe.style.position = 'absolute';
                iframe.style.top = '0';
                iframe.style.left = '0';
                iframe.style.width = '100%';
                iframe.style.height = '100%';
                iframe.style.border = 'none';

                console.log('✓ Creating iframe with URL:', embedUrl);
                wrapper.innerHTML = '';
                wrapper.appendChild(iframe);
                console.log('✓ Video should now be playing!');
            }
        });

        document.addEventListener('keydown', function(e) {
            if ((e.code === 'Space' || e.code === 'Enter') && document.activeElement && document.activeElement
                .classList.contains('youtube-poster')) {
                e.preventDefault();
                document.activeElement.click();
            }
        });
    </script>

@endsection
