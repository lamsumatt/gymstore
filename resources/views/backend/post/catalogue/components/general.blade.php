<div class="row mb15">
    <div class="col-lg-12">
        <div class="form-row">
            <label for="" class="control-label text-left"> Tiêu đề nhóm bài viết
                <span class="text-danger">(*)</span>
            </label>
            <input type="text" 
                    value="{{ old('name', ($postCatalogue->name) ?? '') }}" 
                    name="name" 
                    class="form-control" 
                    autocomplete="off" 
                    placeholder=""
                >
        </div>
    </div>
</div>
<div class="row mb15">
    <div class="col-lg-12">
        <div class="form-row">
            <label for="" class="control-label text-left"> Tóm tắt
                <span class="text-danger">(*)</span>
            </label>
            <textarea type="text" 
                    value="{{ old('description', ($postCatalogue->description) ?? '') }}" 
                    name="description" 
                    class="form-control ckeditor" 
                    autocomplete="off" 
                    placeholder=""
                    id="description"
                ></textarea>
        </div>
    </div>
</div>
<div class="row mb15">
    <div class="col-lg-12">
        <div class="form-row">
            <label for="" class="control-label text-left"> Nội dung
                <span class="text-danger">(*)</span>
            </label>
            <textarea type="text" 
                    value="{{ old('content', ($postCatalogue->content) ?? '') }}" 
                    name="content" 
                    class="form-control ckeditor" 
                    autocomplete="off" 
                    placeholder=""
                    id="content"
                ></textarea>
        </div>
    </div>
</div>