<table class="table table-md mb-0 table-dashboard fs--1 ">
    <thead class="bg-200 text-900">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Type file</th>
            <th>Note</th>
            <th>Staff</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($totalDocs))
            @foreach($totalDocs as $_tailieu)
                <tr>
                    <td class="align-middle">{{$loop->index+1}}</td>
                    <td class="align-middle">{{$_tailieu->name}}</td>
                    <td class="align-middle">{{$_tailieu->type_file}}</td>
                    <td class="align-middle">{{$_tailieu->note}}</td>
                    <td class="align-middle">{{$_tailieu->staff != null ? $_tailieu->staff->username : ''}}</td>
                    <td class="align-middle">
                        <a href="{{$_tailieu->link_download()}}" target="_blank"><span
                                class="fas fa-eye"></span></a>
                        @can('customerDoc.edit')
                            <a data-id="{{$_tailieu->id}}" style="cursor: pointer" class="edit_doc"><span
                                    class="far fa-edit"></span></a>
                        @endcan

                        <a href="{{$_tailieu->link_download()}}" download><span
                                class="fas fa-cloud-download-alt"></span></a>
                        @can('customerDoc.delete')
                            <a style="cursor: pointer" data-url="{{route('apply.tailieu.destroy')}}"
                               data-id="{{$_tailieu->id}}"
                               class="delete_doc"><span class="far fa-trash-alt"></span></a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        @else
            No data!
        @endif
    </tbody>
</table>


