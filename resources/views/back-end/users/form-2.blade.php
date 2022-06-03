<div class="panel-body">
    <fieldset class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-2 control-label">Số điện thoại </label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="phone" id="phone" 
                value="{{isset($obj) ? $obj->phone : old('phone')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Tuổi</label>
            <div class="col-sm-5">
                <input type="number" class="form-control" name="age" id="age" 
                value="{{isset($obj) ? $obj->age : old('age')}}">
            </div>
        </div>
        <div class="form-group" >
            <label class="col-sm-2 control-label">Giới tính</label>
            <div class="col-md-5">
                <select class="form-control m-b" name="gender" id="gender" >
                    <option value="1" {{isset($obj) ? ($obj->gender == 1 ? 'selected' : '') : 
                    				(old('gender') == 1 ? 'selected' : '')}}>
                    	Nam
                	</option>
                    <option value="0" {{isset($obj) ? ($obj->gender == 0 ? 'selected' : '') : 
                    				(old('gender') == 0 ? 'selected' : '')}}>
                    	Nữ
                    </option>
                    <option value="2" {{isset($obj) ? ($obj->gender == 2 ? 'selected' : '') : 
                                    (old('gender') == 2 ? 'selected' : '')}}>
                        Giới tính khác
                    </option>                                          
   				</select>                                         
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Địa chỉ </label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="address" id="address" 
                value="{{isset($obj) ? $obj->address : old('address')}}">
            </div>
        </div>
    </fieldset>
</div>