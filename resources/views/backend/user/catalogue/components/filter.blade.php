<form action="{{ route('user.index') }}">
    <div class="filter-wrapper">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <div class="perpage">
                @php
                    $perpage = request('perpage')  ?: old('perpage');
                @endphp
                <div class="uk-flex uk-flex-middle">
                    <select name="perpage" class="form-control input-sm perpage filter mr10">
                        @for($i = 20; $i <= 200; $i += 20)
                            <option {{ ($perpage == $i) ? 'selected=' :  '' }} value="{{ $i }}">{{ $i }} bản ghi</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="action">
                <div class="uk-flex uk-flex-middle">
                    @php
                        $publishArray = ['Không xuất bản', 'Xuất bản'];
                        $publish = request('publish') ?: old('publish');
                    @endphp
                    <select name="publish" class="form-control ml10 setupSelect2 ">
                        <option value="-1" selected="selected">Chọn tình trạng</option>
                        @foreach($publishArray as $key => $value)
                            <option {{ ($publish == $key) ? 'selected=' :  '' }} value="{{ $key }}">{{ $value }}</option>
                        @endforeach
             
                    </select>
                    <select name="user_catalogue_id" class="form-control mr10 setupSelect2 ">
                        <option value="0" selected="selected">Chọn nhóm thành viên</option>
                        <option value="1">Quản trị viên</option>
                    </select>
                    <div class="uk-search uk-flex uk-flex-middle mr10 ml10">
                        <div class="input-group">
                            <input type="text" value="{{ request('keyword') ?: old('keyword') }}" name="keyword" class="form-control" placeholder="Nhập từ khóa ...">
                            <span class="input-group-btn">
                                <button class="btn btn-primary mb0 btn-sm">Tìm kiếm</button>
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('user.create') }}" class="btn btn-danger"><i class="fa fa-plus mr5"></i>Thêm mới thành viên</a>
                </div>
            </div>
           
        </div>
    </div>
</form>