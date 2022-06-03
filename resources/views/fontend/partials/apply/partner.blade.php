@if($adults > 1)
<div class="title-bank">
	<h3 class="mg1">@lang('header.partner')</h3>
</div>
{{--@if(!empty($data_adults) && $data_adults->count() <= 0)--}}
<div class="row form-gray w-xs-100 mx-xs-0">
	@for($j = 2; $j <= $adults; $j++)
	@include("fontend.partials.row-partner",['j'=>$j, 'data'=>null])
	@endfor
</div>
@endif
{{--@else--}}
{{--<div class="row form-gray w-xs-100 mx-xs-0" >--}}
{{--	@foreach($data_adults as $obj)--}}
{{--	@include("fontend.partials.row-partner",['data'=>$obj])--}}
{{--	@endforeach--}}
{{--</div>--}}
{{--@endif--}}
{{--@endif--}}
