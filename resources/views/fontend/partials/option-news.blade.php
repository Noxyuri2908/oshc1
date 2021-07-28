<div class="tag-select border-none">
	<div class="row">
		<div class="col-md-3">
			<div class="dropdown">
				<button class="btn-sel" type="button" data-toggle="dropdown">
					<span id="cat_choose">
						@if(isset($category))
							{{ get_name($category) }}
						@else
							@lang('header.all_items')
						@endif
					</span>
					<i class="fa fa-caret-down" aria-hidden="true"></i>
				</button>
				<ul class="dropdown-menu">
					<li style="cursor: pointer;" class="item-cat" data-id="0" data-name="@lang('header.all_items')">@lang('header.all_items') </li>
					@foreach($cats as $cat )
					<li style="cursor: pointer;" class="item-cat" data-id="{{$cat->id}}" data-name="{{ get_name($cat) }}">{{get_name($cat)}}</li>
					@endforeach
				</ul>
			</div>
		</div>
		<div class="col-md-9 border-none">
			<div class="title-tag">
				<label for="" class="title">@lang('header.tags'):</label>
			</div>
			<div class="tags">

				@foreach($tags as $_tag)
				<a style="cursor: pointer;" class="tag-cloud-link item-tag {{isset($tag) && $tag != null ? ($tag->id == $_tag->id ? 'choose' : '') : ''}}" data-id="{{$_tag->id}}">{{get_name($_tag)}}</a>
				@endforeach
			</div>
		</div>
	</div>
</div>
