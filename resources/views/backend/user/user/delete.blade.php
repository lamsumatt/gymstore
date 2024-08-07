@include('backend.dashboard.components.breadcrumb', ['title' => $config['seo']['create']['title']])


<form action="{{ route('user.destroy', $user->id) }}" method="POST" class="box">
    @csrf
    @method('DELETE')
    <div class="wrapper wrapper-content animated faceInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Nhập thông tin chung</div>
                    <div class="panel-description">
                        <p>Bạn đang muốn xóa thành viên có email là: {{ $user->email }}</p> 
                        <p>Lưu ý: Không thể khôi phục thành viên sau khi xóa. Hãy chắc chắn bạn muốn thực hiện chức năng này<span class="text-danger">(*)</span></p>
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
                                    <input type="text" value="{{ old('email', ($user->email) ?? '') }}" 
                                    name="email" class="form-control" autocomplete="off" placeholder="" readonly>
                                </div>
                                
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Họ tên
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input type="text" value="{{ old('name', ($user->name) ?? '') }}" 
                                    name="name" class="form-control" autocomplete="off" placeholder="" readonly>
                                </div>
                            </div>
                        </div>                                                   
                    </div>
                </div>
            </div>
        </div>
        <hr>
       
        <div class="text-right">
            <button class="btn btn-danger mb15" type="submit" name="send">Xóa dữ liệu</button> 
        </div>
    </div>
</form>
