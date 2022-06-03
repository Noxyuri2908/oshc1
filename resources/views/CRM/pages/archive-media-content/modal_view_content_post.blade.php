<div class="modal fade" id="modalViewContentPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog w-100" role="document" style="max-width: 1000px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$archiveMediaContent->title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body post-cont">
                {!! $archiveMediaContent->content !!}
            </div>
        </div>
    </div>
</div>
