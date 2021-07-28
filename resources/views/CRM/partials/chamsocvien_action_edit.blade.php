<div class="col-sm-6 cotphai">
  @php
  $check = false;
  if($hocvien != null && $hocvien->data_chamsocvien != null) $check=true;
  @endphp
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group row">
        <label class="col-sm-6 col-form-label col-form-label-sm title-label">Ngày gọi</label>
        <div class="col-sm-6">
          <input id="ngaygoi" autocomplete="off" value="" type="text" name="ngaygoi" class="form-control form-control-sm date-pk txt-ngaygoi">
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group row">
        <label class="col-sm-6 col-form-label col-form-label-sm title-label">Người gọi </label>
        <div class="col-sm-6 div-sel-nguoigoi pd10">
          <select name="chamsocvien_id" class="sel-nguoigoi form-control">
            @if($chamsocviens != null)
            @foreach($chamsocviens as $chamsocvien)
            <option value="{{$chamsocvien->id}}" 
              {{$check ? (Auth::user()->id == $chamsocvien->id ? 'selected' : '') : ''}}>{{$chamsocvien->name}}</option>           
            @endforeach
            @endif
          </select>
          </div>
        </div>
      </div>
    </div> <!--  end 1 row -->
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-6 col-form-label col-form-label-sm title-label">Lần gọi</label>
          <div class="col-sm-6 div-sel-langoi">
            <input type="number" min=0 name="langoi" id="langoi" value="{{$check ? $hocvien->data_chamsocvien->langoi + 1 : ''}}" class="form-control form-control-sm">
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-6 col-form-label col-form-label-sm title-label">Ngày gọi lại</label>
          <div class="col-sm-6 pd10">
            <input id="txt-ngaygoilai" autocomplete="off" value="" type="text" name="ngaygoilai" class="form-control form-control-sm date-pk txt-ngaygoi" >
          </div>
        </div>
      </div>
    </div> <!--  end 1 row -->

    <div class="row">
      <div class="col-sm-12">
        <div class="row form-group">
          <label class="col-sm-3 col-form-label col-form-label-sm title-label">Nội dung tư vấn</label>
          <div class="col-sm-9 pd10">
            <input type="text" name="noidung" value="" class="form-control form-control-sm txttuvan">
          </div>
          <div class="col-sm-6"></div>
        </div>
      </div>
    </div> <!--  end 1 ro -->
    <div class="row">
      <div class="col-sm-12">
        <div class="form-group row">
          <label class="col-sm-3 lb-danhgiatinhtrang">Tình trạng Data</label>
          <div class="col-sm-9 div-sel-tiemnang pd0">
            <select name="ttdata" class="txttiemnang form-control">
              <option label=""></option>
              <option value="A – Tiềm năng">A – Tiềm năng</option>
              <option value="B – Đang phân vân">B – Đang phân vân</option>
              <option value="C – Từ chối">C – Từ chối</option>
              <option value="T – Chưa nghe máy">T – Chưa nghe máy</option>
            </select>
          </div>
        </div>
      </div>
    </div><!-- >end 1 ro -->

    <div class="comment">
      <table class="table table-striped table-hover">
        <thead>
          <th>
            Người gọi
          </th>
          <th>
            Nội dung
          </th>
          <th>
            Ngày gọi
          </th>
          <th>
            Lần gọi
          </th>
          <th>
            Tình trạng data
          </th>
          <th>
            Ngày gọi lại
          </th>
        </thead>
        <tbody>         
          @if($check)
          @foreach($hocvien->datachamsochocviens()->orderby('created_at','DESC')->get() as $data)
            @if($data->langoi > 0)
              <tr>
                <td>
                  @if($data->user != null)
                  {{$data->user->name}}
                  @else
                  Không tìm thấy dữ liệu người gọi
                  @endif
                </td>
                <td>
                  {{$data->noidung}}
                </td>
                <td>
                  {{$data->ngaygoi}}
                </td>
                <td>
                  {{$data->langoi}}
                </td>
                <td>
                  {{$data->ttdata}}
                </td>
                <td>
                  {{$data->ngaygoilai}}
                </td>
              </tr>
            @endif
          @endforeach
          @endif  
        </tbody>
      </table>
    </div>
  </div>
</div> <!--  end cot phải -->