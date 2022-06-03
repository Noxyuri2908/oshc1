<div class="panel-body">
    <fieldset class="form-horizontal">
    <div class="form-group">
        <label class="col-sm-2 control-label">Người dùng :</label>
        <div class="col-sm-10">
            <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(1,$obj->authorization) ? 'checked' : '') : ''}} value="1" name="authorization[]"><i>Xem</i>
            </label>
            <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(2,$obj->authorization) ? 'checked' : '') : ''}}  value="2" name="authorization[]"><i>Sửa</i> 
            </label>
            <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(3,$obj->authorization) ? 'checked' : '') : ''}}  value="3" name="authorization[]"><i>Xóa</i> 
            </label>
        </div>
    </div>
    </fieldset>
</div>