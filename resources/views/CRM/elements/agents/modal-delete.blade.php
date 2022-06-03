<div class="modal fade user-information delete-controlog" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
        <div class="comment-d">
         <p>Are you sure delete data ?</p>
       </div>
       <div class="button-contenr">
        <form action="{{route('crm.agent.delete')}}" method="POST">
        @csrf
        <input type="hidden" value="" name="agent_id" id="agent_id">
        <button class="btn btn-secondary btn-sm yes" type="submit" >Yes</button>
        
        <button class="btn btn-secondary btn-sm no" type="button" data-dismiss="modal">No</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>