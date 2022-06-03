<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    @include('back-end.partials.alert-msg')
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1">Information Apply</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-5">Payment</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">Person Register</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3">Partner</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-4">Children</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                       @include('back-end.apply.form-1')  
                    </div>
                    <div id="tab-5" class="tab-pane">
                       @include('back-end.apply.payment')  
                    </div>
                    <div id="tab-2" class="tab-pane">
                        @include('back-end.apply.customer',['cus'=>$person_reg])
                    </div>
                    <div id="tab-3" class="tab-pane">
                       @php
                            $i = 0; 
                       @endphp
                       @foreach($obj->customers()->where('type',1)->get() as $customer)
                            @include('back-end.apply.partner',['i'=>$i,'cus'=>$customer])
                        @php
                            $i++; 
                        @endphp
                       @endforeach
                    </div>
                     <div id="tab-4" class="tab-pane">
                        @php
                            $i = 0; 
                        @endphp
                        @foreach($obj->customers()->where('type',2)->get() as $customer)
                            @include('back-end.apply.children',['i'=>$i,'cus'=>$customer])
                        @php
                            $i++; 
                        @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>