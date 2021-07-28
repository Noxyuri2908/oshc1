<div class="col-sm-6 cotphai">
  <div class="row">
    <div class="col-sm-4">
      <h3 class="txtthongtintuyensinh">6. Detail Support</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group row">
        <label class="col-sm-6 col-form-label col-form-label-sm title-label">Date call</label>
        <div class="col-sm-6">
          <input id="ngaygoi" type="text" name="ngaygoi" class="form-control form-control-sm date-pk txt-ngaygoi">
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group row">
        <label class="col-sm-6 col-form-label col-form-label-sm title-label">Caller</label>
        <div class="col-sm-6 div-sel-nguoigoi pd10">
          <select name="admin_id" class="sel-nguoigoi form-control">
            @foreach($staffs as $staff)
            <option value="{{$staff->id}}">{{$staff->username}}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
  </div> <!--  end 1 row -->
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group row">
        <label class="col-sm-6 col-form-label col-form-label-sm title-label">Last call</label>
        <div class="col-sm-6 div-sel-langoi">
          <input type="number" min=0 name="langoi" id="langoi" value="" class="form-control form-control-sm">
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group row">
        <label class="col-sm-6 col-form-label col-form-label-sm title-label">Date callback</label>
        <div class="col-sm-6 pd10">
          <input id="txt-ngaygoilai" type="text" name="ngaygoilai" class="form-control form-control-sm date-pk txt-ngaygoi" >
        </div>
      </div>
    </div>
  </div> <!--  end 1 row -->

  <div class="row">
    <div class="col-sm-12">
      <div class="row form-group">
        <label class="col-sm-3 col-form-label col-form-label-sm title-label">Content</label>
        <div class="col-sm-9 pd10">
          <textarea rows="5" name="noidung" class="form-control form-control-sm txttuvan"></textarea>
        </div>
        <div class="col-sm-6"></div>
      </div>
    </div>
  </div> <!--  end 1 ro -->
  <div class="comment">
  </div>
</div> <!--  end cot phải -->