@foreach($getDataOshcOvhcHcc as $keyOshcOvhcHcc=>$dataOshcOvhcHcc)
    <tr>
        <td class="white-space-break-spaces text-overflow">{{$keyOshcOvhcHcc}}</td>
        <td class="white-space-break-spaces text-overflow">{{$dataOshcOvhcHcc['pendingInvoice']}}</td>
        <td class="white-space-break-spaces text-overflow">{{$dataOshcOvhcHcc['certificase']}}</td>
        <td class="white-space-break-spaces text-overflow">{{$dataOshcOvhcHcc['extendRemind']}}</td>
        <td class="white-space-break-spaces text-overflow">{{$dataOshcOvhcHcc['extendSuccessfully']}}</td>
    </tr>
@endforeach
@foreach($getDataFlywire as $keyFlywire=>$dataFlywire)
    <tr>
        <td class="white-space-break-spaces text-overflow">{{$keyFlywire}}</td>
        <td class="white-space-break-spaces text-overflow">{{$dataFlywire['pendingInvoice']}}</td>
        <td class="white-space-break-spaces text-overflow">{{$dataFlywire['certificase']}}</td>
        <td class="white-space-break-spaces text-overflow">{{$dataFlywire['extendRemind']}}</td>
        <td class="white-space-break-spaces text-overflow">{{$dataFlywire['extendSuccessfully']}}</td>
    </tr>
@endforeach
