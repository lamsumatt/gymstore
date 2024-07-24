@include('backend.dashboard.components.breadcrumb', ['title' => $config['seo']['index']['title']])
<div class="row mt20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{ $config['seo']['index']['table'] }}</h5>
            {{-- toolbox --}}
                @include('backend.dashboard.components.toolbox', ['model' => 'Language'])
            </div>
            <div class="ibox-content">
            {{-- start filter --}}
                @include('backend.language.components.filter')
            {{-- end filter --}}

            {{-- start table --}}
                @include('backend.language.components.table')
            {{-- end table --}}

            </div>
        </div>
    </div>
</div>

