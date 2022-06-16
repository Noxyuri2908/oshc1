<!-- Modal -->
<div class="modal fade" id="apply-modal" tabindex="-1" role="dialog" aria-labelledby="apply-modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content p-2">
            <div class="modal-header m-auto" style="border: 0px;">
                <p class="modal-title text-center" id="modalTitle">New Commission Report</p>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-2 m-auto label">Agent</div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" placeholder="Agent name" value="{{ isset($gst->name) ? $gst->name : '#' }}">
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-2 m-auto label">Report ID</div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" placeholder="Report id" value="{{ isset($newComReportId) ? $newComReportId : 1 }}">
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-2 m-auto label">Month</div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Month" value="{{ date('m') }}">
                    </div>
                    <div class="col-md-2 m-auto label">Year</div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Year" value="{{ date('Y') }}">
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-2 m-auto label">OSHC</div>
                    <div class="col-md-4">
                        <input class="form-check-input mx-0" type="checkbox"
                               @if(isset($view) && isset($status) && $view == "oshc" && $status == "on")
                               checked
                               @endif
                               id="oshcCheckDefault">
                    </div>
                    <div class="col-md-2 m-auto label">Insurance</div>
                    <div class="col-md-4">
                        <input class="form-check-input mx-0" type="checkbox"
                               @if(isset($view) && isset($status) && $view == "insurance" && $status == "on")
                               checked
                               @endif
                               id="insuranceCheckDefault">
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-md-2 m-auto label">Created by</div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" placeholder="Created by" value="{{ \Illuminate\Support\Facades\Auth::user()->username }}">
                    </div>
                </div>
            </div>
            <div class="modal-footer m-auto" style="border: 0px;">
                <button type="button" class="btn" id="save_report" onclick="document.getElementById('dis_save_report').click()">Save</button>
                <button type="button" class="btn" id="dis_save_report" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
