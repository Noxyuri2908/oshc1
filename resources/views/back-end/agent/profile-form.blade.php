<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    @include('back-end.partials.alert-msg')
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1">Thông tin bắt buộc</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">Thông tin bổ xung</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        @include('back-end.agent.form-1')  
                    </div>
                    <div id="tab-2" class="tab-pane">
                        @include('back-end.agent.form-2')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>