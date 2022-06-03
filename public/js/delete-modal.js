jQuery(document).ready(function($) {
  jQuery('.delete-button').click(function(e) 
  { 
    action = jQuery(this).data('action');
    jQuery('#deleteModal').find('#modal-form-delete').attr('action', action);
    jQuery('#deleteModal').modal('show');
  });
});