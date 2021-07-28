<select name="thxettuyen" onchange="clearDiem()" id="thxettuyen" class="txt-nganh form-control">
<option value="" ></option>
@foreach($data as $key => $value)
<option value="{{$key}}" {{(isset($hocvien) && $hocvien->thxettuyen == $key) ? 'selected' : ''}}>{{$value}}</option>
@endforeach
</select>