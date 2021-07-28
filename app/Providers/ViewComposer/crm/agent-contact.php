<?php
use Illuminate\Support\Facades\View;

View::composer([
    'CRM.pages.agent-contact.filter',
    'CRM.pages.agent-contact.data',
    'CRM.pages.agent-contact.form',
    'CRM.elements.agents.modal-create-contact'
], function ($view) {
    $currency = config('myconfig.currency');
    $view->with(compact(
        'currency'
    ));
});
