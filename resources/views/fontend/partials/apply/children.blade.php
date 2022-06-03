@if($childs >= 1)
<div class="title-bank">
	<h3 class="mg2">@lang('header.children')</h3>
</div>
{{--@if(empty($data_childs) && $data_childs->count() <= 0)--}}
<div class="row form-gray w-xs-100 mx-xs-0">
	@for($j = 1; $j <= $childs; $j++)
	@include("fontend.partials.row-children",['j'=>$j, 'data'=>null])
	@endfor
</div>
@endif
{{--@else--}}
{{--<div class="row form-gray w-xs-100 mx-xs-0" >--}}
{{--	@foreach($data_childs as $obj)--}}
{{--	    @include("fontend.partials.row-children",['data'=>$obj])--}}
{{--	@endforeach--}}
{{--</div>--}}
{{--@endif--}}
{{--@endif--}}
