@include('backend.dashboard.components.breadcrumb', ['title' => $config['seo']['create']['title']])

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@php
    $url =
        $config['method'] == 'create'
            ? route('post.catalogue.store')
            : route('post.catalogue.update', $postCatalogue->id);
@endphp
<form action="{{ $url }}" method="POST" class="box">
    @csrf
    <div class="wrapper wrapper-content animated faceInRight">
        <div class="row">
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Thông tin chung</h5>
                    </div>
                    <div class="ibox-content">
                        @include('backend.post.catalogue.components.general')
                    </div>
                </div>
                @include('backend.post.catalogue.components.seo')
            </div>
            <div class="col-lg-3">
                @include('backend.post.catalogue.components.sidebar')
                <hr>

                <div class="text-right">
                    <button class="btn btn-primary mb15" type="submit" name="send">Lưu</button>
                </div>
            </div>
</form>
