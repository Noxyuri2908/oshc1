<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                @can('domain-hosting-manager.index')
                    <div class="">
                        <a class="form-control form-control-sm btn btn-default btn-sm font-size-12px" id="domain_hosting_href"
                           href="{{route('domain-hosting-manager.index')}}">
                            Domain hosting
                        </a>
                    </div>
                @endcan
                @can('email-skype-manager.index')
                    <div class="">
                        <a class="form-control form-control-sm btn btn-default btn-sm font-size-12px" id="email_href"
                           href="{{route('email-skype-manager.index')}}">
                            Email
                        </a>
                    </div>
                @endcan
                @can('website-account-manager.index')
                    <div class="">
                        <a class="form-control form-control-sm btn btn-default btn-sm font-size-12px" id="website_href"
                           href="{{route('website-account-manager.index',['type'=>'website'])}}">
                            Website
                        </a>
                    </div>
                @endcan
                @can('serviceAccount.index')
                    <div class="">
                        <a class="form-control form-control-sm btn btn-default btn-sm font-size-12px" id="account_service_href"
                           href="{{route('website-account-manager.index',['type'=>'service'])}}">
                            Account service
                        </a>
                    </div>
                @endcan
                @can('traffice.index')
                    <div class="">
                        <a class="form-control form-control-sm btn btn-default btn-sm font-size-12px" id="traffice_href"
                           href="{{route('traffice.index')}}">
                            Traffice
                        </a>
                    </div>
                @endcan
                @can('seo-keyword.index')
                    <div class="">
                        <a class="form-control form-control-sm btn btn-default btn-sm font-size-12px" id="seo_keyword_href"
                           href="{{route('seo-keyword.index')}}">
                            SEO keywords
                        </a>
                    </div>
                @endcan
            </div>
        </div>
    </div>
</div>
@push('scripts')
    @include('CRM.partials.choose_date',['ids'=>[
    'report_start_date',
    'report_end_date',
]])
    @include('CRM.partials.fancybox-link-popup',['ids'=>[
    'traffice_href',
    'domain_hosting_href',
    'email_href',
    'website_href',
    'account_service_href',
    'seo_keyword_href'
]])
@endpush
