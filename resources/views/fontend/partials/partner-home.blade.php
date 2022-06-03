<section id="partner-homes" class="container w-100  my-5" style="display:inline-block">
        <div class="title-section">
            {{get_name($title)}}
        </div>
        <div class="des-section">
            {!! get_content($title) !!}
        </div>
        {{-- <div class="buge">...</div> --}}
        <div id="partner-slide" class="owl-carousel owl-theme">
            @foreach ($partner as $post)
            <div class="item">
                <div class="w-100 d-flex justify-content-center">
                    <a href="{{$post->link}}" style="width: 145px;display:inline-block">
                        <img src="{{$post->image}}" alt="Partner">
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
@push('scripts')
    <script>
        $('#partner-slide').owlCarousel({
                margin:10,
                loop:true,
                nav:true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:5
                    }
                }
            })
    </script>
@endpush
