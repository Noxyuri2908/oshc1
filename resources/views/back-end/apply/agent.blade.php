<div class="panel-body">
    <fieldset class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-2 control-label">Full Name</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="name" id="name" 
                value="{{isset($cus) ? $cus->name : old('name')}}" readonly>
            </div>
        </div>
        <div class="form-group" >
            <label class="col-sm-2 control-label">Gender</label>
            <div class="col-md-5">
                <select class="form-control m-b" name="prefix_name_main" readonly>
                    <option value="0" {{$cus->gender == '0' ? 'selected' : ''}}>
                        Male
                    </option>
                     <option value="1" {{$cus->gender == '1' ? 'selected' : ''}}>
                        Female
                    </option>                                       
                </select>                                         
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Phone</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="tel_1" id="tel_1" 
                value="{{isset($cus) ? $cus->tel_1 : old('tel_1')}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="phone" id="phone" 
                value="{{isset($cus) ? $cus->User->email : old('email')}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Country</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="country" id="country" 
                value="{{isset($cus) ? $cus->country : old('country')}}" readonly>
            </div>
        </div>
    </fieldset>
</div>
