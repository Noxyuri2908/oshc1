<?php

Route::get('crm/login', [\App\Http\Controllers\Auth\CrmLoginController::class,'showLoginForm'])->name('crm.login.get');
Route::post('crm/login', [\App\Http\Controllers\Auth\CrmLoginController::class,'login'])->name('crm.login.post');
Route::get('crm/test', [\App\Http\Controllers\Auth\CrmLoginController::class,'test'])->name('crm.test');

Route::middleware(['auth:admin'])->prefix('crm')->group(function () {
    Route::get('logout', [\App\Http\Controllers\Auth\CrmLoginController::class,'logout'])->name('crm.logout');
    Route::get('/', 'Admin\CrmController@dashboard')->name('crm.dashboard');
    Route::get('/dashboard', 'Admin\CrmController@dashboard')->name('crm.dashboard');
    Route::group(['prefix' => 'agent', 'as' => 'agent.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\AgentController::class, 'index'])->name('index');
        Route::get('/exportExcel', [\App\Http\Controllers\Admin\AgentController::class, 'exportExcel'])->name('exportExcel');
        Route::post('/importAgentCode', [\App\Http\Controllers\Admin\AgentController::class, 'importAgentCode'])->name('importAgentCode');
        //Route::post('/UpdateAgent', [\App\Http\Controllers\Admin\AgentController::class, 'UpdateAgent'])->name('UpdateAgent');
        Route::post('/importTypeOfAgent', [\App\Http\Controllers\Admin\AgentController::class, 'importTypeOfAgent'])->name('importTypeOfAgent');
        Route::get('/getData', [\App\Http\Controllers\Admin\AgentController::class, 'getData'])->name('getData');
        Route::get('/showData/{id}', [\App\Http\Controllers\Admin\AgentController::class, 'showData'])->name('showData');
        Route::post('/sendEmailAgent', [\App\Http\Controllers\Admin\AgentController::class, 'sendEmailAgent'])->name('sendEmailAgent');
        Route::post('/multiDelete', [\App\Http\Controllers\Admin\AgentController::class, 'multiDelete'])->name('multiDelete');
        Route::post('/updatePersonInCharge', [\App\Http\Controllers\Admin\AgentController::class, 'updatePersonInCharge'])->name('updatePersonInCharge');
        Route::post('/importExcel', [\App\Http\Controllers\Admin\AgentController::class, 'importExcel'])->name('importExcel');
        Route::get('/create', [\App\Http\Controllers\Admin\AgentController::class, 'create'])->name('create');
        Route::post('store', [\App\Http\Controllers\Admin\AgentController::class, 'store'])->name('store');
        Route::get('/show/{id}', [\App\Http\Controllers\Admin\AgentController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\AgentController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Admin\AgentController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\AgentController::class, 'destroy'])->name('destroy');
        Route::get('/getAgentSelect',[\App\Http\Controllers\Admin\AgentController::class,'getAgentSelect'])->name('getAgentSelect');
        Route::get('/getAgentById',[\App\Http\Controllers\Admin\AgentController::class,'getAgentById'])->name('getAgentById');

        Route::get('/getDataContactList/{id}', [\App\Http\Controllers\Admin\AgentController::class, 'getDataContactList'])->name('getDataContactList');
        Route::get('/editContactAgent/{id}', [\App\Http\Controllers\Admin\AgentController::class, 'editContactAgent'])->name('editContactAgent');
        Route::post('/storeContactAgent/{id}', [\App\Http\Controllers\Admin\AgentController::class, 'storeContactAgent'])->name('storeContactAgent');
        Route::post('/updateContactAgent/{id}', [\App\Http\Controllers\Admin\AgentController::class, 'updateContactAgent'])->name('updateContactAgent');
        Route::post('/destroyContactAgent/{id}', [\App\Http\Controllers\Admin\AgentController::class, 'destroyContactAgent'])->name('destroyContactAgent');

        Route::get('/getModalFormContact/', [\App\Http\Controllers\Admin\AgentController::class, 'getModalFormContact'])->name('getModalFormContact');

        Route::get('/getContactAgent/{id}',[\App\Http\Controllers\Admin\AgentController::class,'getContactAgent'])->name('getContactAgent');
        Route::get('/getAgentFilterAndAgentDefault',[\App\Http\Controllers\Admin\AgentController::class,'getAgentFilterAndAgentDefault'])->name('getAgentFilterAndAgentDefault');

        Route::group(['prefix'=>'contact','as'=>'contact.'],function (){
            Route::get('/',[\App\Http\Controllers\Admin\AgentContactController::class,'index'])->name('index');
            Route::get('/getData', [\App\Http\Controllers\Admin\AgentContactController::class,'getData'])->name('getData');
            Route::get('/create', [\App\Http\Controllers\Admin\AgentContactController::class,'create'])->name('create');
            Route::post('/store', [\App\Http\Controllers\Admin\AgentContactController::class,'store'])->name('store');
            Route::get('/edit/{id}', [\App\Http\Controllers\Admin\AgentContactController::class,'edit'])->name('edit');
            Route::post('/update/{id}', [\App\Http\Controllers\Admin\AgentContactController::class,'update'])->name('update');
            Route::post('/delete/{id}', [\App\Http\Controllers\Admin\AgentContactController::class,'destroy'])->name('delete');
            Route::post('/importExcel', [\App\Http\Controllers\Admin\AgentContactController::class,'importExcel'])->name('importExcel');
            Route::get('/exportExcel', [\App\Http\Controllers\Admin\AgentContactController::class,'exportExcel'])->name('exportExcel');
        });
    });

//    Route::get('/agent', 'Admin\CrmController@agent')->name('crm.agent');
    Route::get('/receipt', 'Admin\CrmController@receipt')->name('crm.receipt');
    Route::get('/setAgentDefault', 'Admin\CrmController@setAgentDefault')->name('crm.setAgentDefault');
    Route::post('/task/post', 'Admin\ProcessController@storeTask')->name('task.post');
    Route::get('/ajax/eidtTask', 'Admin\ProcessController@editTask')->name('task.edit');
    Route::get('/potential', 'Admin\CrmController@potential')->name('crm.potential');
    Route::post('/agent/search', 'Admin\CrmController@search')->name('crm.agent.search');
    Route::post('/agent/delete', 'Admin\CrmController@delete')->name('crm.agent.delete');
//    Route::get('/edit/agent/{id}', 'Admin\CrmController@editAgent')->name('crm.agent.edit');
    Route::post('/attach/agent', 'Admin\CrmController@attachAgent')->name('crm.agent.attach');
    Route::post('/support/agent', 'Admin\CrmController@supportAgent')->name('crm.agent.support');
//    Route::post('/edit/agent/{id}', 'Admin\CrmController@updateAgent')->name('crm.agent.update');

//    Route::get('/new/agent', 'Admin\CrmController@createAgent')->name('crm.agent.create');
//    Route::post('/new/agent', 'Admin\CrmController@storeAgent')->name('crm.agent.store');
    Route::post('/new/account', 'Admin\CrmController@postAccount')->name('crm.account.store');
    Route::get('/', 'Admin\CrmController@dashboard')->name('crm.home');
    Route::get('/ajax/getAgentInfo', [\App\Http\Controllers\Admin\CrmController::class,'getAgentInfo'])->name('crm.ajax.getAgentInfo');
    Route::get('/ajax/getCommInfo', [\App\Http\Controllers\Admin\CrmController::class,'getAgentComm'])->name('crm.ajax.getCommInfo');
    Route::get('/ajax/getSupport', 'Admin\CrmController@getSupport')->name('crm.ajax.getSupport');
    Route::get('/ajax/getContactInfo', 'Admin\CrmController@getContactInfo')->name('crm.ajax.getContactInfo');
    Route::get('/ajax/fillterAgent', 'Admin\SearchController@fillterAgent')->name('crm.ajax.fillterAgent');
    Route::get('/ajax/statusAgent', 'Admin\SearchController@statusAgent')->name('crm.ajax.statusAgent');
    Route::get('/ajax/searchAgent', 'Admin\SearchController@searchAgent')->name('crm.ajax.searchAgent');

    Route::get('/ajax/createContact', [\App\Http\Controllers\Admin\CrmController::class, 'createContact'])->name('crm.createContact');
    Route::get('/ajax/storeContact', [\App\Http\Controllers\Admin\CrmController::class, 'storeContact'])->name('crm.storeContact');
    Route::get('/ajax/delContact', 'Admin\CrmController@delContact')->name('crm.delContact');
    Route::get('/ajax/editContact', 'Admin\CrmController@editContact')->name('crm.editContact');
    Route::get('/ajax/updateContact', 'Admin\CrmController@updateContact')->name('crm.updateContact');

    Route::get('/services', 'Admin\DichvuController@index')->name('dichvu.index');
    Route::post('/services/delete', 'Admin\DichvuController@delete')->name('dichvu.delete');
    Route::post('/services/store', 'Admin\DichvuController@store')->name('dichvu.store');
    Route::post('/services/update/{id}', 'Admin\DichvuController@update')->name('dichvu.update');
    Route::get('/ajax/editService', 'Admin\DichvuController@editService')->name('crm.editService');
    Route::post('/delete/service', 'Admin\DichvuController@deleteService')->name('crm.service.delete');

    Route::group(['prefix' => 'commissions', 'as' => 'com.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\CommissionController::class, 'index'])->name('index');
        Route::get('/getData',[\App\Http\Controllers\Admin\CommissionController::class,'getData'])->name('getData');
        Route::get('/create',[\App\Http\Controllers\Admin\CommissionController::class,'create'])->name('create');
        Route::get('/edit/{id}',[\App\Http\Controllers\Admin\CommissionController::class,'edit'])->name('edit');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\CommissionController::class, 'delete'])->name('delete');
        Route::post('/store', [\App\Http\Controllers\Admin\CommissionController::class, 'store'])->name('store');
        Route::post('/update/{id}', [\App\Http\Controllers\Admin\CommissionController::class, 'update'])->name('update');
        Route::post('/all/update', [\App\Http\Controllers\Admin\CommissionController::class, 'updateAll'])->name('updateAll');
        Route::post('/importExcel', [\App\Http\Controllers\Admin\CommissionController::class, 'importExcel'])->name('importExcel');
        Route::get('/getProvider', [\App\Http\Controllers\Admin\CommissionController::class,'getProvider'])->name('getProvider');
        Route::post('/destroy/{id}', [\App\Http\Controllers\Admin\CommissionController::class, 'destroy'])->name('destroy');
    });



    Route::get('/ajax/editCom', 'Admin\CommissionController@editCom')->name('crm.editCom');
    Route::post('/delete/deleteComm', 'Admin\CommissionController@deleteComm')->name('crm.editComm.delete');
    Route::get('/ajax/getCom', 'Admin\CommissionController@getCom')->name('crm.getCom');
    Route::get('/ajax/editComAgent', 'Admin\CommissionController@editComAgent')->name('ajax.editComAgent');
    Route::post('/ajax/ajaxUpdateCommAgent', 'Admin\CommissionController@ajaxUpdateCommAgent')->name('ajax.ajaxUpdateCommAgent');
    Route::post('/ajax/ajaxDeleteCommAgent', 'Admin\CommissionController@ajaxDeleteCommAgent')->name('ajax.ajaxDeleteCommAgent');

    //APLLY
    Route::get('/applies', 'Admin\CrmController@applies')->name('crm.apply');
    Route::post('/apply/search', 'Admin\CrmController@searchApply')->name('crm.apply.search');
    Route::post('/invoice/add', 'Admin\CrmController@storeApply')->name('crm.apply.store');
    Route::get('/ajax/getServiceInfo', 'Admin\CrmController@getServiceInfo')->name('crm.getServiceInfo');
    Route::get('/ajax/getApplyInfo', 'Admin\CrmController@getApplyInfo')->name('crm.getApplyInfo');
    Route::post('/apply/delete', 'Admin\CrmController@deleteApply')->name('crm.apply.delete');
    Route::get('/ajax/getCustomInfo', 'Admin\CrmController@getCustomInfo')->name('crm.getCustomInfo');
    Route::get('/ajax/getCreateInvoice', 'Admin\CrmController@getCreateInvoice')->name('crm.getCreateInvoice');
    Route::get('/ajax/changeStatus', 'Admin\ProcessController@changeStatus')->name('crm.changeStatus');

    Route::resource('promotion', 'Admin\PromotionController');
    Route::get('/ajax/editPromotion', 'Admin\PromotionController@editPromotion')->name('crm.editPromotion');
    Route::post('/delete/promotion', 'Admin\PromotionController@deletePromotion')->name('crm.promotion.delete');
    Route::get('/export/Promotion', 'Admin\PromotionController@exportPromotion')->name('export.Promotion');
    Route::post('/import/Promotion', 'Admin\PromotionController@importPromotion')->name('import.Promotion');

    Route::resource('provider-com', 'Admin\ProviderComController');
    //Route::get('provider-com',function (){
    //    return ;
    //})->name('provider-com.index');
    Route::get('/ajax/editProviderCom', 'Admin\ProviderComController@editCom')->name('crm.editProviderCom');
    Route::post('/delete/provider-com', 'Admin\ProviderComController@deleteCom')->name('crm.provider-com.delete');

    Route::resource('exchange-rate', 'Admin\ExchangeRateController');
    Route::get('/ajax/createExchange', [\App\Http\Controllers\Admin\ExchangeRateController::class,'createExchange'])->name('crm.createExchange');
    Route::get('/ajax/editEchange', 'Admin\ExchangeRateController@editEchange')->name('crm.editEchange');
    Route::post('/delete/exchange', 'Admin\ExchangeRateController@deleteExchange')->name('crm.exchange-rate.delete');
    Route::get('/ajax/searchExchange', 'Admin\ExchangeRateController@searchExchange')->name('crm.searchExchange');
    Route::get('/export/Exchange', 'Admin\ExchangeRateController@exportData')->name('export.Exchange');

    Route::resource('school', 'Admin\SchoolController');
    Route::get('/ajax/editSchool', 'Admin\SchoolController@editSchool')->name('crm.editSchool');
    Route::post('/delete/school', 'Admin\SchoolController@deleteSchool')->name('crm.school.delete');
    Route::get('/ajax/searchSchool', 'Admin\SchoolController@searchSchool')->name('crm.searchSchool');
    Route::get('/export/School', 'Admin\SchoolController@exportSchool')->name('export.School');
    Route::post('/import/School', 'Admin\SchoolController@importSchool')->name('import.School');

    Route::resource('bank', 'Admin\BankController');
    Route::get('/ajax/editBank', 'Admin\BankController@editBank')->name('crm.editBank');
    Route::post('/delete/bank', 'Admin\BankController@deleteBank')->name('crm.bank.delete');

    Route::resource('campain', 'Admin\CampainController');
    Route::get('/ajax/editCampain', 'Admin\CampainController@editCampain')->name('crm.editCampain');
    Route::post('/delete/campain', 'Admin\CampainController@deleteCampain')->name('crm.campain.delete');

    Route::get('/process/agent/{id}', [\App\Http\Controllers\Admin\ProcessController::class,'index'])->name('agent.process');
    Route::post('/process/agent/{id}', [\App\Http\Controllers\Admin\ProcessController::class,'store'])->name('agent.process.store');
    Route::post('/follow-up/agent/{id}/store', [\App\Http\Controllers\Admin\ProcessController::class,'storeFollow'])->name('agent.process.follow.store');
    Route::post('/follow-up/agent/{agent_id}/edit/{follow_id}', [\App\Http\Controllers\Admin\ProcessController::class,'updateFollow'])->name('agent.process.follow.update');
    Route::get('/ajax/addNewFollow',[\App\Http\Controllers\Admin\ProcessController::class,'addNewFollow'])->name('crm.addNewFollow');
    Route::get('/ajax/editFollow', [\App\Http\Controllers\Admin\ProcessController::class,'editFollow'])->name('crm.editFollow');
    Route::post('/follow-up/agent/{agent_id}/update/{follow_id}', [\App\Http\Controllers\Admin\ProcessController::class,'updateFollow'])->name('agent.process.follow-up.update');
    Route::post('/follow-up/agent/{agent_id}/delete/{follow_id}', [\App\Http\Controllers\Admin\ProcessController::class,'destroyFollow'])->name('agent.process.follow-up.delete');

    Route::post('/ajax/getFollowAgent', 'Admin\ProcessController@getFollowAgent')->name('crm.ajax.getFollowAgent');
    Route::get('/follow-up/export-to-excel', 'Admin\TaskController@exportToExcelFollowUp')->name('crm.follow-up.export-to-excel');
    Route::get('/follow-up/export-to-pdf', 'Admin\TaskController@exportToPdfFollowUp')->name('crm.follow-up.export-to-pdf');

    //market-feedback
    Route::post('/ajax/getMarketFeedback', [\App\Http\Controllers\Admin\ProcessController::class,'getMarketFeedback'])->name('crm.ajax.getMarketFeedback');
    Route::get('/ajax/addNewMarketFeedback', [\App\Http\Controllers\Admin\ProcessController::class,'addNewMarketFeedback'])->name('crm.ajax.addNewMarketFeedback');
    Route::post('/market-feedback/agent/{id}/store', [\App\Http\Controllers\Admin\ProcessController::class,'storeMarketFeedback'])->name('agent.process.market.feedback.store');
    Route::get('/ajax/editMarketFeedback', 'Admin\ProcessController@editMarketFeedback')->name('crm.ajax.editMarketFeedback');
    Route::post('/market-feedback/agent/{agent_id}/update/{market_feedback_id}', 'Admin\ProcessController@updateMarketFeedback')->name('agent.process.market.feedback.update');
    Route::post('/market-feedback/agent/{agent_id}/delete/{market_feedback_id}', 'Admin\ProcessController@destroyMarketFeedback')->name('agent.process.market.feedback.delete');

    //end market-feedback

    //competition-feedback
    Route::post('/ajax/getCompetitionFeedback', [\App\Http\Controllers\Admin\ProcessController::class,'getCompetitionFeedback'])->name('crm.ajax.getCompetitionFeedback');
    Route::get('/ajax/addNewCompetitionFeedback', [\App\Http\Controllers\Admin\ProcessController::class,'addNewCompetitionFeedback'])->name('crm.ajax.addNewCompetitionFeedback');
    Route::post('/competition-feedback/agent/{id}/store', 'Admin\ProcessController@storeCompetitionFeedback')->name('agent.process.competition.feedback.store');
    Route::get('/ajax/editCompetitionFeedback', 'Admin\ProcessController@editCompetitionFeedback')->name('crm.ajax.editCompetitionFeedback');
    Route::post('/competition-feedback/agent/{agent_id}/update/{competition_feedback_id}', 'Admin\ProcessController@updateCompetitionFeedback')->name('agent.process.competition.feedback.update');
    Route::post('/competition-feedback/agent/{agent_id}/delete/{competition_feedback_id}', 'Admin\ProcessController@destroyCompetitionFeedback')->name('agent.process.competition.feedback.delete');

    //end competition-feedback

    //marketing-support
    Route::post('/ajax/getMarketingSupport', 'Admin\ProcessController@getMarketingSupport')->name('crm.ajax.getMarketingSupport');
    Route::get('/ajax/addNewMarketingSupport', 'Admin\ProcessController@addNewMarketingSupport')->name('crm.ajax.addNewMarketingSupport');
    Route::post('/marketing-support/agent/{id}/store', 'Admin\ProcessController@storeMarketingSupport')->name('agent.process.marketing.support.store');
    Route::get('/ajax/editMarketingSupport', 'Admin\ProcessController@editMarketingSupport')->name('crm.ajax.editMarketingSupport');
    Route::post('/marketing-support/agent/{agent_id}/update/{marketing_support_id}', 'Admin\ProcessController@updateMarketingSupport')->name('agent.process.marketing.support.update');
    Route::post('/marketing-support/agent/{agent_id}/delete/{marketing_support_id}', 'Admin\ProcessController@destroyMarketingSupport')->name('agent.process.marketing.support.delete');

    //end marketing-support

    //proposal
    Route::post('/ajax/getProposal',[\App\Http\Controllers\Admin\ProcessController::class,'getProposal'])->name('crm.ajax.getProposal');
    Route::get('/ajax/addNewProposal', [\App\Http\Controllers\Admin\ProcessController::class,'addNewProposal'])->name('crm.ajax.addNewProposal');
    Route::post('/proposal/agent/{id}/store', [\App\Http\Controllers\Admin\ProcessController::class,'storeProposal'])->name('agent.process.proposal.store');
    Route::get('/ajax/editProposal', [\App\Http\Controllers\Admin\ProcessController::class,'editProposal'])->name('crm.ajax.editProposal');
    Route::post('/proposal/agent/{agent_id}/update/{marketing_support_id}',[\App\Http\Controllers\Admin\ProcessController::class,'updateProposal'])->name('agent.process.proposal.update');
    Route::post('/proposal/agent/{agent_id}/delete/{marketing_support_id}', [\App\Http\Controllers\Admin\ProcessController::class,'destroyProposal'])->name('agent.process.proposal.delete');

    //end proposal
    Route::get('/ajax/addNewTask', 'Admin\ProcessController@addNewTask')->name('crm.addNewTask');
    Route::get('/ajax/editTask', 'Admin\ProcessController@editTask')->name('crm.editTask');


    Route::resource('customer', Admin\CustomerController::class);
    Route::get('ajax/customer/getData/{tab}', [\App\Http\Controllers\Admin\CustomerController::class,'getData'])->name('ajax.customer.getData');
    Route::get('ajax/customer/showData/{tab}/{id}', [\App\Http\Controllers\Admin\CustomerController::class,'showData'])->name('ajax.customer.showData');
    Route::get('ajax/customer/getProvider',[\App\Http\Controllers\Admin\CustomerController::class,'getProvider'])->name('ajax.customer.getProvider');
    Route::get('ajax/customer/getPrice',[\App\Http\Controllers\Admin\CustomerController::class,'getPrice'])->name('ajax.customer.getPrice');
    Route::get('ajax/customer/getStatusFilterCustomer/{tab}',[\App\Http\Controllers\Admin\CustomerController::class,'getStatusFilterCustomer'])->name('ajax.customer.getStatusFilterCustomer');

    Route::resource('flywire', 'Admin\FlywireController');
    Route::get('ajax/flywire/getData',[\App\Http\Controllers\Admin\FlywireController::class,'getData'] )->name('ajax.flywire.getData');
    Route::get('ajax/flywire/showData/{id}', 'Admin\FlywireController@showData')->name('ajax.flywire.showData');
    Route::get('/ajax/flywire/showDocsAndRemindForm', [\App\Http\Controllers\Admin\FlywireController::class,'showDocsAndRemindForm'])->name('ajax.flywire.showDocsAndRemindForm');
    Route::get('ajax/flywire/getTotalData', [\App\Http\Controllers\Admin\FlywireController::class,'getTotalData'])->name('ajax.flywire.getTotalData');
    Route::post('ajax/flywire/storeFlywireByPaymentId', [\App\Http\Controllers\Admin\FlywireController::class,'storeFlywireByPaymentId'])->name('ajax.flywire.storeFlywireByPaymentId');
    Route::post('/importflywire', [\App\Http\Controllers\Admin\FlywireController::class, 'importFlywirebyPaymentId'])->name('flywire.importFlywirebyPaymentId');
    Route::get('/exportFlywire', [\App\Http\Controllers\Admin\FlywireController::class, 'exportFlywire'])->name('flywire.exportFlywire');


    Route::get('flywires/process', [\App\Http\Controllers\Admin\FlywireController::class,'process'])->name('flywire.process');
    Route::post('flywires/process/com_and_profit', [\App\Http\Controllers\Admin\FlywireController::class,'processComAndProfit'])->name('flywires.process.com_and_profit');
    Route::post('flywires/process/get_exchange_rate_date', 'Admin\FlywireController@getExchangeProvider')->name('flywires.process.get_exchange_rate_date');
    Route::post('customer/multi_delete', 'Admin\CustomerController@multiDeleteData')->name('customer.multi_delete');
    Route::post('customer/update/post', 'Admin\CustomerController@updateCustomer')->name('customer.update.post');
    Route::get('/applies/{tab}', 'Admin\CustomerController@getCommAplly')->name('customer.getCommAplly');

    Route::post('/export/invoice', [\App\Http\Controllers\Admin\CustomerController::class,'exportIflywirenvoice'])->name('invoice.export');
    Route::post('/export/Exportinvoice', [\App\Http\Controllers\Admin\CustomerController::class,'exportInvoiceWithBalde'])->name('invoice.export.with.blade');
    Route::get('/view/invoice', [\App\Http\Controllers\Admin\CustomerController::class,'viewInvoice'])->name('invoice.view');
    Route::get('/ajax/formPartner', 'Admin\CustomerController@formPartner')->name('customer.formPartner');
    Route::get('/ajax/formChild', 'Admin\CustomerController@formChild')->name('customer.formChild');
    Route::get('/ajax/getRef', 'Admin\CustomerController@getRef')->name('customer.getRef');
    Route::get('/ajax/getSu', 'Admin\CustomerController@getSu')->name('customer.getSu');
    Route::get('/ajax/getComm', [\App\Http\Controllers\Admin\CustomerController::class,'getComm'])->name('customer.getComm');
    Route::get('/ajax/getCus', 'Admin\CustomerController@getCus')->name('customer.getCus');
    Route::get('/ajax/getInvoice', 'Admin\CustomerController@getInvoice')->name('customer.getInvoice');
    Route::get('/ajax/customer/getBankFeeByPaymentMethod',[\App\Http\Controllers\Admin\CustomerController::class,'getBankFeeByPaymentMethod'])->name('ajax.customer.getBankFeeByPaymentMethod');
    Route::get('/ajax/searchInvoice', 'Admin\CustomerController@searchInvoice')->name('customer.searchInvoice');
    Route::get('/ajax/statusInvoice', 'Admin\CustomerController@statusAgent')->name('crm.statusInvoice');
    Route::get('/ajax/fillterInvoice', 'Admin\CustomerController@fillterInvoice')->name('crm.fillterInvoice');
    Route::get('/customer/process/{id}/{tab}', [\App\Http\Controllers\Admin\CustomerProcessController::class,'index'])->name('customer.process.index');
    Route::get('/ajax/getComByIssueDate',[\App\Http\Controllers\Admin\CustomerProcessController::class,'getComByIssueDate'])->name('ajax.getComByIssueDate');
    Route::get('/ajax/changeInvoiceStatus', 'Admin\CustomerProcessController@changeInvoiceStatus')->name('crm.changeInvoiceStatus');
    Route::get('/ajax/getBtnReceipt', 'Admin\CustomerProcessController@getBtnReceipt')->name('crm.getBtnReceipt');
    Route::get('/ajax/saveReceipt', [\App\Http\Controllers\Admin\PhieuthuController::class,'store'])->name('ajax.saveReceipt');
    Route::get('/ajax/editReceipt', 'Admin\PhieuthuController@edit')->name('ajax.editReceipt');
    Route::get('/ajax/delReceipt', 'Admin\PhieuthuController@destroy')->name('phieuthu.del');
    Route::get('/ajax/getReceipt', [\App\Http\Controllers\Admin\CustomerProcessController::class,'getReceipt'])->name('ajax.getReceipt');
    Route::get('/ajax/createReceipt', [\App\Http\Controllers\Admin\CustomerProcessController::class,'createReceipt'])->name('ajax.createReceipt');
    Route::get('/ajax/showReceipt', [\App\Http\Controllers\Admin\CustomerProcessController::class,'showReceipt'])->name('ajax.showReceipt');
    Route::get('/ajax/deleteReceipt', [\App\Http\Controllers\Admin\CustomerProcessController::class,'deleteReceipt'])->name('ajax.deleteReceipt');
    Route::get('/ajax/showDocs', [\App\Http\Controllers\Admin\CustomerProcessController::class,'showDocs'])->name('ajax.showDocs');
    Route::get('/ajax/getExchangeRateByDate', 'Admin\CustomerProcessController@getExchangeRateByDate')->name('ajax.getExchangeRateByDate');
    Route::post('/ajax/sendEmailInvoice', 'Admin\CustomerController@sendEmailInvoice')->name('customer.sendEmailInvoice');

    Route::get('/ajax/showDocsAndRemindForm', [\App\Http\Controllers\Admin\CustomerProcessController::class,'showDocsAndRemindForm'])->name('ajax.showDocsAndRemindForm');
    Route::post('/ajax/storeRemind/{id}', 'Admin\CustomerProcessController@storeRemind')->name('ajax.storeRemind');


    Route::get('/ajax/getBtnHH', 'Admin\CustomerProcessController@getBtnHH')->name('crm.getBtnHH');
    Route::post('/ajax/saveHH', [\App\Http\Controllers\Admin\HoahongController::class,'store'])->name('ajax.saveHH');
    Route::get('/ajax/editHH', 'Admin\HoahongController@edit')->name('ajax.editHH');
    Route::post('/ajax/getDateOfPayment', 'Admin\HoahongController@getDateOfPayment')->name('ajax.getDateOfPayment');
    Route::post('/hoahong/delete/{id}', [\App\Http\Controllers\Admin\HoahongController::class,'destroy'])->name('crm.hoahong.delete');
    Route::post('/hoahong/multiDelete', 'Admin\HoahongController@multiDelete')->name('crm.hoahong.multi_delete');

    Route::get('/ajax/getBtnProfit', 'Admin\CustomerProcessController@getBtnProfit')->name('crm.getBtnProfit');
    Route::get('/ajax/saveProfit',[\App\Http\Controllers\Admin\ProfitController::class,'store'])->name('ajax.saveProfit');
    Route::get('/ajax/editProfit', 'Admin\ProfitController@edit')->name('ajax.editProfit');
    Route::post('/ajax/deleteProfit/{id}', [\App\Http\Controllers\Admin\ProfitController::class,'destroy'])->name('crm.ajax.deleteProfit');
    Route::post('/ajax/multiDeleteProfit', 'Admin\ProfitController@multiDelete')->name('crm.ajax.multiDeleteProfit');
    Route::post('/ajax/updateAllDateProfit', 'Admin\ProfitController@updateAllDateProfit')->name('crm.ajax.updateAllDateProfit');

    Route::get('/ajax/getBtnRefund', 'Admin\CustomerProcessController@getBtnRefund')->name('crm.getBtnRefund');
    Route::get('/ajax/saveRefund', [\App\Http\Controllers\Admin\RefundController::class,'store'])->name('ajax.saveRefund');
    Route::post('/ajax/deleteRefund/{id}', 'Admin\RefundController@destroy')->name('crm.ajax.deleteRefund');
    Route::post('/ajax/multiDeleteRefund', 'Admin\RefundController@multiDelete')->name('crm.ajax.multiDeleteRefund');

    Route::get('/ajax/getCurrency', 'Admin\CustomerController@getCurrency')->name('ajax.getCurrency');

    Route::get('/ajax/getFormCreateTailieu', [\App\Http\Controllers\Admin\TailieuController::class,'create'])->name('ajax.getFormCreateTailieu');
    Route::get('/ajax/getFormEditTailieu', [\App\Http\Controllers\Admin\TailieuController::class,'edit'])->name('ajax.getFormEditTailieu');
    Route::post('/tailieu/store', [\App\Http\Controllers\Admin\TailieuController::class,'store'])->name('apply.tailieu.store');
    Route::post('/tailieu/update/{id}',  [\App\Http\Controllers\Admin\TailieuController::class,'update'])->name('apply.tailieu.update');
    Route::post('/tailieu/destroy',  [\App\Http\Controllers\Admin\TailieuController::class,'destroy'])->name('apply.tailieu.destroy');

    Route::get('report_monthly', [\App\Http\Controllers\Admin\ReportCrmController::class,'reportMonthly'])->name('reportMonthly');
    Route::get('report_quarterly', 'Admin\ReportCrmController@reportQuarterly')->name('reportQuarterly');
    Route::get('report_flywire', 'Admin\ReportCrmController@reportFlywire')->name('reportFlywire');
    Route::get('export_flywire', 'Admin\ReportCrmController@exportFlywire')->name('exportFlywire');

    Route::get('report/exportExcel', 'Admin\ReportCrmController@exportExcel')->name('report.exportExcel');
    Route::get('report/exportPdf', 'Admin\ReportCrmController@exportPdf')->name('report.exportPdf');

    Route::get('/login/google', [\App\Http\Controllers\Admin\GoogleLoginController::class,'redirectToGoogleAuth'])->name('login.google');
    Route::get('/login/google/callback', [\App\Http\Controllers\Admin\GoogleLoginController::class,'loginGoogleCallback'])->name('login.google.callback');
    Route::post('/logout/google', [\App\Http\Controllers\Admin\GoogleLoginController::class,'logoutGoogle'])->name('logout.google');
    Route::group(['prefix' => 'event', 'as' => 'event.'], function () {
        Route::get('/index', [\App\Http\Controllers\Admin\CalendarController::class,'indexEvent'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\CalendarController::class,'createEvent'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\CalendarController::class,'storeEvent'])->name('store');
        Route::post('/show', [\App\Http\Controllers\Admin\CalendarController::class,'showEvent'])->name('show');
        Route::get('/edit',[\App\Http\Controllers\Admin\CalendarController::class,'editEvent'])->name('edit');
        Route::post('/update', [\App\Http\Controllers\Admin\CalendarController::class,'updateEvent'])->name('update');
        Route::post('/delete', [\App\Http\Controllers\Admin\CalendarController::class,'deleteEvent'])->name('delete');
        Route::get('/show-data', [\App\Http\Controllers\Admin\CalendarController::class,'showData'])->name('showData');
    });


    //all user admin
    Route::resource('staff', 'Admin\AdminController');
    //end user admin
    Route::resource('roles', 'Admin\RoleController');
    Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
        Route::get('/getUserRole/{id}', [\App\Http\Controllers\Admin\RoleController::class,'getUserRole'])->name('getUserRole');
    });
    Route::group(['prefix' => 'permissions', 'as' => 'permissions.'], function () {
        Route::get('/{id}', 'Admin\PermissionController@index')->name('index');
        Route::put('/update/{id}', [\App\Http\Controllers\Admin\PermissionController::class,'update'])->name('update');
    });

    Route::group(['prefix' => 'tasks', 'as' => 'tasks.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\TaskController::class,'index'])->name('index');

        Route::group(['prefix' => 'sale', 'as' => 'sale.'], function () {
            Route::get('/', [\App\Http\Controllers\Admin\TaskController::class,'sale'])->name('index');
            Route::group(['prefix' => 'report', 'as' => 'report.'], function () {
                Route::get('/', [\App\Http\Controllers\Admin\TaskController::class,'saleReportIndex'])->name('index');
            });
        });

        Route::group(['prefix' => 'media', 'as' => 'media.'], function () {
            Route::get('/', [\App\Http\Controllers\Admin\TaskController::class,'media'])->name('index');
            Route::get('/getMediaPost/post/{type_media_post}', [\App\Http\Controllers\Admin\TaskController::class,'getMediaPost'])->name('getMediaPost.post');
            Route::get('/createMediaPost/post/{type_media_post}', [\App\Http\Controllers\Admin\TaskController::class,'createMediaPost'])->name('createMediaPost.post');
            Route::post('/storeMediaPost/post/{type_media_post}', [\App\Http\Controllers\Admin\TaskController::class,'storeMediaPost'])->name('storeMediaPost.post');
            Route::get('/editMediaPost/post/{type_media_post}/{id}', [\App\Http\Controllers\Admin\TaskController::class,'editMediaPost'])->name('editMediaPost.post');
            Route::post('/updateMediaPost/post/{type_media_post}/{id}', [\App\Http\Controllers\Admin\TaskController::class,'updateMediaPost'])->name('updateMediaPost.post');
            Route::post('/destroyMediaPost/post/{type_media_post}/{id}', [\App\Http\Controllers\Admin\TaskController::class,'destroyMediaPost'])->name('destroyMediaPost.post');
            Route::get('/exportMediaWebsite/{type_media_post}',[\App\Http\Controllers\Admin\TaskController::class,'exportMediaWebsite'])->name('exportMediaWebsite');
        });


        Route::get('/getFollowUps', [\App\Http\Controllers\Admin\TaskController::class,'getFollowUps'])->name('getFollowUps');
        Route::get('/getMarketFeedbacks', [\App\Http\Controllers\Admin\TaskController::class,'getMarketFeedbacks'])->name('getMarketFeedbacks');
        Route::get('/getCompetitorFeedbacks', [\App\Http\Controllers\Admin\TaskController::class,'getCompetitorFeedbacks'])->name('getCompetitorFeedbacks');
        Route::get('/getProposals', [\App\Http\Controllers\Admin\TaskController::class,'getProposals'])->name('getProposals');

        Route::get('/getTrainings', [\App\Http\Controllers\Admin\TaskController::class,'getTrainings'])->name('getTrainings');
        Route::get('/createTraining', [\App\Http\Controllers\Admin\TaskController::class,'createTraining'])->name('createTraining');
        Route::post('/storeTraining', [\App\Http\Controllers\Admin\TaskController::class,'storeTraining'])->name('storeTraining');
        Route::get('/editTraining/{id}', [\App\Http\Controllers\Admin\TaskController::class,'editTraining'])->name('editTraining');
        Route::post('/updateTraining/{id}', [\App\Http\Controllers\Admin\TaskController::class,'updateTraining'])->name('updateTraining');
        Route::delete('/destroyTraining/{id}', [\App\Http\Controllers\Admin\TaskController::class,'destroyTraining'])->name('destroyTraining');

        Route::get('/getSaleTaskAssign', [\App\Http\Controllers\Admin\TaskController::class,'getSaleTaskAssign'])->name('getSaleTaskAssign');
        Route::get('/createSaleTaskAssign', [\App\Http\Controllers\Admin\TaskController::class,'createSaleTaskAssign'])->name('createSaleTaskAssign');
        Route::post('/storeSaleTaskAssign', [\App\Http\Controllers\Admin\TaskController::class,'storeSaleTaskAssign'])->name('storeSaleTaskAssign');
        Route::get('/editSaleTaskAssign', [\App\Http\Controllers\Admin\TaskController::class,'editSaleTaskAssign'])->name('editSaleTaskAssign');
        Route::post('/updateSaleTaskAssign', [\App\Http\Controllers\Admin\TaskController::class,'updateSaleTaskAssign'])->name('updateSaleTaskAssign');
        Route::delete('/destroySaleTaskAssign/{id}', [\App\Http\Controllers\Admin\TaskController::class,'destroySaleTaskAssign'])->name('destroySaleTaskAssign');
        //task sale report

        //end task sale report

        //agent report
        Route::get('/getAgentReports', [\App\Http\Controllers\Admin\TaskController::class,'getAgentReports'])->name('getAgentReports');
        Route::get('/getInvoiceReports', 'Admin\TaskController@getInvoiceReports')->name('getInvoiceReports');
        //end agent report

        //export to excel task sale
        Route::get('/exportExcelTaskSale', [\App\Http\Controllers\Admin\TaskController::class,'exportExcelTaskSale'])->name('exportExcelTaskSale');
        //end export to excel task sale
    });
    Route::group(['prefix' => 'status', 'as' => 'status.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\StatusController::class,'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\StatusController::class,'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\StatusController::class,'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\StatusController::class,'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Admin\StatusController::class,'update'])->name('update');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\StatusController::class,'destroy'])->name('delete');
    });
    Route::group(['prefix' => 'archive-media-link', 'as' => 'archive-media-link.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\ArchiveMediaLinkController::class,'index'])->name('index');
        Route::get('/getData', [\App\Http\Controllers\Admin\ArchiveMediaLinkController::class,'getData'])->name('getData');
        Route::get('/create', [\App\Http\Controllers\Admin\ArchiveMediaLinkController::class,'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\ArchiveMediaLinkController::class,'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\ArchiveMediaLinkController::class,'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Admin\ArchiveMediaLinkController::class,'update'])->name('update');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\ArchiveMediaLinkController::class,'destroy'])->name('delete');
    });
    Route::group(['prefix' => 'archive-media-content', 'as' => 'archive-media-content.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\ArchiveMediaContentController::class, 'index'])->name('index');
        Route::get('/getData', [\App\Http\Controllers\Admin\ArchiveMediaContentController::class, 'getData'])->name('getData');
        Route::get('/create', [\App\Http\Controllers\Admin\ArchiveMediaContentController::class, 'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\ArchiveMediaContentController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\ArchiveMediaContentController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Admin\ArchiveMediaContentController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\ArchiveMediaContentController::class, 'destroy'])->name('delete');
        Route::get('/viewContentPost/{id}', [\App\Http\Controllers\Admin\ArchiveMediaContentController::class, 'viewContentPost'])->name('viewContentPost');
    });
    Route::group(['prefix' => 'google-adword-media', 'as' => 'google-adword-media.'], function () {
        Route::get('/', 'Admin\GoogleAdwordMediaController@index')->name('index');
        Route::get('/getData', 'Admin\GoogleAdwordMediaController@getData')->name('getData');
        Route::get('/create', 'Admin\GoogleAdwordMediaController@create')->name('create');
        Route::post('/store', 'Admin\GoogleAdwordMediaController@store')->name('store');
        Route::get('/edit/{id}', 'Admin\GoogleAdwordMediaController@edit')->name('edit');
        Route::post('/update/{id}', 'Admin\GoogleAdwordMediaController@update')->name('update');
        Route::post('/delete/{id}', 'Admin\GoogleAdwordMediaController@destroy')->name('delete');
    });
    Route::group(['prefix' => 'check-list-group', 'as' => 'check-list-group.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\GroupCheckListController::class,'index'])->name('index');
        Route::get('/getData', [\App\Http\Controllers\Admin\GroupCheckListController::class,'getData'])->name('getData');
        Route::get('/create', [\App\Http\Controllers\Admin\GroupCheckListController::class,'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\GroupCheckListController::class,'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\GroupCheckListController::class,'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Admin\GroupCheckListController::class,'update'])->name('update');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\GroupCheckListController::class,'destroy'])->name('delete');
        Route::get('/getGroup/{type}', [\App\Http\Controllers\Admin\GroupCheckListController::class,'getGroup'])->name('getGroup');
    });
    Route::group(['prefix' => 'check-list', 'as' => 'check-list.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\CheckListController::class,'index'])->name('index');
        Route::get('/getData', [\App\Http\Controllers\Admin\CheckListController::class,'getData'])->name('getData');
        Route::get('/create', [\App\Http\Controllers\Admin\CheckListController::class,'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\CheckListController::class,'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\CheckListController::class,'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Admin\CheckListController::class,'update'])->name('update');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\CheckListController::class,'destroy'])->name('delete');
        Route::get('/getGroup', [\App\Http\Controllers\Admin\CheckListController::class,'getGroup'])->name('getGroup');
        Route::get('/getValueByType', [\App\Http\Controllers\Admin\CheckListController::class,'getValueByType'])->name('getValueByType');
    });

    Route::group(['prefix' => 'domain-hosting-manager', 'as' => 'domain-hosting-manager.'], function () {
        Route::get('/',[\App\Http\Controllers\Admin\DomainHostingListController::class,'index'])->name('index');
        Route::get('/getData', [\App\Http\Controllers\Admin\DomainHostingListController::class,'getData'])->name('getData');
        Route::get('/create',[\App\Http\Controllers\Admin\DomainHostingListController::class,'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\DomainHostingListController::class,'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\DomainHostingListController::class,'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Admin\DomainHostingListController::class,'update'])->name('update');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\DomainHostingListController::class,'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'email-skype-manager', 'as' => 'email-skype-manager.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\MailSkypeListController::class,'index'])->name('index');
        Route::get('/getData', [\App\Http\Controllers\Admin\MailSkypeListController::class,'getData'])->name('getData');
        Route::get('/create', [\App\Http\Controllers\Admin\MailSkypeListController::class,'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\MailSkypeListController::class,'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\MailSkypeListController::class,'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Admin\MailSkypeListController::class,'update'])->name('update');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\MailSkypeListController::class,'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'website-account-manager', 'as' => 'website-account-manager.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\WebsiteAndAccountController::class,'index'])->name('index');
        Route::get('/getData', [\App\Http\Controllers\Admin\WebsiteAndAccountController::class,'getData'])->name('getData');
        Route::get('/create', [\App\Http\Controllers\Admin\WebsiteAndAccountController::class,'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\WebsiteAndAccountController::class,'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\WebsiteAndAccountController::class,'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Admin\WebsiteAndAccountController::class,'update'])->name('update');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\WebsiteAndAccountController::class,'destroy'])->name('delete');
    });
    Route::group(['prefix' => 'traffice', 'as' => 'traffice.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\TrafficeController::class,'index'])->name('index');
        Route::get('/getData', [\App\Http\Controllers\Admin\TrafficeController::class,'getData'])->name('getData');
        Route::get('/create', [\App\Http\Controllers\Admin\TrafficeController::class,'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\TrafficeController::class,'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\TrafficeController::class,'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Admin\TrafficeController::class,'update'])->name('update');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\TrafficeController::class,'destroy'])->name('delete');
    });
    Route::group(['prefix' => 'seo-keyword', 'as' => 'seo-keyword.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\SeoKeywordController::class,'index'])->name('index');
        Route::get('/getData', [\App\Http\Controllers\Admin\SeoKeywordController::class,'getData'])->name('getData');
        Route::get('/create', [\App\Http\Controllers\Admin\SeoKeywordController::class,'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\SeoKeywordController::class,'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\SeoKeywordController::class,'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Admin\SeoKeywordController::class,'update'])->name('update');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\SeoKeywordController::class,'destroy'])->name('delete');
    });
    Route::group(['prefix' => 'it-checklist', 'as' => 'it-checklist.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\ITCheckListController::class,'index'])->name('index');
        Route::get('/getData', [\App\Http\Controllers\Admin\ITCheckListController::class,'getData'])->name('getData');
        Route::get('/create', [\App\Http\Controllers\Admin\ITCheckListController::class,'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\ITCheckListController::class,'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\ITCheckListController::class,'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Admin\ITCheckListController::class,'update'])->name('update');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\ITCheckListController::class,'destroy'])->name('delete');
    });
    Route::group(['prefix' => 'marketing-material', 'as' => 'marketing-material.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\MarketingMaterialController::class,'index'])->name('index');
        Route::get('/getData', [\App\Http\Controllers\Admin\MarketingMaterialController::class,'getData'])->name('getData');
        Route::get('/create', [\App\Http\Controllers\Admin\MarketingMaterialController::class,'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\MarketingMaterialController::class,'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\MarketingMaterialController::class,'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Admin\MarketingMaterialController::class,'update'])->name('update');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\MarketingMaterialController::class,'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'customer_database_manager', 'as' => 'customer_database_manager.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\CustomerDatabaseManagerController::class, 'index'])->name('index');
        Route::get('/getData', [\App\Http\Controllers\Admin\CustomerDatabaseManagerController::class, 'getData'])->name('getData');
        Route::get('/create', [\App\Http\Controllers\Admin\CustomerDatabaseManagerController::class, 'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\CustomerDatabaseManagerController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\CustomerDatabaseManagerController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Admin\CustomerDatabaseManagerController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\CustomerDatabaseManagerController::class, 'destroy'])->name('delete');
        Route::post('/importExcel', [\App\Http\Controllers\Admin\CustomerDatabaseManagerController::class, 'importExcel'])->name('importExcel');
    });
    Route::group(['prefix' => 'template_invoice_manager', 'as' => 'template_invoice_manager.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\TemplateInvoiceManagerController::class, 'index'])->name('index');
        Route::get('/getData', [\App\Http\Controllers\Admin\TemplateInvoiceManagerController::class, 'getData'])->name('getData');
        Route::get('/create', [\App\Http\Controllers\Admin\TemplateInvoiceManagerController::class, 'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\TemplateInvoiceManagerController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\TemplateInvoiceManagerController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Admin\TemplateInvoiceManagerController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\TemplateInvoiceManagerController::class, 'destroy'])->name('delete');
        Route::get('/show-template-invoice/{id}', [\App\Http\Controllers\Admin\TemplateInvoiceManagerController::class, 'showTemplateInvoice'])->name('showTemplateInvoice');
    });
    Route::group(['prefix' => 'lucky-draw', 'as' => 'lucky_draw.'], function () {
        Route::get('/', [\App\Http\Controllers\LuckyDrawController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\LuckyDrawController::class, 'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\LuckyDrawController::class, 'store'])->name('store');
        Route::post('/update/{id}', [\App\Http\Controllers\LuckyDrawController::class, 'update'])->name('update');
    });
    Route::group(['prefix' => 'queue-error-log', 'as' => 'queue_error_log.'], function () {
        Route::get('/{model}',[\App\Http\Controllers\Admin\QueueErrorLogController::class,'index'])->name('index');
        Route::get('/get-data/{model}',[\App\Http\Controllers\Admin\QueueErrorLogController::class,'getData'])->name('getData');
    });
    Route::group(['prefix' => 'checklist-setting', 'as' => 'checklist_setting.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\CheckListSettingController::class,'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\CheckListSettingController::class,'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\CheckListSettingController::class,'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\CheckListSettingController::class,'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Admin\CheckListSettingController::class,'update'])->name('update');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\CheckListSettingController::class,'destroy'])->name('delete');
        Route::get('/get-setting', [\App\Http\Controllers\Admin\CheckListSettingController::class,'getSetting'])->name('getSetting');
    });

    Route::group(['prefix' => 'task-media-status', 'as' => 'task_media_status.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\TaskMediaStatusController::class,'index'])->name('index');
        Route::get('/getData', [\App\Http\Controllers\Admin\TaskMediaStatusController::class,'getData'])->name('getData');
        Route::get('/create', [\App\Http\Controllers\Admin\TaskMediaStatusController::class,'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\TaskMediaStatusController::class,'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\TaskMediaStatusController::class,'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\Admin\TaskMediaStatusController::class,'update'])->name('update');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\TaskMediaStatusController::class,'destroy'])->name('delete');
    });

    Route::get('/notification/formNotifications', [\App\Http\Controllers\Admin\CommentTaksController::class, 'formNotifications'])->name('crm.formNotifications');
    Route::get('/ajax/autoUdpateFormNotifications', [\App\Http\Controllers\Admin\CommentTaksController::class, 'autoUdpateFormNotifications'])->name('crm.autoUdpateFormNotifications');

    Route::post('/ajax/updateComment', [\App\Http\Controllers\Admin\CommentTaksController::class, 'updateCommentTasks'])->name('updateCommentTasks');
    Route::post('/ajax/deleteCommentTasks', [\App\Http\Controllers\Admin\CommentTaksController::class, 'deleteCommentTasks'])->name('deleteCommentTasks');
    Route::post('/ajax/updateSeeCommentTasks', [\App\Http\Controllers\Admin\CommentTaksController::class, 'updateSeeCommentTasks'])->name('updateSeeCommentTasks');
});
Route::middleware(['auth:admin'])->prefix('lucky-draw')->group(function () {
    Route::get('/',[\App\Http\Controllers\LuckyDrawController::class,'show'])->name('lucky.show');
});
