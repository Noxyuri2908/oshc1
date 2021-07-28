var is_savedataFillter = false;

$('#f_name, #f_phone, #f_birthday, #f_cmt, #f_magnh').on('change', function() {
	saveDataFillter();
	resetCount();
    table.draw();
});

$('#f_nganhxt, #f_date, #f_ngaygoilai').change( function() {
	option_selected = $('#f_date').val();
	if(option_selected != 10){
		$('#f_ngayketthuc').val("");
		$('#f_ngaybatdau').val("");	
	}
	saveDataFillter();
	resetCount();
  	table.draw();
});
$( "#f_ngaybatdau" ).datepicker({
    onSelect: function(d,i){
    	saveDataFillter();
    	table.draw();

    },
    dateFormat: 'dd/mm/yy'
 });
$( "#f_ngayketthuc" ).datepicker({
    onSelect: function(d,i){
    	saveDataFillter();
    	table.draw();
    },
    dateFormat: 'dd/mm/yy'
});
function getResultBoloc(data){
	res = false;
	if(bolocs.length <= 0){
		return true;
	}
	tvv = true;
	nganhhoc = true;	
	tthoso = true;
	ttdata = true;
	ptxt = true;
	namtx = true;
	ttnhaphoc = true;
	doitac = true;
	langoi = true;
	ingnh = true;
	inght = true;
	email = true;
	sms = true;
	ltdieuduong = true;
	tongdiem3mon = true;
	nguontt = true;
	for( var i = 0; i < bolocs.length; i++){
		tmp_arr = bolocs[i].split(":");
		if(tmp_arr.length == 4){
			switch(tmp_arr[0]) 
			{
				case "tvv":
					tvv = false;
			    	break;
			    case "ltdieuduong":
					ltdieuduong = false;
			    	break;
		    	case "nganhhoc":
			    	nganhhoc = false;
			    	break;
		    	case "tthoso":
			    	tthoso = false;
			    	break;
		    	case "ttdata":
			    	ttdata = false;
			    	break;
		    	case "ptxt":
		    		ptxt = false;
			    	break;
		    	case "nam_tuyen_sinh":
		    		namtx = false;
		    		check_nam_boloc = true;
			    	break;
		    	case "ttnhaphoc":
			    	ttnhaphoc = false;
			    	break;
		    	case "doitac":
			    	doitac = false;
			    	break;
		    	case "langoi":
			    	langoi = false;
			    	break;
		    	case "ingnh":
		    		ingnh = false;
			    	break;
		    	case "inght":
			    	inght = false;
			    	break;
		    	case "email":
			    	email = false;
			    	break;
		    	case "sms":
			    	sms = false;
			    	break;
		    	case "tongdiem3mon":
			    	tongdiem3mon = false;
			    	break;
		    	case "nguontt":
			    	nguontt = false;
			    	break;
			}
		}
	}    
	for( var i = 0; i < bolocs.length; i++){ 
      tmp_arr = bolocs[i].split(":");
      if(tmp_arr.length == 4){
      	switch(tmp_arr[0]) {
		    case "tvv":
			    _data =  (data[49] != null) ? data[49] : "";
			    tvv = tvv || (_data == tmp_arr[3]);;
			    break;				    
		    case "nganhhoc":
			    _data = (data[8] != null) ? data[8] : "";
			    if(_data == null || _data == ""){
			   		break;
			    }
			    nganhhoc = nganhhoc || (_data == tmp_arr[3]);;
		    	break;
			case "tthoso":
			    _dxt =  (data[41] != null) ? data[41] : "";
			    _hocba =  (data[42] != null) ? data[42] : "";
			    _bangcntt =  (data[43] != null) ? data[43] : "";
			    if(tmp_arr[3] == "Chưa có hồ sơ"){
			        tthoso = tthoso || (_dxt.includes('False') && _hocba.includes('False') && _bangcntt.includes('False'));
			    }else if(tmp_arr[3] == "Thiếu hồ sơ"){
			        tthoso = tthoso || (_dxt.includes('False') || _hocba.includes('False') || _bangcntt.includes('False'));
			    }else if(tmp_arr[3] == "Đủ hồ sơ"){
			        tthoso = tthoso || (_dxt.includes('True') && _hocba.includes('True') && _bangcntt.includes('True'));
			    }
			    break;
			case "ttdata":
			    _data =  (data[47] != null) ? data[47] : "";
			    if(_data == null || _data == ""){
			   		break;
			    }
			    ttdata = ttdata || (_data == tmp_arr[3]);;			   			    	
			    break;
			case "ptxt":
			    _data =  (data[32] != null) ? data[32] : "";
			    if(_data == null || _data == ""){
			   		break;
			    }			   
			    ptxt = ptxt || (_data == tmp_arr[3]);;
			    break;
			case "nam_tuyen_sinh":
			    _data =  (data[30] != null) ? data[30] : "";
			    if(_data == null || _data == ""){
			   		break;
			    }			   
			    namtx = namtx || (_data == tmp_arr[3]);
			    break;
			case "ttnhaphoc":
			    _data =  (data[31] != null) ? data[31] : "";	
			    if(tmp_arr[3] == "Chưa nhập học"){
			        ttnhaphoc = ttnhaphoc || _data.includes('False');
			    }else if(tmp_arr[3] == "Đã nhập học"){
			        ttnhaphoc = ttnhaphoc || _data.includes('True');
			    }
			    break;
			case "doitac":
			    _data =  (data[28] != null) ? data[28] : "";
			    if(_data == null || _data == ""){
			   		break;
			    }			   
			    doitac = doitac || (_data == tmp_arr[3]);;
			    break;
			case "langoi":
			    _data =  (data[14] != null) ? data[14] : "";			   
			    langoi = langoi || (_data == tmp_arr[3]);;
			    break;
			case "ingnh":
			    _data =  (data[13] != null) ? data[13] : "";	
			    if(tmp_arr[3] == "Chưa in"){
			        ingnh = ingnh || _data.includes('False');
			    }else if(tmp_arr[3] == "Đã in"){
			        ingnh = ingnh || _data.includes('True');
			    }
			    break;
			case "ltdieuduong":
			    _data =  (data[48] != null) ? data[48] : "";
			    if(tmp_arr[3] == "Không"){
			        ltdieuduong = ltdieuduong || _data.includes('False');
			    }else if(tmp_arr[3] == "Có"){
			        ltdieuduong = ltdieuduong || _data.includes('True');
			    }
			    break;
			case "inght":
			    _data =  (data[12] != null) ? data[12] : "";	
			    if(tmp_arr[3] == "Chưa in"){
			        inght = inght || _data.includes('False');
			    }else if(tmp_arr[3] == "Đã in"){
			        inght = inght || _data.includes('True');
			    }
			    break;
			case "email":
			    _data =  (data[10] != null) ? data[10] : "";	
			    if(tmp_arr[3] == "Chưa gửi"){
			        email = email || _data.includes('False');
			    }else if(tmp_arr[3] == "Đã gửi"){
			        email = email || _data.includes('True');
			    }
			    break;
			case "sms":
			    _data =  (data[11] != null) ? data[11] : "";	
			    if(tmp_arr[3] == "Chưa gửi"){
			        sms = sms || _data.includes('False');
			    }else if(tmp_arr[3] == "Đã gửi"){
			        sms = sms || _data.includes('True');
			    }
			    break;
			case "tongdiem3mon":
			    _data =  (data[39] != null) ? data[39] : "";
			    if(_data == null || _data == ""){
			   		break;
			    }	
			    arr_diem = tmp_arr[3].split("-");
			    if(arr_diem.length == 2){
			        tongdiem3mon = tongdiem3mon || (parseFloat(_data) >= parseFloat(arr_diem[0]) && parseFloat(_data) <= parseFloat(arr_diem[1]));
			    }else{
			    	arr_diem = tmp_arr[3].split(">");
			    	if(arr_diem.length > 0){
			    		tongdiem3mon = tongdiem3mon || (parseFloat(_data) > parseFloat(arr_diem[1]));
			    	}
			    	arr_diem = tmp_arr[3].split("<");
			    	if(arr_diem.length > 0){
			    		tongdiem3mon = tongdiem3mon || (parseFloat(_data) < parseFloat(arr_diem[1]));
			    	}
			    }
			    break;
			case "nguontt":
			    _data =  (data[44] != null) ? data[44] : "";
			    if(_data == null || _data == ""){
			   		break;
			    }			   
			    nguontt = nguontt || (_data == tmp_arr[3]);;
			    break;
		    default: 
		}
      }
    }
    res = tvv && nganhhoc &&  tthoso && ttdata &&  ptxt && namtx &&  
		    ttnhaphoc && doitac && langoi &&  ingnh && 
		    	inght && email &&  sms && tongdiem3mon && nguontt && ltdieuduong;
    return res;
}

function getResultTinh(data){
	res = false;

	_data =  (data[23] != null) ? data[23] : "";
	tinh_search = $('#sl_tinh').val();

	if(tinh_search.length <= 0){
		return true;
	}

	for (var i = 0; i < tinh_search.length; i++){
		res = res || _data.includes(tinh_search[i]);
	}
	return res;
}

function getResultDate(data){
	res = false;
	option_selected = $('#f_date').val();
	_current_date = new Date();
	_current_date_str = $.format.date(_current_date, "dd/MM/yyyy");
	_data = (data[2] != null) ? data[2] : "";
	if(_data == null && _data == "") return true;
	switch(option_selected){
		case "0":
		    var d = new Date();
		    y = d.getFullYear();
			return _data.includes(y);
			break;
		case "1":
	      	_str_date = $.format.date(_current_date, "dd/MM/yyyy");
	      	return _data == _str_date;
	    case "2":
	    	date  = new Date().setDate(_current_date.getDate()-1);
	      	_str_date = $.format.date(date, "dd/MM/yyyy");
	      	return _data == _str_date;
	    case "3":
	     	date  = new Date().setDate(_current_date.getDate()-7);
	      	_str_date = $.format.date(date, "dd/MM/yyyy");
	      	return compareStringDate(_data, _str_date) && compareStringDate(_current_date_str, _data);
	      	break;
	    case "4":
	     	date  = new Date().setDate(_current_date.getDate()-14);
	      	_str_date = $.format.date(date, "dd/MM/yyyy");
	      	return compareStringDate(_data, _str_date) && compareStringDate(_current_date_str, _data);
	      	break;
	    case "5":
	     	date  = new Date().setDate(_current_date.getDate()-30);
	      	_str_date = $.format.date(date, "dd/MM/yyyy");
	      	return compareStringDate(_data, _str_date) && compareStringDate(_current_date_str, _data);
	      	break;
	    case "6":
	     	Dates = new Date().getWeek();
	     	_str_date_1 = $.format.date(Dates[0], "dd/MM/yyyy");
	     	_str_date_2 = $.format.date(Dates[1], "dd/MM/yyyy");
	      	return compareStringDate(_data, _str_date_1) && compareStringDate(_str_date_2, _data);
	      	break;
	    case "7":
	    	date  = new Date().setDate(_current_date.getDate()-7);
	      	Dates = new Date(date).getWeek();     
	      	_Dates  = Dates[0].getWeek(); 	
	     	_str_date_1 = $.format.date(_Dates[0], "dd/MM/yyyy");
	     	_str_date_2 = $.format.date(_Dates[1], "dd/MM/yyyy");
	      	return compareStringDate(_data, _str_date_1) && compareStringDate(_str_date_2, _data);
	      	break;
	    case "8":
	    	month  = parseFloat(new Date().getMonth() + 1);
	      	data_month = parseFloat(_data.split('/')[1]);           
	      	return month == data_month;
	      	break;
	     case "9":
	    	month  = parseFloat(new Date().getMonth());
	      	data_month = parseFloat(_data.split('/')[1]);           
	      	return month == data_month;
	      	break;
	    case "10":
	    	_ngaybatdau = $('#f_ngaybatdau').val();
	    	_ngayketthuc = $('#f_ngayketthuc').val();
	    	if(_ngaybatdau != null && _ngaybatdau != ""){
	    		if(_ngayketthuc == null || _ngayketthuc == ""){
	    			return _data == _ngaybatdau;
	    		}else{
	    			return compareStringDate(_data, _ngaybatdau) && compareStringDate(_ngayketthuc, _data);	
	    		}
	    	}else{
	    		return true;
	    	}
	      	break;
	    default:
	    	return false;	      
	}
}

function compareStringDate(str1, str2){
	str_1 = str1.split("/");
	str_2 = str2.split("/");

	if(str_1.length == 3 && str_2.length == 3){
		if(parseFloat(str_1[2]) > parseFloat(str_2[2])) return true;
		else if(parseFloat(str_1[2]) == parseFloat(str_2[2]))
		{
			if(parseFloat(str_1[1]) > parseFloat(str_2[1])){
				return true;
			}else if(parseFloat(str_1[1]) == parseFloat(str_2[1])){
				if(parseFloat(str_1[0]) >= parseFloat(str_2[0]))return true;
				else return false;
			}else return false;

		}else return false;
	}else{
		return false;
	}
}

$.fn.dataTable.ext.search.push(
  function( settings, data, dataIndex ) {
  	//Input search
    var name_search = $('#f_name').val();
    var phone_search = $('#f_phone').val();
    var birthday_search = $('#f_birthday').val();
    var cmt_search = $('#f_cmt').val();
    var magnh_search = $('#f_magnh').val();
    var column_name =  (data[3] != null) ? data[3].toLowerCase() : "";
    var column_phone =  (data[6] != null) ? data[6] : "";
    var column_birthday =  (data[5] != null) ? data[5] : "";
    var column_cmt =  (data[6] != null) ? data[6] : "";
    var column_magnh =  (data[34] != null) ? data[34] : "";
    var column_ghichu =  (data[15] != null) ? data[15] : "";
    var column_nam =  (data[30] != null) ? data[30] : "";
    var query = true;
   	query = query && getResultTinh(data);
    // query = query && getResultBoloc(data);
   	query = query && getResultDate(data);

    if(name_search != ""){
      query = query && column_name.includes(name_search.toLowerCase());
    }
    if(phone_search != ""){
      query = query && column_phone.includes(phone_search);
    }
    if(birthday_search != ""){
      query = query && column_birthday.includes(birthday_search);
    }
    if(cmt_search != ""){
      query = query && column_cmt.includes(cmt_search);
    }
    if(magnh_search != ""){
    	query = query && (column_magnh.includes(magnh_search) || column_ghichu.includes(magnh_search));
    	if(!check_nam_boloc){
    		query = query && (column_nam == new Date().getFullYear().toString());	
    	}        
    }

    if(query){
    	data_send_email = (data[10] != null) ? data[10] : "";
    	if(data_send_email.includes("True")){
    		count_send_email = count_send_email + 1;	
    	}

    	data_ghichu = (data[15] != null) ? data[15] : "";
    	if(data_ghichu != ""){
    		count_ghichu = count_ghichu + 1;	
    	}

    	data_send_sms = (data[11] != null) ? data[11] : "";
    	if(data_send_sms != ""){
    		count_send_sms = count_send_sms + 1;	
    	}

    	data_send_giayht = (data[12] != null) ? data[12] : "";
    	if(data_send_giayht != ""){
    		count_send_giayht = count_send_giayht + 1;	
    	}

    	data_in_giaynh = (data[13] != null) ? data[13] : "";
    	if(data_in_giaynh != ""){
    		count_in_giaynh = count_in_giaynh + 1;	
    	}

    	data_ngaygoilai = (data[17] != null) ? data[17] : "";
    	if(data_ngaygoilai != ""){
    		count_ngaygoilai = count_ngaygoilai + 1;	
    	}

    	count_record = count_record + 1;
    }
    
    $('#td_ten').html(count_record);
    $('#td_send_email').html(count_send_email);
    $('#td_ghichu').html(count_ghichu);
    $('#td_send_sms').html(count_send_sms);
    $('#td_send_giayht').html(count_send_giayht);
    $('#td_in_giaynh').html(count_in_giaynh);
    $('#td_ngaygoilai').html(count_ngaygoilai);
	return query;
});


