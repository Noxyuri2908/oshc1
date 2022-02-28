@foreach($templateDatas as $data)
    <tr id="archive_media_data_{{$data->id}}">
        <th>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownWebsiteTask"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownWebsiteTask">
                    <div class="bg-white py-2">
                        <a class="dropdown-item" data-id="{{$data->id}}" data-url="" href="{{route('template_invoice_manager.edit',['id'=>$data->id])}}">Edit</a>
                    </div>
                </div>
            </div>
        </th>
        <td class="white-space-preline-report"><a href="{{route('template_invoice_manager.showTemplateInvoice',['id'=>$data->id])}}" class="show-template-btn"> {{!empty($invoiceTypeConfig[$data->template_name])?$invoiceTypeConfig[$data->template_name]:''}}</a></td>
        <td class="white-space-preline-report">{{$data->company_address}}</td>
        <td class="white-space-preline-report"><a href="{{$data->logo}}" class="show-template-btn">{{$data->logo}}</a></td>
        <td class="white-space-preline-report">{{$data->company_name}}</td>
    </tr>
@endforeach
