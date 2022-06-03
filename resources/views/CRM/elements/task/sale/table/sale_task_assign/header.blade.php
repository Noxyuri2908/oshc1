<thead class="">
    <tr class="first-row">
        <th class="width-100">Action</th>
        <th class="width-300">Processing date</th>
        <th class="width-200">Item</th>
        <th class="width-200">Type</th>
        <th class="width-300">Deadline</th>
        <th class="width-200">Result</th>
        <th class="width-500">Note</th>
    </tr>
    <tr class="last-row">
        <th>
        </th>
        <th class="d-flex">
            <input type="text" class="form-control mr-2" id="processing_date_training_start" placeholder="Date start">
            <input type="text" class="form-control" id="processing_date_training_end" placeholder="Date end">
        </th>
        <th>
            {{-- <input type="text" class="form-control" id="item_training_filter" placeholder="Item"> --}}
        </th>
        <th>
            <select name="" id="type_training_filter" class="form-control">
                <option value="">Type</option>
                @foreach(config('myconfig.type_training_task_sale') as $key=>$status)
                    <option value="{{$key}}">{{$status}}</option>
                @endforeach
            </select>
        </th>
        <th class="d-flex">
            <input type="text" class="form-control mr-2" id="deadline_training_start" placeholder="Date start">
            <input type="text" class="form-control" id="deadline_training_end" placeholder="Date end">
        </th>
        <th>
            <select name="" id="result_training_filter" class="form-control">
                <option value="">Result</option>
                @foreach(config('myconfig.result_training_task_sale') as $key=>$status)
                    <option value="{{$key}}">{{$status}}</option>
                @endforeach
            </select>
        </th>
        <th></th>
    </tr>
</thead>
