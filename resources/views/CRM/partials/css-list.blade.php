<style>

	#cutum-frm{
	    padding-bottom: 0px;
	    margin-bottom: 10px;
	    background-color: #edf2f9;
	    display: none;
	    padding-top: 6px;
	    -webkit-box-shadow: 0 7px 14px 0 rgba(59, 65, 94, 0.1), 0 3px 6px 0 rgba(0, 0, 0, 0.07);
	    box-shadow: 0 7px 14px 0 rgba(59, 65, 94, 0.1), 0 3px 6px 0 rgba(0, 0, 0, 0.07);

	}
	#cutum-frm .form-filter{
		background: #fff;
        padding: 15px 0;
	}
	#cutum-frm .form-filter .form-group input{
        width: 100%;
	    border-radius: 5px;
	    box-shadow: none;
	    padding: 5px 10px;
	    border: 1px solid #cadbef;
	}
	#cutum-frm .form-filter .form-group input::placeholder{
		font-size: 13.33px;
		font-weight: 400;
		 color: #adadad !important;
	}
	#cutum-frm .form-filter .form-group label{
        font-size: 13.33px;

        font-weight: 600 !important;
        color: #344050;
	}
	#cutum-frm  .bt-submit{
		text-align: right;
	}
	.delete-controlog .modal-footer button[type="button"].closes,
	#cutum-frm  .bt-submit button{
		 font-size: 15px;
		  padding: 3px 13px;
		  border-radius: 5px;
		  color: #fff;


	}

	.md15 {
  		width: 15%;
	}

	.md10 {
  		width: 10%;
	}

	.md5 {
  		width: 5%;
	}



    .sxme{
    	margin-right: 10px;
    }
    .sxme:last-child{
    	margin-right: 0;
    }
	.dropdown-cutum-frm-hide{
		display: inline-block;
	}

	.dropdown-cutum-frm-hide .dropdown-menu{
		padding: 5px 2px;
	}
	.dropdown-cutum-frm-hide .dropdown-menu li{
	    padding: 2px 10px;
	    border-bottom: 1px solid #e6edf5;
	}

	.dropdown-cutum-frm-hide .dropdown-menu li:last-child{
		 border-bottom: none;
	}
	.dropdown-cutum-frm-hide .dropdown-menu li a{
        color: #344050;
        display: block;
	}
	.dropdown-cutum-frm-hide .dropdown-menu li a:hover{
		color: red;
		text-decoration: none;

	}

	.user-information .modal-content{
     	border: 2px solid #1a68d1;
     	border-radius: 0;
    }


    .user-information .modal-header{
        background-color: #1a68d1;
        border-bottom: 1px solid  #fff;
       border-radius: 0;
    }

    .user-information .modal-header h5,
    .user-information .modal-header .close{
      	color: #fff;
    }


    .content-information h3.name{
        font-size: 24px;
	    font-weight: 600;
	    color: #1a68d1;
	    padding-bottom: 5px;
	    border-bottom: 1px solid #cadbef;
    }

    .content-information .form-group .control-label{
    	width: 100%;
    	float:none;
    	color: #5e6e82;
    	font-size: 13.33px;
    }
    .content-information .form-group input{
	    width: 100%;
	    border: 1px solid #d8e2ef;
	    font-size: 1rem;
	    font-weight: 300;
	    color: #6c8bb5;
	    padding: 0.2rem .5rem;
	    border-radius: 0.25rem;
    }

    .delete-controlog .modal-content{
         border-radius: 5px;
    }

     .delete-controlog .modal-content .modal-body{
     	text-align: center;
     }
     .delete-controlog .modal-title{
 	    font-size: 24px;
	    font-weight: 600;
	    color: #1a68d1;

     }
     .delete-controlog .comment-d {
	    padding: 15px;
	    width: 80%;
	    margin: auto;
	    background-color: #4b98ff;
	     margin-top: 15px;
	    margin-bottom: 15px;
	    border: 1px solid #1967d1;
	    border-radius: 9px;
     }
     .delete-controlog .comment-d p{
     	margin-bottom: 0;
     	font-size: 14px;
     	color: #fff;
     }
     .delete-controlog .button-contenr .yes{
        background-color: #2c7be5;
	    border-color:  #2c7be5;
     }
     .delete-controlog .button-contenr .yes:hover{
        background-color: #1a68d1;
        border-color: #1862c6;
     }
     .delete-controlog .button-contenr .no{
        background-color: #f50000;
		border: 1px solid #f50000;
     }
     .delete-controlog .button-contenr .no:hover{
     	background-color: #dc0000;
		border-color: #dc0000;

     }
    .delete-controlog .form-group{
    	text-align: left;
    }
    .delete-controlog .form-group #email-example{
    	width: 100%;
    	border: 1px solid #d8e2ef;
    	font-size: 1rem;
    	font-weight: 300;
    	color: #6c8bb5;
    	padding: 0.2rem .5rem;
    	border-radius: 0.25rem;
    }
    .delete-controlog .form-group #email-example option{
    	font-weight: 300;
    }



    /*css ngày 09/12/2019*/
    .card-body .table thead th {
	    vertical-align: inherit;
	}
    .contenr-header .select-box{
       margin-bottom: 20px;
    }
    .contenr-header .agent-create-a a{
    	box-shadow:none;
    	text-align: left;
    	color: #2c7be5 !important;
    	outline: none;
    }
    .col-top .bottom-text .form-row{

        padding-top: 32px;
    }

    .col-top .bottom-text .form-row{
            justify-content: flex-end;
    }
    .contenr-header .bottom-text .form-row a{
		text-align: left;
	}
	.col-left input,
	.col-left select,
	.contenr-header .bottom-text .form-row a,
	.col-left label{
		font-size: 12px;
	}

	@media (max-width: 991px){
	    .table{
	        width:1600px;
	    }
	}

    @media (max-width: 1599px){

		.contenr-header .agent-create-a a {
		    font-size: 12px;
		    /*padding: 2px;*/
		}
	}

	@media (max-width: 1366px){


		.nth-ofe{
			position: relative;
		}
        .contenr-header .select-box {
		    margin-bottom: 10px;
		}
		.contenr-header .agent-create-a a {
		    font-size: 12px;
		    padding: 2px;
		}

	}
	@media (max-width: 1199px){
		.col-right,
		.col-left{
            -webkit-box-flex: 0;
		    -ms-flex: 0 0 100%;
		    flex: 0 0 100%;
		    max-width: 100%;
		}
		.col-bottom .bottom-text .form-row,
		.col-top .bottom-text .form-row{
			padding: 10px 0 5px;
		}
		.agent-create-a{
			padding-top: 5px;
		}
	}
	@media (max-width: 767px){
		.col-fillter,
		.col-send-email,
		.col-new{
            margin-bottom: 14px;
		}
		.col-person-in-charge{
			-webkit-box-flex: 0;
		    -ms-flex: 0 0 100%;
		    flex: 0 0 100%;
		    max-width: 100%;
		}
	}
	@media (max-width: 574px){


		.contenr-header .bottom-text .form-row{
			    width: auto;
		}
	}
	@media (min-width: 1200px){
				.nth-ofe:nth-of-type(3){
		    left: 66.66667%;
		}
		.nth-ofe:nth-of-type(4) {
		    left: -33.33333%;
		}
	}
    @media (min-width: 1367px){



	}
</style>
