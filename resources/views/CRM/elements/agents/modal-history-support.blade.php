@if($obj != null)
@php
$supports = $obj->supports()->get();
@endphp
@if(count($supports) >= 0)
<div class="modal fade user-information" id="modal_hisory_support" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail support</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="content-information">
          <h3 class="name">
            {{$obj->name}}
          </h3>
        </div>
          <table class="table">
            <thead>
              <tr>
                <th class="text-left" scope="col">Date</th>
                <th class="text-left" scope="col">Content</th>
                <th class="text-right" scope="col">Staff</th>
              </tr>
            </thead>
            <tbody>
              @foreach($supports as $support)
              <tr>
                <td class="text-left">{{$support->ngaygoi}}</td>
                <td class="text-left">{!! $support->noidung !!}</td>
                <td class="text-right">{{$support->admin != null ? $support->admin->username : ''}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endif
@endif
