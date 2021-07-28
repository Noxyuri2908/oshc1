<div class="panel-body">
    <fieldset class="form-horizontal">
    <div class="form-group">
        <label class="col-sm-2 control-label">Full :</label>
        <div class="col-sm-10">
            <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(0,$obj->authorization) ? 'checked' : '') : ''}} value="1" name="authorization[]"><i>Full role</i>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Agent :</label>
        <div class="col-sm-10">
            <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(1,$obj->authorization) ? 'checked' : '') : ''}} value="1" name="authorization[]"><i>Create</i>
            </label>
            <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(2,$obj->authorization) ? 'checked' : '') : ''}}  value="2" name="authorization[]"><i>Edit/Delete</i> 
            </label>
             <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(4,$obj->authorization) ? 'checked' : '') : ''}}  value="4" name="authorization[]"><i>View</i> 
            </label>
        </div>
    </div>
     <div class="form-group">
        <label class="col-sm-2 control-label">Service :</label>
        <div class="col-sm-10">
            <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(5,$obj->authorization) ? 'checked' : '') : ''}} value="5" name="authorization[]"><i>Create</i>
            </label>
            <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(6,$obj->authorization) ? 'checked' : '') : ''}}  value="6" name="authorization[]"><i>Edit/Delete</i> 
            </label>
             <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(8,$obj->authorization) ? 'checked' : '') : ''}}  value="8" name="authorization[]"><i>View</i> 
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Commission :</label>
        <div class="col-sm-10">
            <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(9,$obj->authorization) ? 'checked' : '') : ''}} value="9" name="authorization[]"><i>Create</i>
            </label>
            <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(10,$obj->authorization) ? 'checked' : '') : ''}}  value="10" name="authorization[]"><i>Edit/Delete</i> 
            </label>
             <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(12,$obj->authorization) ? 'checked' : '') : ''}}  value="12" name="authorization[]"><i>View</i> 
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Price :</label>
        <div class="col-sm-10">
            <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(13,$obj->authorization) ? 'checked' : '') : ''}} value="13" name="authorization[]"><i>Create</i>
            </label>
            <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(14,$obj->authorization) ? 'checked' : '') : ''}}  value="14" name="authorization[]"><i>Edit/Delete</i> 
            </label>
             <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(16,$obj->authorization) ? 'checked' : '') : ''}}  value="16" name="authorization[]"><i>View</i> 
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Marketing :</label>
        <div class="col-sm-10">
            <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(17,$obj->authorization) ? 'checked' : '') : ''}} value="17" name="authorization[]"><i>Create</i>
            </label>
            <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(18,$obj->authorization) ? 'checked' : '') : ''}}  value="18" name="authorization[]"><i>Edit/Delete</i> 
            </label>
             <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(20,$obj->authorization) ? 'checked' : '') : ''}}  value="20" name="authorization[]"><i>View</i> 
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Info Website :</label>
        <div class="col-sm-10">
            <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(21,$obj->authorization) ? 'checked' : '') : ''}} value="21" name="authorization[]"><i>Create</i>
            </label>
            <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(22,$obj->authorization) ? 'checked' : '') : ''}}  value="22" name="authorization[]"><i>Edit/Delete</i> 
            </label>
             <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(24,$obj->authorization) ? 'checked' : '') : ''}}  value="24" name="authorization[]"><i>View</i> 
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Staff :</label>
        <div class="col-sm-10">
            <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(25,$obj->authorization) ? 'checked' : '') : ''}} value="25" name="authorization[]"><i>Create</i>
            </label>
            <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(26,$obj->authorization) ? 'checked' : '') : ''}}  value="26" name="authorization[]"><i>Edit/Delete</i> 
            </label>
             <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(28,$obj->authorization) ? 'checked' : '') : ''}}  value="28" name="authorization[]"><i>View</i> 
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Assign :</label>
        <div class="col-sm-10">
            <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(29,$obj->authorization) ? 'checked' : '') : ''}} value="29" name="authorization[]"><i>Agent</i>
            </label>
            <label class="checkbox-inline i-checks"> 
                <input type="checkbox" {{isset($obj) ? 
                    (in_array(30,$obj->authorization) ? 'checked' : '') : ''}}  value="230" name="authorization[]"><i>Apply</i> 
            </label>
        </div>
    </div>
    </fieldset>
</div>