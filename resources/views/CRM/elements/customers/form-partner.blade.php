@if(empty($obj))
    <div class="card mb-3">
        <div class="card-header">
            <div class="chevron-down-up">
                <h5 class="mb-0">Partner info</h5>
                <p class="click-down" data-id="partner"><span class="fas fa-chevron-down"></span></p>
            </div>
        </div>
        <div class="card-body bg-light" data-id="partner" id="partner_div">
            @include('CRM.elements.customers.partner',['number'=>(!empty(request()->get('no_of_adults')) && request()->get('no_of_adults') >1)?1:0])
        </div>
    </div>
@else
    <div class="card mb-3">
        <div class="card-header">
            <div class="chevron-down-up">
                <h5 class="mb-0">Partner info</h5>
                <p class="click-down" data-id="partner"><span class="fas fa-chevron-down"></span></p>
            </div>
        </div>
        <div class="card-body bg-light" data-id="partner" id="partner_div">
            @include('CRM.elements.customers.partner',['number'=>$obj->no_of_adults-1])
        </div>
    </div>
@endif
