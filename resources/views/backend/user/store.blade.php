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
    $url = ($config['method']=='create') ? route('user.store') : route('user.update', $user->id);
@endphp
<form action="{{ $url }}" method="POST" class="box">
    @csrf
    <div class="wrapper wrapper-content animated faceInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Nhập thông tin chung</div>
                    <div class="panel-description">
                        <p>Nhập thông tin chung của người sử dụng</p> 
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
                                    <label for="" class="control-label text-left">Email 
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input type="text" value="{{ old('email', ($user->email) ?? '') }}" name="email" class="form-control" autocomplete="off" placeholder="">
                                </div>
                                
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Họ tên
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input type="text" value="{{ old('name', ($user->name) ?? '') }}" name="name" class="form-control" autocomplete="off" placeholder="">
                                </div>
                            </div>
                        </div>
                        @php
                            $userCatalogue = ['Chọn nhóm thành viên]','Quản trị viên','Cộng tác viên'];
                        @endphp
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Nhóm thành viên 
                                        <span class="text-danger">(*)</span>
                                        <select name="user_catalogue_id" id="" class="form-control setupSelect2" >
                                            @foreach ($userCatalogue as $key => $item )
                                            <option {{ $key == old('user_catalogue_id', 
                                            (isset ($user->user_catalogue_id)) ? $user->user_catalogue_id : '')? 'selected' :'' }} 
                                            value="{{ $key }}">{{ $item }}</option>
                                            @endforeach
                                          
                                        </select>
                                    </label>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Ngày sinh</label>
                                    <input type="date" value="{{ old('birthday', (isset ($user->birthday))
                                     ? date('Y-m-d', strtotime($user->birthday)): '') }}" 
                                    name="birthday" class="form-control" autocomplete="off" placeholder="">
                                </div>
                            </div>
                        </div>
                        @if($config['method'] == 'create')
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Mật khẩu
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input type="password" name="password" class="form-control" autocomplete="off" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Nhập lại mật khẩu
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input type="password" name="re_password" class="form-control" 
                                    autocomplete="off" placeholder="">
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row mb15">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Ảnh đại diện
                                    </label>
                                    <input type="text" value="{{ old('image', ($user->image) ?? '') }}" name="image" class="form-control input-image" autocomplete="off" placeholder="" data-upload="Images">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Nhập thông liên hệ</div>
                    <div class="panel-description">Nhập thông tin liên hệ</div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Thành phố
                                    </label>
                                    <select name="province_id" id="" class="form-control setupSelect2 province location" data-target="districts">
                                        <option value="0">[Chọn thành phố]</option>
                                        @if(isset ($provinces) )
                                            @foreach($provinces as $province)
                                                <option 
                                                    @if(old('province_id') == $province->code) selected @endif 
                                                    value="{{ $province->code }}">{{ $province->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Quận
                                    </label>
                                    <select name="district_id" id="" class="form-control districts setupSelect2 location" data-target="wards">
                                        <option value="0">[Chọn Quận/Huyện]</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Phường/Xã
                                        
                                    </label>
                                    <select name="ward_id" id="" class="form-control setupSelect2 wards" >
                                        <option value="0">[Chọn Phường/Xã]</option>
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Địa chỉ</label>
                                    <input type="text" value="{{ old('address', ($user->address) ?? '') }}" name="address" class="form-control" autocomplete="off" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Số điện thoại
                                    </label>
                                    <input type="text" value="{{ old('phone', ($user->phone) ?? '') }}" name="phone" class="form-control" autocomplete="off" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Ghi chú
                                    </label>
                                    <input type="text" value="{{ old('description', ($user->description) ?? '') }}" name="description" class="form-control" autocomplete="off" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right">
            <button class="btn btn-primary mb15" type="submit" name="send">Lưu</button> 
            {{-- <button class="btn btn-danger" type="reset">Huỷ</button> <button class="btn btn-default" type="button" onclick="window.history.back()"></button> --}}
        </div>
    </div>
</form>
<script>
    var province_id = '{{ (isset($user->province_id)) ? $user->province_id : (old('province_id', '')) }}';
    var district_id = '{{ (isset($user->district_id)) ? $user->district_id : (old('district_id', '')) }}';
    var ward_id = '{{ (isset($user->ward_id)) ? $user->ward_id : (old('ward_id', '')) }}';
</script>