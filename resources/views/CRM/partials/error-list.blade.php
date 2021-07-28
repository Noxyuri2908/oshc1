@if(count($errors) > 0)
<div class="alert alert-danger">
@foreach($errors->all() as $err)
<strong>{{$err}}</strong><br>
@endforeach
</div>
@endif