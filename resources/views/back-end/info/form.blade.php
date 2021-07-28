<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    @php
    $is_admin = auth()->guard('admin')->check();
    @endphp
    @php
    if(isset($obj)) $tmp = $obj->info;
    @endphp
    @include('back-end.partials.alert-msg')
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1">Login Detail</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">Information Detail</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3">Config Business</a></li>
                    @if($is_admin)
                    <li class=""><a data-toggle="tab" href="#tab-5">Contact Person</a></li>
                    @endif
                    @if(isset($tmp))
                    <li class=""><a data-toggle="tab" href="#tab-4">Thông tin hoa hồng</a></li>
                    @endif
                </ul>
                <div class="tab-content">
                    <!-- THONG TIN CHUNG -->
                    <div id="tab-1" class="tab-pane active">
                        @include('back-end.info.form-1')
                    </div>
                    <!-- NOI DUNG -->
                    <div id="tab-2" class="tab-pane">
                        @include('back-end.info.form-2')
                    </div>
                    <!-- KHUYEN MAI -->
                    <div id="tab-3" class="tab-pane">
                        @include('back-end.info.form-3')
                    </div>
                     @if($is_admin)
                    <div id="tab-5" class="tab-pane">
                        @include('back-end.info.form-5')
                    </div>
                    @endif
                    @if(isset($tmp))
                    <div id="tab-4" class="tab-pane">
                        @include('back-end.info.form-4')
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>