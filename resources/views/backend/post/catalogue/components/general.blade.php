<div class="row mb15">
    <div class="col-lg-12">
        <div class="form-row">
            <label for="" class="control-label text-left"> Tiêu đề nhóm bài viết
                <span class="text-danger">(*)</span>
            </label>
            <input type="text" value="{{ old('name', ($postCatalogue->name) ?? '') }}" name="name" class="form-control"
                autocomplete="off" placeholder="">
        </div>
    </div>
</div>
<div class="row mb15">
    <div class="col-lg-12">
        <div class="form-row">
            <label for="" class="control-label text-left"> Tóm tắt
            </label>
            <textarea 
                type="text" 
                name="description"
                class="form-control ck-editor" 
                autocomplete="off" 
                placeholder="" 
                id="ckDescription" 
                data-height="500">{{ old('description', ($postCatalogue->description)??'') }}</textarea>
        </div>
    </div>
</div>
<div class="row mb15">
    <div class="col-lg-12">
        <div class="form-row">
            <label for="" class="control-label text-left"> Nội dung
            </label>
            <textarea 
                type="text"
                name="content"
                class="form-control ck-editor" 
                autocomplete="off" 
                placeholder="" 
                id="ckContent" 
                data-height="150">{{ old('content', ($postCatalogue->content) ?? '') }}</textarea>
        </div>
    </div>
</div>
