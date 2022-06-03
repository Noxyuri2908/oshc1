<div class="col-xl-12">
@if(empty($obj))
    <div class="card mb-3">
        <div class="card-header">
            <div class="chevron-down-up">
                <h5 class="mb-0">Children info</h5>
                <p class="click-down" data-id="child"><span class="fas fa-chevron-down"></span></p>
            </div>
        </div>
        <div class="card-body bg-light" data-id="child" id="child_div">
            @include('CRM.elements.customers.child',['number'=>(!empty(request()->no_of_children))?request()->no_of_children:0])
        </div>
    </div>
@else
    <div class="card mb-3">
        <div class="card-header">
            <div class="chevron-down-up">
                <h5 class="mb-0">Children info</h5>
                <p class="click-down" data-id="child"><span class="fas fa-chevron-down"></span></p>
            </div>
        </div>
        <div class="card-body bg-light" data-id="child" id="child_div">
            @include('CRM.elements.customers.child',['number'=>$childrens->count()])
        </div>
    </div>
@endif
</div>
