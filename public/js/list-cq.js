var save_data_fillter = $('#base_path').val() + "crm/data-fillter/chinh-quy/save";
var get_old_fillter = $('#base_path').val() + "crm/data-fillter/chinh-quy/get";
var bolocs = [];
var count_record = 0;
var count_send_email = 0;
var count_ghichu = 0;
var count_send_sms = 0;
var count_send_giayht = 0;
var count_in_giaynh = 0;
var count_ngaygoilai = 0;
var check_nam_boloc = false;

$.get(get_old_fillter, { query: "" }, function (data) {
      bolocs = data;
});

function resetCount(){
  count_record = 0;
  count_send_email = 0;
  count_send_sms = 0;
  count_ghichu = 0;
  count_send_giayht = 0;
  count_in_giaynh = 0;  
  count_ngaygoilai = 0;  
}
//luu data fillter
function saveDataFillter(){
  _ten = $('#f_name').val();
  _sdt = $('#f_phone').val();
  _ngaysinh = $('#f_birthday').val();
  _cmt = $('#f_cmt').val();
  _magnh = $('#f_magnh').val();
  _ngay = $('#f_date').val();
  _ngaybatdau = $('#f_ngaybatdau').val();
  _ngayketthuc = $('#f_ngayketthuc ').val();
  _boloc = bolocs;
  _tinh = $('#sl_tinh').val();
  $.get(save_data_fillter, { ten: _ten, sdt: _sdt, ngaybatdau: _ngaybatdau,
      ngayketthuc: _ngayketthuc, 
      ngaysinh: _ngaysinh, cmt: _cmt, magnh: _magnh, 
      ngay: _ngay, boloc: _boloc, tinh: _tinh, }, function (data) {
      console.log(data);
  });
}

function saveDataFillter2(){
  _ten = $('#f_name').val();
  _sdt = $('#f_phone').val();
  _ngaysinh = $('#f_birthday').val();
  _cmt = $('#f_cmt').val();
  _magnh = $('#f_magnh').val();
  _ngay = $('#f_date').val();
  _ngaybatdau = $('#f_ngaybatdau').val();
  _ngayketthuc = $('#f_ngayketthuc ').val();
  _boloc = bolocs;
  _tinh = $('#sl_tinh').val();
  $.get(save_data_fillter, { ten: _ten, sdt: _sdt, ngaybatdau: _ngaybatdau,
      ngayketthuc: _ngayketthuc, 
      ngaysinh: _ngaysinh, cmt: _cmt, magnh: _magnh, 
      ngay: _ngay, boloc: _boloc, tinh: _tinh, }, function (data) {
      window.location=$('#base_path').val()+"crm/chinh-quy/";
  });
}

function multiselect_deselectAll($el) {
  $('option', $el).each(function(element) {
    $el.multiselect('deselect', $(this).val());
  });
}

function clearDataFillter()
{
  $('#f_name').val("");
  $('#f_phone').val("");
  $('#f_birthday').val("");
  $('#f_cmt').val("");
  $('#f_magnh').val("");
  $('#f_date').prop('selectedIndex',0);
  $('#f_ngaybatdau').val("");
  $('#f_ngayketthuc').val("");
  $('#sl_tinh').each(function() {
    var select = $(this);
    multiselect_deselectAll(select);
  });
  bolocs = [];
  $('#searchFillter').each(function() {
    $('li').each(function(){
      $(this).removeClass('active');
    }); 
  });
  $('.item-list').empty();
  saveDataFillter();
}

$("#input_fillter").bsMultiSelect({
    selectedPanelDefMinHeight: 'calc(2.25rem + 2px)',  // default size
    selectedPanelLgMinHeight: 'calc(2.875rem + 2px)',  // LG size
    selectedPanelSmMinHeight: 'calc(1.8125rem + 2px)', // SM size
    selectedPanelDisabledBackgroundColor: '#e9ecef',   // disabled background
    selectedPanelFocusBorderColor: '#80bdff',          // focus border
    selectedPanelFocusBoxShadow: '0 0 0 0.2rem rgba(0, 123, 255, 0.25)',  // foxus shadow
    selectedPanelFocusValidBoxShadow: '0 0 0 0.2rem rgba(40, 167, 69, 0.25)',  // valid foxus shadow
    selectedPanelFocusInvalidBoxShadow: '0 0 0 0.2rem rgba(220, 53, 69, 0.25)',  // invalid foxus shadow
    inputColor: '#495057', // color of keyboard entered text
    selectedItemContentDisabledOpacity: '.65' // btn disabled opacity used
});
$("#cotcanxem").bsMultiSelect({
    selectedPanelDefMinHeight: 'calc(2.25rem + 2px)',  // default size
    selectedPanelLgMinHeight: 'calc(2.875rem + 2px)',  // LG size
    selectedPanelSmMinHeight: 'calc(1.8125rem + 2px)', // SM size
    selectedPanelDisabledBackgroundColor: '#e9ecef',   // disabled background
    selectedPanelFocusBorderColor: '#80bdff',          // focus border
    selectedPanelFocusBoxShadow: '0 0 0 0.2rem rgba(0, 123, 255, 0.25)',  // foxus shadow
    selectedPanelFocusValidBoxShadow: '0 0 0 0.2rem rgba(40, 167, 69, 0.25)',  // valid foxus shadow
    selectedPanelFocusInvalidBoxShadow: '0 0 0 0.2rem rgba(220, 53, 69, 0.25)',  // invalid foxus shadow
    inputColor: '#495057', // color of keyboard entered text
    selectedItemContentDisabledOpacity: '.65' // btn disabled opacity used
});

$(".flatpickr").flatpickr({
  maxDate: "today",
  dateFormat: "d/m/Y",
});

$('#info-table').DataTable( {
  responsive: {
    details: false
  },
  "lengthMenu": [[10, 20, 30, 50], [10, 20, 30, 50]],
  "language": {
    "lengthMenu": 'Hiển thị <select class="form-control">'+
    '<option value="10">10</option>'+
    '<option value="20">20</option>'+
    '<option value="30">30</option>'+
    '<option value="50">50</option>'+
    '</select> bản ghi'
  },
  columnDefs: [
    { targets: 'no-sort', orderable: false }
    ],
  "preDrawCallback": function( settings ) {
    resetCount();
  }
});

var table = $('#info-table').DataTable();

//su kien search

Date.prototype.getWeek = function(start)
{
    //Calcing the starting point
    start = start || 0;
    var today = new Date(this.setHours(0, 0, 0, 0));
    var day = today.getDay() - start;
    var date = today.getDate() - day;

    // Grabbing Start/End Dates
    var StartDate = new Date(today.setDate(date));
    var EndDate = new Date(today.setDate(date + 6));
    return [StartDate, EndDate];
}

function compareDate(d1, d2){
  var date1 = new Date(d1);
  var date2 = new Date(d2);
    
  return date1 >= date2;

}

$('#master').on('click', function(e) {
    if($(this).is(':checked',true))  
    {
      $(".sub_chk").prop('checked', true);  
    } else {  
      $(".sub_chk").prop('checked',false);  
    }
    var allVals = [];  
    $(".sub_chk:checked").each(function() {  
      allVals.push($(this).attr('data-id'));
    });
    count = allVals.length;
    $('.count-tick').empty().html(count);  
});

$(".sub_chk").on('click', function(e) {
    if(!$(this).is(':checked',true))  
    {
      $('#master').prop('checked', false);  
    }
    var allVals = [];
    $(".sub_chk:checked").each(function() {  
      allVals.push($(this).attr('data-id'));
    });
    count = allVals.length;
    $('.count-tick').empty().html(count);  
});

$('.delete-all').on('click', function(e) {
    var allVals = [];  
    $(".sub_chk:checked").each(function() {  
      allVals.push($(this).attr('data-id'));
    }); 
    if(allVals.length <= 0){
      $('#crm-warning').modal('show');
    }else{
      route = $(this).data('route');
      $('#crm-deleteModal').find('#form-delete-modal').attr('action', route);
      $('#page-id').val(2);
      $('#data-del').val(allVals.toString());
      $('#crm-deleteModal').modal('show');
    }
});

$('.attach-user').on('click', function(e) {
    var allVals = [];  
    $(".sub_chk:checked").each(function() {  
      allVals.push($(this).attr('data-id'));
    });
    data_user = $(this).data('user');
    if(allVals.length <= 0){
      $('#crm-warning').modal('show');
    }else{
      route = $(this).data('route');
      $('#crm-attachModal').find('#form-attach-modal').attr('action', route);
      $('#data-attach').val(allVals.toString());
      $('#data-user').val(data_user);
      $('#crm-attachModal').modal('show');
    }
});

$('.scan-data').on('click', function(e) {
    var allVals = [];  
    $(".sub_chk:checked").each(function() {  
      allVals.push($(this).attr('data-id'));
    });
    data_type = $(this).data('type');
    if(allVals.length <= 0){
      $('#crm-warning').modal('show');
    }else{
      
      route = $(this).data('route');     
      if (data_type == 1){
        $('#page-id-gnh').val(2);
        $('#crm-scan-gnh').find('#form-scan-gnh').attr('action', route);
        $('#data-scan-gnh').val(allVals.toString());
        $('#crm-scan-gnh').modal('show');
      }else if(data_type == 2){
        $('#page-id-ght').val(2);
        $('#crm-scan-ght').find('#form-scan-ght').attr('action', route);
        $('#data-scan-ght').val(allVals.toString());
        $('#crm-scan-ght').modal('show');        
      }else if(data_type == 3){
        $('#page-id-donxt').val(2);
        $('#crm-scan-donxt').find('#form-scan-donxt').attr('action', route);
        $('#data-scan-donxt').val(allVals.toString());
        $('#crm-scan-donxt').modal('show');
      }
      
    }
});

$('.export-data').on('click', function(e) {
    var allVals = [];  
    $(".sub_chk:checked").each(function() {  
      allVals.push($(this).attr('data-id'));
    });
    data_type = $(this).data('type');
    route = $(this).data('route');
    $('#crm-exportModal').find('#form-export-modal').attr('action', route);
    $('#data-export-cq').val(allVals.toString());
    $('#crm-exportModal').modal('show');
});

$('.send-data').on('click', function(e) {
    var allVals = [];  
    $(".sub_chk:checked").each(function() {  
      allVals.push($(this).attr('data-id'));
    });
    data_type = $(this).data('type');
    if(data_type == 1){
      $('#send-data-title').html('Bạn muốn gửi email cho các học viên đã chọn.');
      $('#send-data-type').val(1);
    }else{
      $('#send-data-title').html('Bạn muốn gửi sms cho các học viên đã chọn.');
      $('#send-data-type').val(2);    
    }
    if(allVals.length <= 0){
      $('#crm-warning').modal('show');
    }else{
      route = $(this).data('route');
      $('#crm-emailModal').find('#form-modal-mail').attr('action', route);
      $('#page-id').val(2);
      $('#data-email').val(allVals.toString());
      $('#crm-emailModal').modal('show');
    }
});

$(document).on('keypress',function(e) {
    if(e.which == 13) {
        saveDataFillter2();
    }
});