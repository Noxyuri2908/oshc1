<ul class="nav nav-tabs mt-3 myGroupList" id="myGroupList{{$type_tab}}" role="tablist">
    @include('CRM.elements.task.checklist-and-task.task.tab-list',['type'=>$type_tab])
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="card card{{$type_tab}}">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    @can('check-list-group.index')
                        <a href="{{route('check-list-group.index')}}" class="btn btn-primary font-size-13px"
                           id="show-group-check-list">Show group</a>
                    @endcan
                    <a href="#" class="btn btn-primary font-size-13px ml-2" id="delete_all_filter_checklist">Delete
                        Filter</a>
                    @can('check-list.store')
                        <a href="#" class="btn btn-primary font-size-13px ml-2" id="btn_add_new_task">
                            <svg class="svg-inline--fa fa-plus fa-w-14" aria-hidden="true" data-prefix="fas"
                                 data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                 data-fa-i2svg="">
                                <path fill="currentColor"
                                      d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
                            </svg><!-- <i class="fas fa-plus"></i> --></a>
                    @endcan
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-check-list table-div">
                    <table class="">
                        <thead class="">
                        <tr class="first-row">
                            <th class="width-80">Action</th>
                            <th class="width-200">Type</th>
                            <th class="width-200">Type of task</th>
                            <th class="width-200">Person in charge</th>
                            <th class="width-200">Problem</th>
                            <th class="width-200">Date of suggestion</th>
                            <th class="width-200">Result</th>
                            <th class="width-200">Creation date</th>
                        </tr>
                        @include('CRM.elements.task.checklist-and-task.checklist.filter',compact('type_tab'))
                        </thead>
                        <tbody id="{{$type_tab}}-table-tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    @include('CRM.elements.task.checklist-and-task.partials.script',['type'=>$type_tab])
@endpush
