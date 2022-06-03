<nav class="nav-bar-user">
    <div class="content-left">
        <div class="top-user-fixed">
            <div class="action-user">
                <div class="model-user">
                    <a href="javascript:void(0);">
                        <i class="far fa-user fa-2x"></i>
                    </a>
                </div>

                <div class="info-user">
                    <strong>{{!empty($username)?$username:''}}</strong>
                    <span>{{!empty($emailuser)?$emailuser:''}}</span>
                </div>
            </div>

            <div class="notification-dashboard" style="margin: 0 33px">

                <div>
                    {{-- Comments --}}
                    @include('CRM.elements.Notifications.comments')
                </div>

            </div>

            <div class="action-logout">

                <a href="{{ route('crm.logout') }}" title="LogOut">
                    <i class="fas fa-sign-out-alt fa-2x"></i>
                    {{--                    <span>Logout</span>--}}
                </a>
            </div>
        </div>
    </div>
</nav>

<a href="javascript:void(0)" id="show-nav-bar" class="show-nav-bar">
    <i class="fas fa-arrow-right"></i>
</a>
<a href="javascript:void(0)" id="hide-nav-bar" class="hide-nav-bar">
    <i class="fas fa-times"></i>
</a>
<nav class="navbar navbar-vertical navbar-expand-lg navbar-light navbar-glass " id="navbar-crm">
    <a class="navbar-brand text-left" href="#">
        <div class="d-flex align-items-center text-primary py-3">
            <div class="d-inline-flex flex-center"><span class="text-sans-serif"><img
                        style="width: 180px;max-width: 100%;" src="{{asset('images/ee420406b20f4951101e.jpg')}}" alt=""></span>
            </div>
        </div>
    </a>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <ul class="navbar-nav flex-column">
            <!-- Bảng tin -->
            <li class="nav-item {{$flag == 'dashboard' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('crm.dashboard')}}">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <span class="fas fa-store-alt"></span>
                        </span>
                        <span class="text-content-nav">DASHBOARD</span>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('post.index')}}" target="_blank">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <span class="fab fa-firefox"></span>
                        </span>
                        <span class="text-content-nav">CMS OSHC</span>
                    </div>

                </a>
            </li>
            @if(auth()->user()->can('users.viewAny') || auth()->user()->can('roles.index'))
                <li class="nav-item">
                    <a class="nav-link dropdown-indicator" href="#staff" data-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="pages-errors">
                        <span class="fas fa-user-friends"></span>
                        <span class="text-content-nav">STAFF</span>
                        <span class="badge badge-soft-success badge-pill ml-2"></span>
                    </a>
                    <ul class="nav collapse {{in_array($flag, ['list_staff', 'role']) ? 'show' : ''}}" id="staff">
                        @can('users.viewAny')
                            <li class="nav-item {{$flag == 'list_staff' ? 'active' : ''}}">
                                <a class="nav-link" href="{{route('staff.index')}}">LIST</a>
                            </li>
                        @endcan
                        @can('roles.index')
                            <li class="nav-item {{$flag == 'role' ? 'active' : ''}}">
                                <a class="nav-link" href="{{route('roles.index')}}">Roles</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link dropdown-indicator" href="#partner" data-toggle="collapse" role="button"
                   aria-expanded="false" aria-controls="pages-errors">
                    <span class="fas fa-user-friends"></span>
                    <span class="text-content-nav">PARTNER</span>
                    <span class="badge badge-soft-success badge-pill ml-2"></span>
                </a>
                <ul class="nav collapse {{in_array($flag, [
                    'agent.index',
                    'partner_agent_com',
                    'partner_provider',
                    'partner_school',
                    'partner_provider_list',
                    'partner_provider_com',
                    'agent_contact'
                     ]) ? 'show' : ''}}" id="partner">
                    <li class="nav-item {{in_array($flag,['agent.index','partner_agent_com','agent_contact']) ? 'active' : ''}}">
                        <a class="nav-link dropdown-indicator" href="#partner_agent_sub" data-toggle="collapse"
                           role="button"
                           aria-expanded="false" aria-controls="pages-errors">
                            <span class="fas fa-user-friends"></span>
                            <span class="text-content-nav">Agent</span>
                            <span class="badge badge-soft-success badge-pill ml-2"></span>
                        </a>
                        <ul class="nav collapse {{in_array($flag, ['agent.index', 'partner_agent_com','agent_contact']) ? 'show' : ''}}"
                            id="partner_agent_sub">
                            @can('agent.index')
                                <li class="nav-item {{$flag == 'agent.index' ? 'active' : ''}}">
                                    <a class="nav-link" href="{{route('agent.index')}}">List</a>
                                </li>
                            @endcan
                            @can('commissionAgent.index')
                                <li class="nav-item {{$flag == 'partner_agent_com' ? 'active' : ''}}">
                                    <a class="nav-link" href="{{route('com.index')}}">Com</a>
                                </li>
                            @endcan
                            @can('agentContact.menu')
                                <li class="nav-item {{$flag == 'agent_contact' ? 'active' : ''}}">
                                    <a class="nav-link" href="{{route('agent.contact.index')}}">Contact</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    <li class="nav-item {{in_array($flag,['partner_provider_list','partner_provider_com']) ? 'active' : ''}}">
                        <a class="nav-link dropdown-indicator" href="#partner_provider_sub" data-toggle="collapse"
                           role="button"
                           aria-expanded="false" aria-controls="pages-errors">
                            <span class="fas fa-user-friends"></span>
                            <span class="text-content-nav">Provider</span>
                            <span class="badge badge-soft-success badge-pill ml-2"></span>
                        </a>
                        <ul class="nav collapse {{in_array($flag, ['partner_provider_list', 'partner_provider_com']) ? 'show' : ''}}"
                            id="partner_provider_sub">
                            @can('providerList.menu')
                                <li class="nav-item {{$flag == 'partner_provider_list' ? 'active' : ''}}">
                                    <a class="nav-link" href="{{route('service.index')}}">List</a>
                                </li>
                            @endcan
                            @can('providerCom.index')
                                <li class="nav-item {{$flag == 'partner_provider_com' ? 'active' : ''}}">
                                    <a class="nav-link" href="{{route('provider-com.index')}}">Com</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    @can('school.menu')
                        <li class="nav-item {{$flag == 'partner_school' ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('school.index')}}">School</a>
                        </li>
                    @endcan
                </ul>
            </li>
            <li class="nav-item {{$flag == 'google_calendar' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('login.google')}}">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                        <span class="text-content-nav">Google Calendar</span>
                    </div>
                </a>
            </li>
        </ul>
        <hr class="border-300 my-2"/>
        <ul class="navbar-nav flex-column ">
            <li class="nav-item {{$flag == 'customer' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('customer.index')}}">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <span class="fas fa-file-invoice-dollar"></span>
                        </span>
                        <span class="text-content-nav">OSHC&OVHC</span>
                    </div>
                </a>
            </li>
            <li class="nav-item {{$flag == 'flywire' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('flywire.index')}}">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <span class="fas fa-file-invoice-dollar"></span>
                        </span>
                        <span class="text-content-nav">FLYWIRE</span>
                    </div>
                </a>
            </li>

            {{-- <li class="nav-item {{$flag == 'task' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('task.index')}}">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <span class="fas fa-file-invoice-dollar"></span>
                        </span>
                        <span class="text-content-nav"></span>
                    </div>
                </a>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link dropdown-indicator" href="#task" data-toggle="collapse" role="button"
                   aria-expanded="false" aria-controls="pages-errors">
                    <span class="fas fa-file-invoice-dollar"></span>
                    <span class="text-content-nav"> TASKS</span>
                    <span class="badge badge-soft-success badge-pill ml-2"></span>
                </a>
                <ul class="nav collapse {{in_array($flag, [
                    'tasks.sale'
                     ]) ? 'show' : ''}}" id="task">
                    <li class="nav-item {{in_array($flag,['tasks.sale']) ? 'active' : ''}}">
                        <a class="nav-link dropdown-indicator" href="#task_sales_sub" data-toggle="collapse"
                           role="button"
                           aria-expanded="false" aria-controls="pages-errors">
                            <span class="fas fa-file-invoice-dollar"></span>
                            <span class="text-content-nav">Sales</span>
                            <span class="badge badge-soft-success badge-pill ml-2"></span>
                        </a>
                        <ul class="nav collapse {{in_array($flag, ['tasks.sale']) ? 'show' : ''}}" id="task_sales_sub">
                            <li class="nav-item {{$flag == '' ? 'active' : ''}}">
                                <a class="nav-link" href="#">Manager</a>
                            </li>
                            <li class="nav-item {{$flag == 'tasks.sale' ? 'active' : ''}}">
                                <a class="nav-link" href="{{route('tasks.sale.index')}}">Sale</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{$flag == '' ? 'active' : ''}}">
                        <a class="nav-link" href="#">Management</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{$flag == 'email' ? 'active' : ''}}">
                <a class="nav-link dropdown-indicator" href="#email" data-toggle="collapse" role="button"
                   aria-expanded="false" aria-controls="pages-errors">
                    <span class="fas fa-file-invoice-dollar"></span>
                    <span class="text-content-nav"> Email</span>
                    <span class="badge badge-soft-success badge-pill ml-2"></span>
                </a>
                <ul class="nav collapse" id="email">
                    <li class="nav-item {{$flag == 'email-setting' ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('email.email-settings.index')}}">Email Settings</a>
                    </li>
                    <li class="nav-item {{$flag == 'email-template' ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('email.email-template.index')}}">Email Templates</a>
                    </li>
                    <li class="nav-item {{$flag == 'category' ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('email.email-categories.index')}}">Email categories</a>
                    </li>

                </ul>
            </li>
            @can('media.menu')
                <li class="nav-item {{$flag == 'tasks.media' ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('tasks.media.index')}}">
                        <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <i class="fab fa-medium-m"></i>
                        </span>
                            <span class="text-content-nav">Media</span>
                        </div>
                    </a>
                </li>
            @endcan

            <li class="nav-item {{$flag == 'it-checklist' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('it-checklist.index')}}">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <i class="fas fa-cogs"></i>
                        </span>
                        <span class="text-content-nav">IT checklists</span>
                    </div>
                </a>
            </li>
            <li class="nav-item {{$flag == 'marketing-material-list' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('marketing-material.index')}}">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <i class="fas fa-search-dollar"></i>
                        </span>
                        <span class="text-content-nav">Marketing material</span>
                    </div>
                </a>
            </li>
            <li class="nav-item {{$flag == 'customer-database-manager' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('customer_database_manager.index')}}">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <i class="fas fa-database"></i>
                        </span>
                        <span class="text-content-nav">Customer Database</span>
                    </div>
                </a>
            </li>
        </ul>
        <hr class="border-300 my-2"/>
        <ul class="navbar-nav flex-column">
            <li class="nav-item {{$flag == 'receipt' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('crm.receipt')}}">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <span class="fab fa-servicestack"></span>
                        </span>
                        <span class="text-content-nav">Receipt</span>
                    </div>
                </a>
            </li>
            @can('bank.menu')
                <li class="nav-item {{$flag == 'bank' ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('bank.index')}}">
                        <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <span class="fas fa-place-of-worship"></span>
                        </span>
                            <span class="text-content-nav">BANKS</span>
                        </div>
                    </a>
                </li>
            @endcan
            @can('exchangeRate.menu')
                <li class="nav-item {{$flag == 'exchange-rate' ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('exchange-rate.index')}}">
                        <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <span class="fas fa-exchange-alt"></span>
                        </span>
                            <span class="text-content-nav">EXCHANGE RATE</span>
                        </div>
                    </a>
                </li>
            @endcan
            <li class="nav-item {{$flag == 'promotion' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('promotion.index')}}">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <span class="far fa-snowflake"></span>
                        </span>
                        <span class="text-content-nav">PROMOTION</span>
                    </div>
                </a>
            </li>
            @can('service.menu')
                <li class="nav-item {{$flag == 'dichvu' ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('dichvu.index')}}">
                        <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <span class="fab fa-servicestack"></span>
                        </span>
                            <span class="text-content-nav">SERVICE</span>
                        </div>
                    </a>
                </li>
            @endcan
            @can('campaign.menu')
                <li class="nav-item {{$flag == 'campain' ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('campain.index')}}">
                        <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <span class="far fa-snowflake"></span>
                        </span>
                            <span class="text-content-nav">CAMPAIN</span>
                        </div>
                    </a>
                </li>
            @endcan
            @can('templateInvoiceManager.menu')
                <li class="nav-item {{$flag == 'template_invoice_manager' ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('template_invoice_manager.index')}}">
                        <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <i class="fas fa-sticky-note"></i>
                        </span>
                            <span class="text-content-nav">Template Invoice Manager</span>
                        </div>
                    </a>
                </li>
            @endcan
        </ul>
        <hr class="border-300 my-2"/>
        <ul class="navbar-nav flex-column">
            @can('report.menu')
                <li class="nav-item">
                    <a class="nav-link dropdown-indicator" href="#report" data-toggle="collapse"
                       role="button" aria-expanded="false" aria-controls="pages-errors">
                        <span class="fas fa-shipping-fast"></span>
                        <span class="text-content-nav">REPORT</span>
                        <span class="badge badge-soft-success badge-pill ml-2"></span></a>
                    <ul class="nav collapse {{in_array($flag, ['report-month','report-quarterly']) ? 'show' : ''}}"
                        id="report">
                        <li class="nav-item {{$flag == 'report-month' ? 'active' : ''}}">
                            <a target="_blank" class="nav-link"
                               href="{{ route('commission-report') }}">COMMISSION
                                REPORT</a>
                        </li>
                        <li class="nav-item {{$flag == 'report-month' ? 'active' : ''}}">
                            <a target="_blank" class="nav-link"
                               href="{{route('reportMonthly',['start_date'=>Carbon::now()->subMonth(1)->format('d/m/Y'),'end_date'=>Carbon::now()->format('d/m/Y'),'type'=>'vi'])}}">MONTHLY
                                REPORT</a>
                        </li>
                        <li class="nav-item {{$flag == 'report-quarterly' ? 'active' : ''}}">
                            <a target="_blank" class="nav-link"
                               href="{{route('reportQuarterly',['start_date'=>Carbon::now()->subMonth(1)->format('d/m/Y'),'end_date'=>Carbon::now()->format('d/m/Y'),'type'=>'vi'])}}">QUARTERLY
                                REPORT</a>
                        </li>
                        <li class="nav-item {{$flag == 'report-flywire' ? 'active' : ''}}">
                            <a target="_blank" class="nav-link"
                               href="{{route('reportFlywire', ['start_date'=>Carbon::now()->subMonth(1)->format('d/m/Y'),'end_date'=>Carbon::now()->format('d/m/Y'),'type'=>'vi'])}}">REPORT
                                FLYWIRE</a>
                        </li>
                        <li class="nav-item {{$flag == 'com-report' ? 'active' : ''}}">
                            <a class="nav-link"
                               href="{{route('com_report')}}">Approved Com Report</a>
                        </li>
                    </ul>
                </li>
            @endcan
            <li class="nav-item {{$flag == 'notify' ? 'active' : ''}}">
                <a class="nav-link" href="#">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <span class="fas fa-bell"></span>
                        </span>
                        <span class="text-content-nav">NOTIFICATION</span>
                    </div>
                </a>
            </li>
            <li class="nav-item {{$flag == 'notify' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('lucky_draw.index')}}">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <i class="fas fa-dice-six"></i>
                        </span>
                        <span class="text-content-nav">Config Luckydraw</span>
                    </div>
                </a>
            </li>
            @can('status.menu')
                <li class="nav-item {{$flag == 'status' ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('status.index')}}">
                        <div class="d-flex align-items-center">
                    <span class="nav-link-icon">
                        <i class="fas fa-cogs"></i>
                    </span>
                            <span class="text-content-nav">STATUS</span>
                        </div>
                    </a>
                </li>
            @endcan
            <li class="nav-item {{$flag == 'checklist_setting' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('checklist_setting.index')}}">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <i class="fas fa-cogs"></i>
                        </span>
                        <span class="text-content-nav">CheckList Setting</span>
                    </div>
                </a>
            </li>
            <li class="nav-item {{$flag == 'google-adword-media' ? 'active' : ''}}">
                <a class="nav-link" href="{{route('google-adword-media.index')}}">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon">
                            <i class="fas fa-ad"></i>
                        </span>
                        <span class="text-content-nav">Google Adword</span>
                    </div>
                </a>
            </li>
            @can('kho.menu')
                <li class="nav-item">
                    <a class="nav-link dropdown-indicator" href="#archive_media" data-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="pages-errors">
                        <span class="fas fa-file-invoice-dollar"></span>
                        <span class="text-content-nav">Kho</span>
                        <span class="badge badge-soft-success badge-pill ml-2"></span>
                    </a>
                    <ul class="nav collapse {{in_array($flag, ['archive-media-link','archive-media-content']) ? 'show' : ''}}"
                        id="archive_media">
                        <li class="nav-item {{$flag == 'archive-media-link' ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('archive-media-link.index')}}">Link</a>
                        </li>
                        <li class="nav-item {{$flag == 'archive-media-content' ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('archive-media-content.index')}}">Content</a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('itSystem.menu')
                <li class="nav-item">
                    <a class="nav-link dropdown-indicator" href="#itsystem" data-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="pages-errors">
                        <span class="fas fa-file-invoice-dollar"></span>
                        <span class="text-content-nav">IT System</span>
                        <span class="badge badge-soft-success badge-pill ml-2"></span>
                    </a>
                    <ul class="nav collapse {{in_array($flag, [
                    'domain-hosting-lists',
                    'mail-skype-lists',
                    'website-lists',
                    'account-service-lists',
                    'traffice-lists'
                    ]) ? 'show' : ''}}" id="itsystem">
                        <li class="nav-item {{$flag == 'domain-hosting-lists' ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('domain-hosting-manager.index')}}">Domain /hosting</a>
                        </li>
                        <li class="nav-item {{$flag == 'mail-skype-lists' ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('email-skype-manager.index')}}">Email / Skype</a>
                        </li>
                        <li class="nav-item {{$flag == 'website-lists' ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('website-account-manager.index',['type'=>'website'])}}">Website</a>
                        </li>
                        <li class="nav-item {{$flag == 'account-service-lists' ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('website-account-manager.index',['type'=>'service'])}}">Service</a>
                        </li>
                        <li class="nav-item {{$flag == 'traffice-lists' ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('traffice.index')}}">Traffice</a>
                        </li>
                        <li class="nav-item {{$flag == 'seo-keyword-lists' ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('seo-keyword.index')}}">Keyword</a>
                        </li>
                    </ul>
                </li>
            @endcan
        </ul>
        <a class="btn btn-primary btn-sm m-3" href="{{ route('crm.logout') }}">Logout</a>
    </div>
</nav>
<div id="modal_follow_ups_form" class="Anthony">

</div>
@push('scripts')
    @include('CRM.elements.task.sale.table.follow_up_agent.elements.script')

    <script>
        $('#show-nav-bar').on('click', function () {
            $('#navbar-crm').css('width', '12.625rem');
            $('#mainContent').css('margin-left', '13.625rem');

            $(this).removeClass('active');
            $('.text-content-nav').show();
            $('#hide-nav-bar').removeAttr('style');
        })
        $('#hide-nav-bar').on('click', function () {
            $('#navbar-crm').css('width', '3.625rem')
            $('#mainContent').css('margin-left', '4.625rem')
            $('.text-content-nav').hide();

            $(this).css('opacity', '0');
            $('#show-nav-bar').addClass('active');
        })

        function callModelFollowUp(elm) {
            // var id = elm.getAttribute('id');
            var agent_id = elm.getAttribute('data-id-agent');
            var follow_id = elm.getAttribute('data-id-follow-up');
            var comment_id = elm.getAttribute('data-id-comment');

            $.ajax({
                url: "{{route('updateSeeCommentTasks')}}",
                type: 'post',
                data: {
                    comment_id,
                    _token: "{{csrf_token()}}",
                },
                success: function (data) {
                    $('#number-noti').text(data.number_noti);
                    $('div[data-id="' + comment_id + '"]').css('display', 'none');
                },
            })


            $.ajax({
                url: "{{route('crm.editFollow')}}",
                type: 'get',
                data: {
                    agent_id,
                    follow_id
                },
                success: function (data) {
                    $('#modal_follow_ups_form').html(data);
                    $('#modal_follow_up').modal('toggle');
                },
                error: function (xhr) {
                    alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            })
        }


    </script>
@endpush
