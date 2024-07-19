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
    $url = ($config['method']=='create') ? route('user.catalogue.store') : route('user.catalogue.update', $userCatalogue->id);
@endphp
<form action="{{ $url }}" method="POST" class="box">
    @csrf
    <div class="wrapper wrapper-content animated faceInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Nhập thông tin chung</div>
                    <div class="panel-description">
                        <p>Nhập thông tin chung của nhóm thành viên sử dụng</p> 
                        <p>Lưu ý: Bắt buộc phải điền đầy đủ thông tin có đánh dấu <span class="text-danger">(*)</span></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left"> Tên nhóm 
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input type="text" value="{{ old('name', ($userCatalogue->name) ?? '') }}" name="name" class="form-control" autocomplete="off" placeholder="">
                                </div>
                                
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Ghi chú
                                        
                                    </label>
                                    <input type="text" value="{{ old('description', ($userCatalogue->name) ?? '') }}" name="description" class="form-control" autocomplete="off" placeholder="">
                                </div>
                            </div>
                        </div>
                     
                        
                    </div>
                </div>
            </div>
        </div>
        <hr>
     
        <div class="text-right">
            <button class="btn btn-primary mb15" type="submit" name="send">Lưu</button> 
            {{-- <button class="btn btn-danger" type="reset">Huỷ</button> <button class="btn btn-default" type="button" onclick="window.history.back()"></button> --}}
        </div>
    </div>
</form>
