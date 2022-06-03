<?php

namespace App\Providers;

use App\Http\ViewComposers\FrontendViewComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Admin\Webinfo;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
//        $this->app->singleton(FrontendViewComposer::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include('ViewComposer/front-end/header.php');
        include('ViewComposer/front-end/welcome.php');
        include('ViewComposer/front-end.php');
        include('ViewComposer/business.php');
        include('ViewComposer/admin.php');
        include('ViewComposer/crm.php');
        include('ViewComposer/crm/archive-media-content.php');
        include('ViewComposer/crm/archive-media-link.php');
        include('ViewComposer/crm/google-adword-media.php');
        include('ViewComposer/crm/check-list-group.php');
        include('ViewComposer/crm/check-list.php');
        include('ViewComposer/crm/status.php');
        include('ViewComposer/crm/domain-hosting-list.php');
        include('ViewComposer/crm/mail-skype-list.php');
        include('ViewComposer/crm/marketing-material.php');
        include('ViewComposer/crm/customer.php');
        include('ViewComposer/crm/admin-user-list.php');
        include('ViewComposer/crm/role.php');
        include('ViewComposer/crm/form-staff.php');
        include('ViewComposer/crm/customer-database-manager.php');
        include('ViewComposer/crm/flywire.php');
        include('ViewComposer/crm/agent.php');
        include('ViewComposer/crm/agent-contact.php');
        include('ViewComposer/crm/media-checklist.php');
        include('ViewComposer/crm/follow-up-agent-sale.php');
        include('ViewComposer/crm/template-invoice-manager.php');
        include('ViewComposer/crm/checklist-setting.php');
        include('ViewComposer/crm/task-media-status.php');
        include('ViewComposer/crm/agent-comm.php');
        include('ViewComposer/crm/promotion.php');
    }
}
