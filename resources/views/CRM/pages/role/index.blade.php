@extends('CRM.layouts.default')

@section('title')
    Role list
    @parent
@stop

@section('css')
    @include('CRM.partials.css-list')
    @include('CRM.pages.css.customer-css')
    <style>
        .table-div .form-control {
            height: 28px;
        }

        /*.table-div {*/
        /*    max-width: 100%;*/
        /*    position: relative;*/
        /*    overflow: scroll;*/
        /*    height: 32em;*/
        /*    max-height: 32em;*/
        /*}*/

        table {
            position: relative;
            border-collapse: collapse;
            white-space: nowrap;
            table-layout: fixed;
            width: 100%;
        }

        table td, table th {

        }

        td,
        th {
            padding: 0.25em;
        }

        thead th {
            font-size: 0.83rem;
        }

        thead .first-row th {
            position: -webkit-sticky; /* for Safari */
            position: sticky;
            top: 0;
            background: #007bff;
            color: #fff;
        }

        thead .last-row th {
            position: -webkit-sticky; /* for Safari */
            position: sticky;
            background: #eae7e7;
            color: #fff;
        }

        .top-80 {
            top: 25px;
        }

        .last-row th {
            top: 25px;
        }

        .table-div thead th input, .table-div thead th select, .table-div tbody th, .table-div tbody td {
            font-size: 0.83rem;
        }

        thead .first-row th:first-child, thead .last-row th:first-child {
            /* left: 0; */
            z-index: 1;
        }

        /* tbody th {
            position: -webkit-sticky;
            position: sticky;
            left: 0;
            background: #FFF;
            border-right: 1px solid #CCC;
        } */
        tbody th, tbody td {
            border-bottom: 1px solid #ccc;
        }

        .width-80 {
            width: 80px;
        }

        .width-220 {
            width: 220px;
        }

        .width-170 {
            width: 170px;
        }

        .width-200 {
            width: 200px;
        }

        .width-500 {
            width: 500px;
        }

        .width-300 {
            width: 300px;
        }

        .width-100 {
            width: 100px;
        }

        .white-space-break-spaces {
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .bg-pale-gray {
            background-color: #eae7e7
        }

        .table-div select {
            padding: 0 20px;
        }

        #sale_task .card-body {
            padding: 0.5%;
        }

        #sale_task h5 {
            font-family: 'roboto', sans-serif !important;
            font-weight: 600;
        }
    </style>

@stop
@section('content')
    <div class="card" style="height: 100vh">
        <div class="card-header border-bottom">
            <div class="d-flex justify-content-between">
                <p class="h4">Role group</p>
                <a href="{{route('roles.create')}}" class="btn btn-primary">Create</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="table-div">
                    <table class="table">
                        <thead>
                        <tr>
                            <th width="50">ID</th>
                            <th>Role Name</th>
                            {{--<th>Users</th>--}}
                            <th>Note</th>
                            <th>Permission</th>
                            <th width="200">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
{{--                                <td><a href="#" class="see-user" data-url="{{route('')}}"><i class="fas fa-eye"></i></a></td>--}}
                                <td>{{ $role->note }}</td>
                                <td>
                                    <a href="{{route('permissions.index',['id'=>$role->id])}}"
                                       class="btn btn-info btn-xs mr5">
                                        <i class="fas fa-sliders-h"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('roles.edit',['id'=>$role->id])}}"
                                       class="mr5 btn btn-default">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#"
                                       onclick="return confirm('are you sure to delete?')" class="btn btn-default"><i class="fas fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

