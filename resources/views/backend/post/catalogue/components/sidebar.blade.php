<div class="ibox">
    <div class="ibox-content">
        <div class="row ">
            <div class="col-lg-12">
                <div class="form-row">
                    <label for="" class="control-label text-left"> Chọn danh mục cha
                        <span class="text-danger">(*)</span>
                        <span class="text-danger notice">Chọn root nếu không có danh mục cha</span>
                    </label>
                    <select class="form-control setupSelect2" name="parent_id" id="">
                        @foreach ($dropdown as $key => $val )
                        <option value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>

                </div>

            </div>

        </div>
    </div>
</div>
<div class="ibox">
    <div class="ibox-title">
        <h5>Chọn ảnh đại diện</h5>
    </div>
    <div class="ibox-content">
        <div class="row ">
            <div class="col-lg-12">
                <div class="form-row">
                    <span class="image img-cover image-target"><img src="{{ old('image') ?? asset('backend/img/not-found.jpg') }}"
                            alt=""></span>
                    <input type="hidden" name="image" value="{{ old('image', ($postCatalogue->image) ?? '') }}">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ibox">
    <div class="ibox-title">
        <h5>Cấu hình nâng cao</h5>
    </div>
    <div class="ibox-content">
        <div class="row ">
            <div class="col-lg-12">
                <div class="mb15">
                    <select class="form-control setupSelect2" name="publish" id="">
                        @foreach (config('apps.general.publish') as $key => $value)
                            <option {{ $key == old('publish', 
                                    (isset ($postCatalogue->publish)) ? $postCatalogue->publish : '')? 'selected' :'' }} 
                                    value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <select class="form-control setupSelect2" name="follow" id="">
                    @foreach (config('apps.general.follow') as $key => $value)
                        <option {{ $key == old('follow', 
                                (isset ($postCatalogue->follow)) ? $postCatalogue->follow : '')? 'selected' :'' }} 
                                value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
