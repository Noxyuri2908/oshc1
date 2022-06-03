<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AgentContactController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\ArchiveMediaContentController;
use App\Http\Controllers\Admin\ArchiveMediaLinkController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\CheckListController;
use App\Http\Controllers\Admin\CheckListSettingController;
use App\Http\Controllers\Admin\CommentTaksController;
use App\Http\Controllers\Admin\CommissionController;
use App\Http\Controllers\Admin\CrmController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CustomerDatabaseManagerController;
use App\Http\Controllers\Admin\CustomerProcessController;
use App\Http\Controllers\Admin\DomainHostingListController;
use App\Http\Controllers\Admin\ExchangeRateController;
use App\Http\Controllers\Admin\FlywireController;
use App\Http\Controllers\Admin\GoogleLoginController;
use App\Http\Controllers\Admin\GroupCheckListController;
use App\Http\Controllers\Admin\HoahongController;
use App\Http\Controllers\Admin\ITCheckListController;
use App\Http\Controllers\Admin\MailSkypeListController;
use App\Http\Controllers\Admin\MarketingMaterialController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PhieuthuController;
use App\Http\Controllers\Admin\ProcessController;
use App\Http\Controllers\Admin\ProfitController;
use App\Http\Controllers\Admin\QueueErrorLogController;
use App\Http\Controllers\Admin\RefundController;
use App\Http\Controllers\Admin\RemindFollowUpsController;
use App\Http\Controllers\Admin\ReportCrmController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SeoKeywordController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\TailieuController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\TaskMediaStatusController;
use App\Http\Controllers\Admin\TemplateInvoiceManagerController;
use App\Http\Controllers\Admin\TrafficeController;
use App\Http\Controllers\Admin\WebsiteAndAccountController;
use App\Http\Controllers\AdminRemindFollowUpsController;
use App\Http\Controllers\ApprovedComReportController;
use App\Http\Controllers\Auth\CrmLoginController;
use App\Http\Controllers\CoverController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HospitalAccessController;
use App\Http\Controllers\LuckyDrawController;
use App\RemindFollowUps;

Route::get('crm/login', [CrmLoginController::class, 'showLoginForm'])->name('crm.login.get');
Route::post('crm/login', [CrmLoginController::class, 'login'])->name('crm.login.post');
Route::get('crm/test', [CrmLoginController::class, 'test'])->name('crm.test');

Route::middleware(['auth:admin'])->prefix('crm')->group(function () {
    Route::get('logout', [CrmLoginController::class, 'logout'])->name('crm.logout');
    Route::get('/', 'Admin\CrmController@dashboard')->name('crm.dashboard');
    Route::get('/dashboard', 'Admin\CrmController@dashboard')->name('crm.dashboard');
    Route::group(['prefix' => 'agent', 'as' => 'agent.'], function () {
        Route::get('/', [AgentController::class, 'index'])->name('index');
        Route::get('/exportExcel', [AgentController::class, 'exportExcel'])->name('exportExcel');
        Route::post('/importAgentCode', [AgentController::class, 'importAgentCode'])->name('importAgentCode');
        //Route::post('/UpdateAgent', [\App\Http\Controllers\Admin\AgentController::class, 'UpdateAgent'])->name('UpdateAgent');
        Route::post('/importTypeOfAgent', [AgentController::class, 'importTypeOfAgent'])->name('importTypeOfAgent');
        Route::get('/getData', [AgentController::class, 'getData'])->name('getData');
        Route::get('/showData/{id}', [AgentController::class, 'showData'])->name('showData');
        Route::post('/sendEmailAgent', [AgentController::class, 'sendEmailAgent'])->name('sendEmailAgent');
        Route::post('/multiDelete', [AgentController::class, 'multiDelete'])->name('multiDelete');
        Route::post('/updatePersonInCharge', [AgentController::class, 'updatePersonInCharge'])->name('updatePersonInCharge');
        Route::post('/updateStatusAgent', [AgentController::class, 'updateStatusAgent'])->name('updateStatusAgent');
        Route::post('/importExcel', [AgentController::class, 'importExcel'])->name('importExcel');
        Route::get('/create', [AgentController::class, 'create'])->name('create');
        Route::post('store', [AgentController::class, 'store'])->name('store');
        Route::get('/show/{id}', [AgentController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [AgentController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AgentController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [AgentController::class, 'destroy'])->name('destroy');
        Route::get('/getAgentSelect', [AgentController::class, 'getAgentSelect'])->name('getAgentSelect');
        Route::get('/getAgentById', [AgentController::class, 'getAgentById'])->name('getAgentById');

        Route::get('/getDataContactList/{id}', [AgentController::class, 'getDataContactList'])->name('getDataContactList');
        Route::get('/editContactAgent/{id}', [AgentController::class, 'editContactAgent'])->name('editContactAgent');
        Route::post('/storeContactAgent/{id}', [AgentController::class, 'storeContactAgent'])->name('storeContactAgent');
        Route::post('/updateContactAgent/{id}', [AgentController::class, 'updateContactAgent'])->name('updateContactAgent');
        Route::post('/destroyContactAgent/{id}', [AgentController::class, 'destroyContactAgent'])->name('destroyContactAgent');

        Route::get('/getModalFormContact/', [AgentController::class, 'getModalFormContact'])->name('getModalFormContact');

        Route::get('/getContactAgent/{id}', [AgentController::class, 'getContactAgent'])->name('getContactAgent');
        Route::get('/getAgentFilterAndAgentDefault', [AgentController::class, 'getAgentFilterAndAgentDefault'])->name('getAgentFilterAndAgentDefault');

        Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {
            Route::get('/', [AgentContactController::class, 'index'])->name('index');
            Route::get('/getData', [AgentContactController::class, 'getData'])->name('getData');
            Route::get('/create', [AgentContactController::class, 'create'])->name('create');
            Route::post('/store', [AgentContactController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [AgentContactController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [AgentContactController::class, 'update'])->name('update');
            Route::post('/delete/{id}', [AgentContactController::class, 'destroy'])->name('delete');
            Route::post('/importExcel', [AgentContactController::class, 'importExcel'])->name('importExcel');
            Route::get('/exportExcel', [AgentContactController::class, 'exportExcel'])->name('exportExcel');
            Route::get('/counsellor', [AgentContactController::class, 'getCounsellorByAgentId'])->name('getCounsellorByAgentId');
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
    Route::get('/ajax/getAgentInfo', [CrmController::class, 'getAgentInfo'])->name('crm.ajax.getAgentInfo');
    Route::get('/ajax/getCommInfo', [CrmController::class, 'getAgentComm'])->name('crm.ajax.getCommInfo');
    Route::get('/ajax/getSupport', 'Admin\CrmController@getSupport')->name('crm.ajax.getSupport');
    Route::get('/ajax/getContactInfo', 'Admin\CrmController@getContactInfo')->name('crm.ajax.getContactInfo');
    Route::get('/ajax/fillterAgent', 'Admin\SearchController@fillterAgent')->name('crm.ajax.fillterAgent');
    Route::get('/ajax/statusAgent', 'Admin\SearchController@statusAgent')->name('crm.ajax.statusAgent');
    Route::get('/ajax/searchAgent', 'Admin\SearchController@searchAgent')->name('crm.ajax.searchAgent');

    Route::get('/ajax/createContact', [CrmController::class, 'createContact'])->name('crm.createContact');
    Route::get('/ajax/storeContact', [CrmController::class, 'storeContact'])->name('crm.storeContact');
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
        Route::get('/', [CommissionController::class, 'index'])->name('index');
        Route::get('/getData', [CommissionController::class, 'getData'])->name('getData');
        Route::get('/create', [CommissionController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [CommissionController::class, 'edit'])->name('edit');
        Route::post('/delete/{id}', [CommissionController::class, 'delete'])->name('delete');
        Route::post('/store', [CommissionController::class, 'store'])->name('store');
        Route::post('/update/{id}', [CommissionController::class, 'update'])->name('update');
        Route::post('/all/update', [CommissionController::class, 'updateAll'])->name('updateAll');
        Route::post('/importExcel', [CommissionController::class, 'importExcel'])->name('importExcel');
        Route::get('/getProvider', [CommissionController::class, 'getProvider'])->name('getProvider');
        Route::post('/destroy/{id}', [CommissionController::class, 'destroy'])->name('destroy');
    });

    /* EMAIL */
    Route::group(['prefix' => 'email', 'as' => 'email.'], function () {

        // email settings
        Route::get('/email-settings', [EmailController::class, 'indexEmailSettings'])->name('email-settings.index');
        Route::post('/email-settings/update', [EmailController::class, 'updateEmailSettings'])->name('email-settings.update');

        // email templates
        Route::get('/email-template', [EmailController::class, 'indexEmailTempaltes'])->name('email-template.index');

        Route::get('/email-template/add-new', [EmailController::class, 'addNewEmailTemplate'])->name('email-template.add-new');
        Route::post('/email-template/store', [EmailController::class, 'storeEmailTemplate'])->name('email-template.store');

        Route::get('/email-template/edit/{id}', [EmailController::class, 'editEmailTemplate'])->name('email-template.edit');
        Route::post('/email-template/update/{id}', [EmailController::class, 'updateEmailTemplate'])->name('email-template.update');
        Route::post('/email-template/delete', [EmailController::class, 'destroyEmailTemplate'])->name('email-template.destroy');

        // email categories
        Route::get('/email-categories/index', [EmailController::class, 'indexCategories'])->name('email-categories.index');
        Route::post('/email-categories/event', [EmailController::class, 'eventCategories'])->name('email-categories.event');
        Route::post('/email-categories/event/email-template', [EmailController::class, 'getEmailTemplatesByIdCategory'])->name('email-categories.event.email-template');

        // send mail
        Route::post('/send-mail', [EmailController::class, 'sendMailWithTemplate'])->name('send-mail');
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
    Route::get('/ajax/createExchange', [ExchangeRateController::class, 'createExchange'])->name('crm.createExchange');
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

    Route::get('/process/agent/{id}', [ProcessController::class, 'index'])->name('agent.process');
    Route::post('/process/agent/{id}', [ProcessController::class, 'store'])->name('agent.process.store');
    Route::post('/follow-up/agent/{id}/store', [ProcessController::class, 'storeFollow'])->name('agent.process.follow.store');
    Route::post('/follow-up/agent/{agent_id}/edit/{follow_id}', [ProcessController::class, 'updateFollow'])->name('agent.process.follow.update');
    Route::get('/ajax/addNewFollow', [ProcessController::class, 'addNewFollow'])->name('crm.addNewFollow');
    Route::get('/ajax/editFollow', [ProcessController::class, 'editFollow'])->name('crm.editFollow');
    Route::post('/follow-up/agent/{agent_id}/update/{follow_id}', [ProcessController::class, 'updateFollow'])->name('agent.process.follow-up.update');
    Route::post('/follow-up/agent/{agent_id}/delete/{follow_id}', [ProcessController::class, 'destroyFollow'])->name('agent.process.follow-up.delete');

    Route::post('/ajax/getFollowAgent', 'Admin\ProcessController@getFollowAgent')->name('crm.ajax.getFollowAgent');
    Route::get('/follow-up/export-to-excel', 'Admin\TaskController@exportToExcelFollowUp')->name('crm.follow-up.export-to-excel');
    Route::get('/follow-up/export-to-pdf', 'Admin\TaskController@exportToPdfFollowUp')->name('crm.follow-up.export-to-pdf');

    Route::get('/remind-follow-ups', [RemindFollowUpsController::class, 'getAll'])->name('crm.remind-follow-ups');
    Route::post('/remind-follow-ups-filter', [RemindFollowUpsController::class, 'postFilter'])->name('crm.remind-follow-ups-filter');

    //market-feedback
    Route::post('/ajax/getMarketFeedback', [ProcessController::class, 'getMarketFeedback'])->name('crm.ajax.getMarketFeedback');
    Route::get('/ajax/addNewMarketFeedback', [ProcessController::class, 'addNewMarketFeedback'])->name('crm.ajax.addNewMarketFeedback');
    Route::post('/market-feedback/agent/{id}/store', [ProcessController::class, 'storeMarketFeedback'])->name('agent.process.market.feedback.store');
    Route::get('/ajax/editMarketFeedback', 'Admin\ProcessController@editMarketFeedback')->name('crm.ajax.editMarketFeedback');
    Route::post('/market-feedback/agent/{agent_id}/update/{market_feedback_id}', 'Admin\ProcessController@updateMarketFeedback')->name('agent.process.market.feedback.update');
    Route::post('/market-feedback/agent/{agent_id}/delete/{market_feedback_id}', 'Admin\ProcessController@destroyMarketFeedback')->name('agent.process.market.feedback.delete');

    //end market-feedback

    //competition-feedback
    Route::post('/ajax/getCompetitionFeedback', [ProcessController::class, 'getCompetitionFeedback'])->name('crm.ajax.getCompetitionFeedback');
    Route::get('/ajax/addNewCompetitionFeedback', [ProcessController::class, 'addNewCompetitionFeedback'])->name('crm.ajax.addNewCompetitionFeedback');
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
    Route::post('/ajax/getProposal', [ProcessController::class, 'getProposal'])->name('crm.ajax.getProposal');
    Route::get('/ajax/addNewProposal', [ProcessController::class, 'addNewProposal'])->name('crm.ajax.addNewProposal');
    Route::post('/proposal/agent/{id}/store', [ProcessController::class, 'storeProposal'])->name('agent.process.proposal.store');
    Route::get('/ajax/editProposal', [ProcessController::class, 'editProposal'])->name('crm.ajax.editProposal');
    Route::post('/proposal/agent/{agent_id}/update/{marketing_support_id}', [ProcessController::class, 'updateProposal'])->name('agent.process.proposal.update');
    Route::post('/proposal/agent/{agent_id}/delete/{marketing_support_id}', [ProcessController::class, 'destroyProposal'])->name('agent.process.proposal.delete');

    //end proposal
    Route::get('/ajax/addNewTask', 'Admin\ProcessController@addNewTask')->name('crm.addNewTask');
    Route::get('/ajax/editTask', 'Admin\ProcessController@editTask')->name('crm.editTask');


    Route::put('customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('ajax/customer/getData/{tab}', [CustomerController::class, 'getData'])->name('ajax.customer.getData');
    Route::get('ajax/customer/showData/{tab}/{id}', [CustomerController::class, 'showData'])->name('ajax.customer.showData');
    Route::get('ajax/customer/getProvider', [CustomerController::class, 'getProvider'])->name('ajax.customer.getProvider');
    Route::get('ajax/customer/getPrice', [CustomerController::class, 'getPrice'])->name('ajax.customer.getPrice');
    Route::get('ajax/customer/getStatusFilterCustomer/{tab}', [CustomerController::class, 'getStatusFilterCustomer'])->name('ajax.customer.getStatusFilterCustomer');
    Route::post('ajax/customer/udpateMultipleStaff', [CustomerController::class, 'udpateMultipleStaff'])->name('ajax.customer.udpateMultipleStaff');
    Route::post('ajax/customer/udpateMultipleStatus', [CustomerController::class, 'udpateMultipleStatus'])->name('ajax.customer.udpateMultipleStatus');
    Route::get('modalCreate', [CustomerController::class, 'modalCreate'])->name('modal.create.customer');
    Route::resource('customer', Admin\CustomerController::class);

    // hospital
    Route::post('hospital/add', [HospitalAccessController::class, 'add'])->name('hospital.add');
    Route::post('hospital/remove', [HospitalAccessController::class, 'remove'])->name('hospital.remove');
    Route::post('hospital/update', [HospitalAccessController::class, 'update'])->name('hospital.update');
    Route::get('hospital/get', [HospitalAccessController::class, 'get'])->name('hospital.get');


    Route::resource('flywire', 'Admin\FlywireController');
    Route::get('ajax/flywire/getData', [FlywireController::class, 'getData'])->name('ajax.flywire.getData');
    Route::get('ajax/flywire/showData/{id}', 'Admin\FlywireController@showData')->name('ajax.flywire.showData');
    Route::get('/ajax/flywire/showDocsAndRemindForm', [FlywireController::class, 'showDocsAndRemindForm'])->name('ajax.flywire.showDocsAndRemindForm');
    Route::get('ajax/flywire/getTotalData', [FlywireController::class, 'getTotalData'])->name('ajax.flywire.getTotalData');
    Route::post('ajax/flywire/storeFlywireByPaymentId', [FlywireController::class, 'storeFlywireByPaymentId'])->name('ajax.flywire.storeFlywireByPaymentId');
    Route::post('/importflywire', [FlywireController::class, 'importFlywirebyPaymentId'])->name('flywire.importFlywirebyPaymentId');
    Route::post('/import/comstatus', [FlywireController::class, 'importComStatus'])->name('flywire.importComStatus');
    Route::post('/import/promotioncode', [FlywireController::class, 'importPromotionCode'])->name('flywire.importPromotionCode');
    Route::post('/import/agent', [FlywireController::class, 'importAgent'])->name('flywire.importAgent');
    Route::get('/exportFlywire', [FlywireController::class, 'exportFlywire'])->name('flywire.exportFlywire');


    Route::get('flywires/process', [FlywireController::class, 'process'])->name('flywire.process');
    Route::post('flywires/process/com_and_profit', [FlywireController::class, 'processComAndProfit'])->name('flywires.process.com_and_profit');
    Route::post('flywires/process/get_exchange_rate_date', 'Admin\FlywireController@getExchangeProvider')->name('flywires.process.get_exchange_rate_date');
    Route::post('customer/multi_delete', 'Admin\CustomerController@multiDeleteData')->name('customer.multi_delete');
    Route::get('/applies/{tab}', 'Admin\CustomerController@getCommAplly')->name('customer.getCommAplly');

    Route::post('/export/invoice', [CustomerController::class, 'exportInvoice'])->name('invoice.export');
    Route::post('/export/Exportinvoice', [CustomerController::class, 'exportInvoiceWithBalde'])->name('invoice.export.with.blade');
    Route::get('/view/invoice', [CustomerController::class, 'viewInvoice'])->name('invoice.view');
    Route::get('/ajax/formPartner', 'Admin\CustomerController@formPartner')->name('customer.formPartner');
    Route::get('/ajax/formChild', 'Admin\CustomerController@formChild')->name('customer.formChild');
    Route::get('/ajax/getRef', 'Admin\CustomerController@getRef')->name('customer.getRef');
    Route::get('/ajax/getSu', 'Admin\CustomerController@getSu')->name('customer.getSu');
    Route::get('/ajax/getComm', [CustomerController::class, 'getComm'])->name('customer.getComm');
    Route::get('/ajax/getCus', 'Admin\CustomerController@getCus')->name('customer.getCus');
    Route::get('/ajax/getInvoice', 'Admin\CustomerController@getInvoice')->name('customer.getInvoice');
    Route::get('/ajax/customer/getBankFeeByPaymentMethod', [CustomerController::class, 'getBankFeeByPaymentMethod'])->name('ajax.customer.getBankFeeByPaymentMethod');
    Route::get('/ajax/searchInvoice', 'Admin\CustomerController@searchInvoice')->name('customer.searchInvoice');
    Route::get('/ajax/statusInvoice', 'Admin\CustomerController@statusAgent')->name('crm.statusInvoice');
    Route::get('/ajax/fillterInvoice', 'Admin\CustomerController@fillterInvoice')->name('crm.fillterInvoice');
    Route::get('/customer/process/{id}/{tab}', [CustomerProcessController::class, 'index'])->name('customer.process.index');
    Route::get('/ajax/getComByIssueDate', [CustomerProcessController::class, 'getComByIssueDate'])->name('ajax.getComByIssueDate');
    Route::get('/ajax/changeInvoiceStatus', 'Admin\CustomerProcessController@changeInvoiceStatus')->name('crm.changeInvoiceStatus');
    Route::get('/ajax/getBtnReceipt', 'Admin\CustomerProcessController@getBtnReceipt')->name('crm.getBtnReceipt');
    Route::get('/ajax/saveReceipt', [PhieuthuController::class, 'store'])->name('ajax.saveReceipt');
    Route::get('/ajax/editReceipt', 'Admin\PhieuthuController@edit')->name('ajax.editReceipt');
    Route::get('/ajax/delReceipt', 'Admin\PhieuthuController@destroy')->name('phieuthu.del');

    Route::get('/ajax/getReceipt', [CustomerProcessController::class, 'getReceipt'])->name('ajax.getReceipt');
    Route::post('/import/importReceipt', [CustomerProcessController::class, 'importReceipt'])->name('customer.importReceipt');
    Route::post('/import/importInvoice', [CustomerProcessController::class, 'importInvoice'])->name('customer.importInvoice');

    Route::get('/ajax/createReceipt', [CustomerProcessController::class, 'createReceipt'])->name('ajax.createReceipt');
    Route::get('/ajax/showReceipt', [CustomerProcessController::class, 'showReceipt'])->name('ajax.showReceipt');
    Route::get('/ajax/deleteReceipt', [CustomerProcessController::class, 'deleteReceipt'])->name('ajax.deleteReceipt');
    Route::get('/ajax/showDocs', [CustomerProcessController::class, 'showDocs'])->name('ajax.showDocs');
    Route::get('/ajax/getExchangeRateByDate', 'Admin\CustomerProcessController@getExchangeRateByDate')->name('ajax.getExchangeRateByDate');
    Route::post('/ajax/sendEmailInvoice', 'Admin\CustomerController@sendEmailInvoice')->name('customer.sendEmailInvoice');
    Route::get('/ajax/getHH', [CustomerProcessController::class, 'getHH'])->name('ajax.getHH');

    Route::get('/ajax/showDocsAndRemindForm', [CustomerProcessController::class, 'showDocsAndRemindForm'])->name('ajax.showDocsAndRemindForm');
    Route::post('/ajax/storeRemind/{id}', 'Admin\CustomerProcessController@storeRemind')->name('ajax.storeRemind');


    Route::get('/ajax/getBtnHH', 'Admin\CustomerProcessController@getBtnHH')->name('crm.getBtnHH');
    Route::post('/ajax/saveHH', [HoahongController::class, 'store'])->name('ajax.saveHH');
    Route::get('/ajax/editHH', 'Admin\HoahongController@edit')->name('ajax.editHH');
    Route::post('/ajax/getDateOfPayment', 'Admin\HoahongController@getDateOfPayment')->name('ajax.getDateOfPayment');
    Route::post('/hoahong/delete/{id}', [HoahongController::class, 'destroy'])->name('crm.hoahong.delete');
    Route::post('/hoahong/multiDelete', 'Admin\HoahongController@multiDelete')->name('crm.hoahong.multi_delete');

    Route::get('/ajax/getBtnProfit', 'Admin\CustomerProcessController@getBtnProfit')->name('crm.getBtnProfit');
    Route::get('/ajax/saveProfit', [ProfitController::class, 'store'])->name('ajax.saveProfit');
    Route::get('/ajax/editProfit', 'Admin\ProfitController@edit')->name('ajax.editProfit');
    Route::post('/ajax/deleteProfit/{id}', [ProfitController::class, 'destroy'])->name('crm.ajax.deleteProfit');
    Route::post('/ajax/multiDeleteProfit', 'Admin\ProfitController@multiDelete')->name('crm.ajax.multiDeleteProfit');
    Route::post('/ajax/updateAllDateProfit', 'Admin\ProfitController@updateAllDateProfit')->name('crm.ajax.updateAllDateProfit');

    Route::get('/ajax/getBtnRefund', 'Admin\CustomerProcessController@getBtnRefund')->name('crm.getBtnRefund');
    Route::get('/ajax/saveRefund', [RefundController::class, 'store'])->name('ajax.saveRefund');
    Route::post('/ajax/deleteRefund/{id}', 'Admin\RefundController@destroy')->name('crm.ajax.deleteRefund');
    Route::post('/ajax/multiDeleteRefund', 'Admin\RefundController@multiDelete')->name('crm.ajax.multiDeleteRefund');

    Route::get('/ajax/getCurrency', 'Admin\CustomerController@getCurrency')->name('ajax.getCurrency');

    Route::get('/ajax/getFormCreateTailieu', [TailieuController::class, 'create'])->name('ajax.getFormCreateTailieu');
    Route::get('/ajax/getFormEditTailieu', [TailieuController::class, 'edit'])->name('ajax.getFormEditTailieu');
    Route::post('/tailieu/store', [TailieuController::class, 'store'])->name('apply.tailieu.store');
    Route::post('/tailieu/update/{id}', [TailieuController::class, 'update'])->name('apply.tailieu.update');
    Route::post('/tailieu/destroy', [TailieuController::class, 'destroy'])->name('apply.tailieu.destroy');

    Route::get('report_monthly', [ReportCrmController::class, 'reportMonthly'])->name('reportMonthly');
    Route::get('report_quarterly', 'Admin\ReportCrmController@reportQuarterly')->name('reportQuarterly');
    Route::get('report_flywire', 'Admin\ReportCrmController@reportFlywire')->name('reportFlywire');
    Route::get('export_flywire', 'Admin\ReportCrmController@exportFlywire')->name('exportFlywire');

    Route::get('report/exportExcel', 'Admin\ReportCrmController@exportExcel')->name('report.exportExcel');
    Route::get('report/exportPdf', 'Admin\ReportCrmController@exportPdf')->name('report.exportPdf');

    Route::get('/login/google', [GoogleLoginController::class, 'redirectToGoogleAuth'])->name('login.google');
    Route::get('/login/google/callback', [GoogleLoginController::class, 'loginGoogleCallback'])->name('login.google.callback');
    Route::post('/logout/google', [GoogleLoginController::class, 'logoutGoogle'])->name('logout.google');
    Route::group(['prefix' => 'event', 'as' => 'event.'], function () {
        Route::get('/index', [CalendarController::class, 'indexEvent'])->name('index');
        Route::get('/create', [CalendarController::class, 'createEvent'])->name('create');
        Route::post('/store', [CalendarController::class, 'storeEvent'])->name('store');
        Route::post('/show', [CalendarController::class, 'showEvent'])->name('show');
        Route::get('/edit', [CalendarController::class, 'editEvent'])->name('edit');
        Route::post('/update', [CalendarController::class, 'updateEvent'])->name('update');
        Route::post('/delete', [CalendarController::class, 'deleteEvent'])->name('delete');
        Route::get('/show-data', [CalendarController::class, 'showData'])->name('showData');
    });


    //all user admin
    Route::resource('staff', 'Admin\AdminController');
    Route::post('/staff/role-countries', [AdminController::class, 'roleCountries'])->name('staff.roleCountries');
    Route::post('/staff/get-role-countries', [AdminController::class, 'getRoleCountries'])->name('staff.getRoleCountries');
    Route::post('/staff/role-department', [AdminController::class, 'roleDepartment'])->name('staff.roleDepartment');
    Route::post('/staff/get-role-department', [AdminController::class, 'getRoleDepartment'])->name('staff.getRoleDepartment');

    //end user admin
    Route::resource('roles', 'Admin\RoleController');
    Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
        Route::get('/getUserRole/{id}', [RoleController::class, 'getUserRole'])->name('getUserRole');
    });
    Route::group(['prefix' => 'permissions', 'as' => 'permissions.'], function () {
        Route::get('/{id}', 'Admin\PermissionController@index')->name('index');
        Route::put('/update/{id}', [PermissionController::class, 'update'])->name('update');
    });

    Route::group(['prefix' => 'tasks', 'as' => 'tasks.'], function () {
        Route::get('/', [TaskController::class, 'index'])->name('index');

        Route::group(['prefix' => 'sale', 'as' => 'sale.'], function () {
            Route::get('/', [TaskController::class, 'sale'])->name('index');
            Route::group(['prefix' => 'report', 'as' => 'report.'], function () {
                Route::get('/', [TaskController::class, 'saleReportIndex'])->name('index');
            });
        });

        Route::group(['prefix' => 'media', 'as' => 'media.'], function () {
            Route::get('/', [TaskController::class, 'media'])->name('index');
            Route::get('/getMediaPost/post/{type_media_post}', [TaskController::class, 'getMediaPost'])->name('getMediaPost.post');
            Route::get('/createMediaPost/post/{type_media_post}', [TaskController::class, 'createMediaPost'])->name('createMediaPost.post');
            Route::post('/storeMediaPost/post/{type_media_post}', [TaskController::class, 'storeMediaPost'])->name('storeMediaPost.post');
            Route::get('/editMediaPost/post/{type_media_post}/{id}', [TaskController::class, 'editMediaPost'])->name('editMediaPost.post');
            Route::post('/updateMediaPost/post/{type_media_post}/{id}', [TaskController::class, 'updateMediaPost'])->name('updateMediaPost.post');
            Route::post('/destroyMediaPost/post/{type_media_post}/{id}', [TaskController::class, 'destroyMediaPost'])->name('destroyMediaPost.post');
            Route::get('/exportMediaWebsite/{type_media_post}', [TaskController::class, 'exportMediaWebsite'])->name('exportMediaWebsite');
        });


        Route::get('/getFollowUps', [TaskController::class, 'getFollowUps'])->name('getFollowUps');
        Route::get('/getMarketFeedbacks', [TaskController::class, 'getMarketFeedbacks'])->name('getMarketFeedbacks');
        Route::get('/getCompetitorFeedbacks', [TaskController::class, 'getCompetitorFeedbacks'])->name('getCompetitorFeedbacks');
        Route::get('/getProposals', [TaskController::class, 'getProposals'])->name('getProposals');

        Route::get('/getTrainings', [TaskController::class, 'getTrainings'])->name('getTrainings');
        Route::get('/createTraining', [TaskController::class, 'createTraining'])->name('createTraining');
        Route::post('/storeTraining', [TaskController::class, 'storeTraining'])->name('storeTraining');
        Route::get('/editTraining/{id}', [TaskController::class, 'editTraining'])->name('editTraining');
        Route::post('/updateTraining/{id}', [TaskController::class, 'updateTraining'])->name('updateTraining');
        Route::delete('/destroyTraining/{id}', [TaskController::class, 'destroyTraining'])->name('destroyTraining');

        Route::get('/getSaleTaskAssign', [TaskController::class, 'getSaleTaskAssign'])->name('getSaleTaskAssign');
        Route::get('/createSaleTaskAssign', [TaskController::class, 'createSaleTaskAssign'])->name('createSaleTaskAssign');
        Route::post('/storeSaleTaskAssign', [TaskController::class, 'storeSaleTaskAssign'])->name('storeSaleTaskAssign');
        Route::get('/editSaleTaskAssign', [TaskController::class, 'editSaleTaskAssign'])->name('editSaleTaskAssign');
        Route::post('/updateSaleTaskAssign', [TaskController::class, 'updateSaleTaskAssign'])->name('updateSaleTaskAssign');
        Route::delete('/destroySaleTaskAssign/{id}', [TaskController::class, 'destroySaleTaskAssign'])->name('destroySaleTaskAssign');
        //task sale report

        //end task sale report

        //agent report
        Route::get('/getAgentReports', [TaskController::class, 'getAgentReports'])->name('getAgentReports');
        Route::get('/getInvoiceReports', 'Admin\TaskController@getInvoiceReports')->name('getInvoiceReports');
        //end agent report

        //export to excel task sale
        Route::get('/exportExcelTaskSale', [TaskController::class, 'exportExcelTaskSale'])->name('exportExcelTaskSale');
        //end export to excel task sale
    });
    Route::group(['prefix' => 'status', 'as' => 'status.'], function () {
        Route::get('/', [StatusController::class, 'index'])->name('index');
        Route::get('/create', [StatusController::class, 'create'])->name('create');
        Route::post('/store', [StatusController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [StatusController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [StatusController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [StatusController::class, 'destroy'])->name('delete');
    });
    Route::group(['prefix' => 'archive-media-link', 'as' => 'archive-media-link.'], function () {
        Route::get('/', [ArchiveMediaLinkController::class, 'index'])->name('index');
        Route::get('/getData', [ArchiveMediaLinkController::class, 'getData'])->name('getData');
        Route::get('/create', [ArchiveMediaLinkController::class, 'create'])->name('create');
        Route::post('/store', [ArchiveMediaLinkController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ArchiveMediaLinkController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ArchiveMediaLinkController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [ArchiveMediaLinkController::class, 'destroy'])->name('delete');
    });
    Route::group(['prefix' => 'archive-media-content', 'as' => 'archive-media-content.'], function () {
        Route::get('/', [ArchiveMediaContentController::class, 'index'])->name('index');
        Route::get('/getData', [ArchiveMediaContentController::class, 'getData'])->name('getData');
        Route::get('/create', [ArchiveMediaContentController::class, 'create'])->name('create');
        Route::post('/store', [ArchiveMediaContentController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ArchiveMediaContentController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ArchiveMediaContentController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [ArchiveMediaContentController::class, 'destroy'])->name('delete');
        Route::get('/viewContentPost/{id}', [ArchiveMediaContentController::class, 'viewContentPost'])->name('viewContentPost');
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
        Route::get('/', [GroupCheckListController::class, 'index'])->name('index');
        Route::get('/getData', [GroupCheckListController::class, 'getData'])->name('getData');
        Route::get('/create', [GroupCheckListController::class, 'create'])->name('create');
        Route::post('/store', [GroupCheckListController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [GroupCheckListController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [GroupCheckListController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [GroupCheckListController::class, 'destroy'])->name('delete');
        Route::get('/getGroup/{type}', [GroupCheckListController::class, 'getGroup'])->name('getGroup');
    });
    Route::group(['prefix' => 'check-list', 'as' => 'check-list.'], function () {
        Route::get('/', [CheckListController::class, 'index'])->name('index');
        Route::get('/getData', [CheckListController::class, 'getData'])->name('getData');
        Route::get('/create', [CheckListController::class, 'create'])->name('create');
        Route::post('/store', [CheckListController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CheckListController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CheckListController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [CheckListController::class, 'destroy'])->name('delete');
        Route::get('/getGroup', [CheckListController::class, 'getGroup'])->name('getGroup');
        Route::get('/getValueByType', [CheckListController::class, 'getValueByType'])->name('getValueByType');
    });

    Route::group(['prefix' => 'domain-hosting-manager', 'as' => 'domain-hosting-manager.'], function () {
        Route::get('/', [DomainHostingListController::class, 'index'])->name('index');
        Route::get('/getData', [DomainHostingListController::class, 'getData'])->name('getData');
        Route::get('/create', [DomainHostingListController::class, 'create'])->name('create');
        Route::post('/store', [DomainHostingListController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [DomainHostingListController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [DomainHostingListController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [DomainHostingListController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'email-skype-manager', 'as' => 'email-skype-manager.'], function () {
        Route::get('/', [MailSkypeListController::class, 'index'])->name('index');
        Route::get('/getData', [MailSkypeListController::class, 'getData'])->name('getData');
        Route::get('/create', [MailSkypeListController::class, 'create'])->name('create');
        Route::post('/store', [MailSkypeListController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [MailSkypeListController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [MailSkypeListController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [MailSkypeListController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'website-account-manager', 'as' => 'website-account-manager.'], function () {
        Route::get('/', [WebsiteAndAccountController::class, 'index'])->name('index');
        Route::get('/getData', [WebsiteAndAccountController::class, 'getData'])->name('getData');
        Route::get('/create', [WebsiteAndAccountController::class, 'create'])->name('create');
        Route::post('/store', [WebsiteAndAccountController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [WebsiteAndAccountController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [WebsiteAndAccountController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [WebsiteAndAccountController::class, 'destroy'])->name('delete');
    });
    Route::group(['prefix' => 'traffice', 'as' => 'traffice.'], function () {
        Route::get('/', [TrafficeController::class, 'index'])->name('index');
        Route::get('/getData', [TrafficeController::class, 'getData'])->name('getData');
        Route::get('/create', [TrafficeController::class, 'create'])->name('create');
        Route::post('/store', [TrafficeController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [TrafficeController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [TrafficeController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [TrafficeController::class, 'destroy'])->name('delete');
    });
    Route::group(['prefix' => 'seo-keyword', 'as' => 'seo-keyword.'], function () {
        Route::get('/', [SeoKeywordController::class, 'index'])->name('index');
        Route::get('/getData', [SeoKeywordController::class, 'getData'])->name('getData');
        Route::get('/create', [SeoKeywordController::class, 'create'])->name('create');
        Route::post('/store', [SeoKeywordController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SeoKeywordController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [SeoKeywordController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [SeoKeywordController::class, 'destroy'])->name('delete');
    });
    Route::group(['prefix' => 'it-checklist', 'as' => 'it-checklist.'], function () {
        Route::get('/', [ITCheckListController::class, 'index'])->name('index');
        Route::get('/getData', [ITCheckListController::class, 'getData'])->name('getData');
        Route::get('/create', [ITCheckListController::class, 'create'])->name('create');
        Route::post('/store', [ITCheckListController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ITCheckListController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ITCheckListController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [ITCheckListController::class, 'destroy'])->name('delete');
    });
    Route::group(['prefix' => 'marketing-material', 'as' => 'marketing-material.'], function () {
        Route::get('/', [MarketingMaterialController::class, 'index'])->name('index');
        Route::get('/getData', [MarketingMaterialController::class, 'getData'])->name('getData');
        Route::get('/create', [MarketingMaterialController::class, 'create'])->name('create');
        Route::post('/store', [MarketingMaterialController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [MarketingMaterialController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [MarketingMaterialController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [MarketingMaterialController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'customer_database_manager', 'as' => 'customer_database_manager.'], function () {
        Route::get('/', [CustomerDatabaseManagerController::class, 'index'])->name('index');
        Route::get('/getData', [CustomerDatabaseManagerController::class, 'getData'])->name('getData');
        Route::get('/create', [CustomerDatabaseManagerController::class, 'create'])->name('create');
        Route::post('/store', [CustomerDatabaseManagerController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CustomerDatabaseManagerController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CustomerDatabaseManagerController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [CustomerDatabaseManagerController::class, 'destroy'])->name('delete');
        Route::post('/importExcel', [CustomerDatabaseManagerController::class, 'importExcel'])->name('importExcel');
    });
    Route::group(['prefix' => 'template_invoice_manager', 'as' => 'template_invoice_manager.'], function () {
        Route::get('/', [TemplateInvoiceManagerController::class, 'index'])->name('index');
        Route::get('/getData', [TemplateInvoiceManagerController::class, 'getData'])->name('getData');
        Route::get('/create', [TemplateInvoiceManagerController::class, 'create'])->name('create');
        Route::post('/store', [TemplateInvoiceManagerController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [TemplateInvoiceManagerController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [TemplateInvoiceManagerController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [TemplateInvoiceManagerController::class, 'destroy'])->name('delete');
        Route::get('/show-template-invoice/{id}', [TemplateInvoiceManagerController::class, 'showTemplateInvoice'])->name('showTemplateInvoice');
    });
    Route::group(['prefix' => 'lucky-draw', 'as' => 'lucky_draw.'], function () {
        Route::get('/', [LuckyDrawController::class, 'index'])->name('index');
        Route::get('/create', [LuckyDrawController::class, 'create'])->name('create');
        Route::post('/store', [LuckyDrawController::class, 'store'])->name('store');
        Route::post('/update/{id}', [LuckyDrawController::class, 'update'])->name('update');
    });
    Route::group(['prefix' => 'queue-error-log', 'as' => 'queue_error_log.'], function () {
        Route::get('/{model}', [QueueErrorLogController::class, 'index'])->name('index');
        Route::get('/get-data/{model}', [QueueErrorLogController::class, 'getData'])->name('getData');
    });
    Route::group(['prefix' => 'checklist-setting', 'as' => 'checklist_setting.'], function () {
        Route::get('/', [CheckListSettingController::class, 'index'])->name('index');
        Route::get('/create', [CheckListSettingController::class, 'create'])->name('create');
        Route::post('/store', [CheckListSettingController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CheckListSettingController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CheckListSettingController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [CheckListSettingController::class, 'destroy'])->name('delete');
        Route::get('/get-setting', [CheckListSettingController::class, 'getSetting'])->name('getSetting');
    });

    Route::group(['prefix' => 'task-media-status', 'as' => 'task_media_status.'], function () {
        Route::get('/', [TaskMediaStatusController::class, 'index'])->name('index');
        Route::get('/getData', [TaskMediaStatusController::class, 'getData'])->name('getData');
        Route::get('/create', [TaskMediaStatusController::class, 'create'])->name('create');
        Route::post('/store', [TaskMediaStatusController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [TaskMediaStatusController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [TaskMediaStatusController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [TaskMediaStatusController::class, 'destroy'])->name('delete');
    });

    Route::get('/notification/formNotifications', [CommentTaksController::class, 'formNotifications'])->name('crm.formNotifications');
    Route::get('/ajax/autoUdpateFormNotifications', [CommentTaksController::class, 'autoUdpateFormNotifications'])->name('crm.autoUdpateFormNotifications');

    Route::post('/ajax/updateComment', [CommentTaksController::class, 'updateCommentTasks'])->name('updateCommentTasks');
    Route::post('/ajax/deleteCommentTasks', [CommentTaksController::class, 'deleteCommentTasks'])->name('deleteCommentTasks');
    Route::post('/ajax/updateSeeCommentTasks', [CommentTaksController::class, 'updateSeeCommentTasks'])->name('updateSeeCommentTasks');

    Route::post('/cover/pushStore/', [CoverController::class, 'pushStore'])->name('pushStoreCover');
    Route::post('/cover/delete', [CoverController::class, 'delete'])->name('removeCoverById');
    Route::post('/cover/getCover', [CoverController::class, 'getCoverByServiceAndPolicy'])->name('getCoverByServiceAndPolicy');


    Route::get('/approve-com-report', [ApprovedComReportController::class, 'index'])->name('com_report');

    ///lily's route
    Route::get('/commission-report', 'CommissionReportController@index')->name('commission-report');
    Route::get('/export/{agentId}/{fromDate}/{toDate}', 'CommissionReportController@export')->name('commission-report-export');
    Route::get('/create-commission-report/{agentId}/{fromDate}/{toDate}', 'CommissionReportController@create')->name('create-commission-report');

});
Route::middleware(['auth:admin'])->prefix('lucky-draw')->group(function () {
    Route::get('/', [LuckyDrawController::class, 'show'])->name('lucky.show');
});
