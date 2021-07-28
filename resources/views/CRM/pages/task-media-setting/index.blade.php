@extends('CRM.layouts.default')

@section('title')
    Media Setting
    @parent
@stop

@section('css')
    @include('CRM.partials.css-list')
    @include('CRM.partials.css-table-filter')
@endsection
@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <h5>Media Setting</h5>
                <div class="d-flex justify-content-end">
                    <a href="#" class="btn btn-success " id="btn_add_new_media_setting"><i class="fas fa-plus"></i></a>
                    <a href="#" class="delete-filter btn btn-primary ml-2">Delete Filter</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-media-setting table-div">
                    <table class="">
                        <thead class="">
                            <tr class="first-row">
                                <th class="width-80">Action</th>
                                <th class="width-100">Type</th>
                                <th class="width-200">Name</th>
                                <th class="width-170">Category</th>
                            </tr>
                            @include('CRM.pages.task-media-setting.filter')
                        </thead>
                        <tbody id="media-setting-table-tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="modal_media_setting_form"></div>
    </div>
@endsection
@push('scripts')
    @include('CRM.pages.task-media-setting.script-load',[
'nameAction'=>'MediaSetting',
'valueNameField'=>[
    'type',
    'name'
],
'urlGetData'=>route('task_media_status.getData'),
'elementIdTableData'=>'media-setting-table-tbody',
'elementClassSubmitForm'=>'btn_submit_media_setting_form',
'elementIdEachData'=>'media_setting_data',
'elementIdModalForm'=>'modal_media_setting',
'elementIdCreateForm'=>'btn_add_new_media_setting',
'urlCreateForm'=>route('task_media_status.create'),
'elementIdRenderModalForm'=>'modal_media_setting_form',
'elementClassEditForm'=>'edit_media_setting_data',
'elementClassDeleteForm'=>'delete_media_setting_data',
'table_element_class_scroll'=>'table-media-setting'
])
    <script>

    </script>
@endpush

