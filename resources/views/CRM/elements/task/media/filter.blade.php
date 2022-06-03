<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                @can('archive-media-link.index')
                    <div class="">
                        <a class="form-control form-control-sm btn btn-default btn-sm font-size-12px" id="archive_media_link_href"
                           href="{{route('archive-media-link.index')}}">
                            Kho Link
                        </a>
                    </div>
                @endcan
                @can('archive-media-content.index')
                    <div class="">
                        <a class="form-control form-control-sm btn btn-default btn-sm font-size-12px" id="archive_media_content_href"
                           href="{{route('archive-media-content.index')}}">
                            Kho Content
                        </a>
                    </div>
                @endcan
                @can('google-adword-media.index')
                    <div class="">
                        <a class="form-control form-control-sm btn btn-default btn-sm font-size-12px" id="google_adword_media_href"
                           href="{{route('google-adword-media.index')}}">
                            GG ADWORDS
                        </a>
                    </div>
                @endcan
                @can('google-adword-media.index')
                    <div class="">
                        <a class="form-control form-control-sm btn btn-default btn-sm font-size-12px" id="google_adword_media_href"
                           href="{{route('task_media_status.index')}}">
                            Media Setting
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
    <script>
        $(document).ready(function () {
            $("#archive_media_link_href , #archive_media_content_href, #google_adword_media_href").fancybox({
                'width': 900,
                'height': 900,
                'type': 'iframe',
                'autoScale': false,
                'autoSize': false,
                helpers: {
                    title: {
                        type: 'float'
                    }
                }
            });
        })

    </script>
@endpush
