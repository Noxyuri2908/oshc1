@extends('CRM.layouts.default')

@section('title')
    STATUS
    @parent
@stop

@section('css')
    @include('CRM.partials.css-list')
@stop
@section('content')
    <div class="row">
        <div class="col">
            <form autocomplete="off" class="card"
                  action="{{ empty($status) ? route('status.store') : route('status.update', ['status' => $status->id]) }}"
                  method="post">
                @csrf
                @if (!empty($status)) @method('PUT') @endif

                <div class="card-header">
                    <h3 class="card-title">
                        {{ !empty($status) ? __('Edit status: :title', ['title' => $status->name]) : __('Create status') }}
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('status.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-long-arrow-alt-left mr-3"></i>{{ __('List of statuses') }}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('Name') }}</label>
                                <input
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') ?: (!empty($status) ? $status->name : '') }}"
                                    required
                                    placeholder="{{ __('Name') }}" class="form-control"
                                >
                                @error('name')
                                <span class="error invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ __('Type') }}</label>
                                <select
                                    name="type"
                                    class="form-control @error('type') is-invalid @enderror"
                                    required>
                                    <option value=''>{{ __('Select') }}</option>
                                    @foreach ($type as $item)
                                        <option value="{{ $item }}"
                                                @if(old('type')== $item || ( !empty($status) && $status->type == $item)) selected @endif>{{ trans('lang.'.$item) }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                <span class="error invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group" id="value_status_group">
                                <label>Giá trị</label>
                                @if(!empty($statusValues))
                                    @foreach($statusValues as $statusValue)
                                    @if($loop->index == 0)
                                        <div class="">
                                            <input type="text" name="value[]" value="{{$statusValue}}" class="form-control input_value_status"
                                                   placeholder="Nhập giá trị">
                                        </div>
                                    @elseif($loop->index >= 1)
                                        <div class="fieldwrapper row " id="field1">
                                            <div class="col-md-11"><input type="text"
                                                                          class="form-control input_value_status"
                                                                          value="{{$statusValue}}"
                                                                          name="value[]" placeholder="Nhập giá trị"
                                                                          required=""></div>
                                            <div class="col-md-1"><input type="button" class="remove btn btn-default"
                                                                         value="-"></div>
                                        </div>
                                    @endif
                                    @endforeach
                                @else
                                    <div class="">
                                        <input type="text" name="value[]" value="" class="form-control input_value_status"
                                               placeholder="Nhập giá trị">
                                    </div>
                                @endif
                            </div>
                            <a href="#" class="plus-value">Thêm giá trị</a>
                        </div>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(".plus-value").click(function (e) {
            e.preventDefault();
            var lastField = $("#value_status_group div:last");
            var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
            var fieldWrapper = $("<div class=\"fieldwrapper row \" id=\"field" + intId + "\"/>");
            fieldWrapper.data("idx", intId);
            var fName = $("<div class=\"col-md-11\"><input type=\"text\" class=\"form-control input_value_status\" value=\"\" name=\"value[]\" placeholder=\"Nhập giá trị\" required></div>");
            var removeButton = $("<div class=\"col-md-1\"><input type=\"button\" class=\"remove btn btn-default\" value=\"-\" /></div>");
            removeButton.click(function () {
                $(this).parent().remove();
            });
            fieldWrapper.append(fName);
            fieldWrapper.append(removeButton);
            $("#value_status_group").append(fieldWrapper);
        });
    </script>
@endpush
