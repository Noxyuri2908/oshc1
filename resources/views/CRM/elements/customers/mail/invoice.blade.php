
<div>Dear {{(!empty($customerName))?$customerName:''}}</div>
@if(!empty($template))
{!! $template !!}
@endif
