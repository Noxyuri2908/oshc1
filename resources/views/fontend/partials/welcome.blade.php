@include("font-end.partials.head")
@include("font-end.partials.slider-home")
@include("font-end.partials.header")
<section id="content-home">
    <div class="container">
        <div class="list-item-home">
            @include('font-end.partials.item-home', array('name' => $p['title'], 'image'=> $p['image'], 'link'=> route('products')))
            @include('font-end.partials.item-home', array('name' => $n['title'], 'image'=> $n['image'], 'link'=> route('news')))
            @include('font-end.partials.item-home', array('name' => $b['title'], 'image'=> $b['image'], 'link'=> route('brand')))
            @include('font-end.partials.item-home', array('name' => $c['title'], 'image'=> $c['image'], 'link'=> route('color')))
        </div>
        <div class="gallery-home">
        	<div class="title-gallery-home">
        		Gallery
        	</div>
        	<div class="des-gallery-home">
        		So let’s start a new conversation – a conversation about you – with the ultimate goal of creating true partnership. After all, that’s the essence of the new After all, that’s the essence of the new
        	</div>
			<div class="list-item-gallery">
				@include("font-end.partials.item-gallery")
				@include("font-end.partials.item-gallery")
				@include("font-end.partials.item-gallery")
			</div>
        </div>
        <div class="video-home">
        	<div class="list-video-post">
				<ul id="lightSlider" class="vertical">
					@include("font-end.partials.item-video")
					@include("font-end.partials.item-video")
					@include("font-end.partials.item-video")
					@include("font-end.partials.item-video")
				</ul>
			</div>
        </div>
    </div>
</section>
@include("font-end.partials.footer")
@include("font-end.partials.scripts")