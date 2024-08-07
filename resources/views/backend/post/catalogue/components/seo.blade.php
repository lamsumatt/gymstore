<div class="ibox">
    <div class="ibox-title"><h5>Cấu hình SEO</h5></div>
    <div class="ibox-content">
        <div class="seo-container">
            <div class="meta-title">{{ (old('meta_title', ($postCatalogue->meta_title)??'' )) ?? 'Bạn chưa có tiêu đề SEO' }}</div>
            <div class="canonical"> {{ (old('canonical', ($postCatalogue->canonical)??'' )) ? config('app.url').old('canonical', ($postCatalogue->canonical)?? '').config('apps.general.suffix') : 'https://example.html' }}</div>
            <div class="meta-description">
               {{ (old('meta_description',($postCatalogue->meta_description)?? '')) ?? 'Mô tả SEO' }} 
            </div>
        </div>
        <div class="seo-wrapper">
            <div class="row mb15">
                <div class="col-lg-12">
                    <div class="form-row">
                        <label for="" class="control-label text-left">
                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                <span>Mô tả SEO</span>
                                <span class="count_meta-title">0 ký tự</span>
                            </div> 
                        </label>
                        <input type="text" 
                                value="{{ old('meta_title', ($postCatalogue->meta_title)??'' ) }}" 
                                name="meta_title" 
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
                        <label for="" class="control-label text-left">
                            <span>Từ khóa SEO</span>
                        </label>
                        <input type="text" 
                                value="{{ old('meta-keyword', ($postCatalogue->meta_keyword)?? '')}}" 
                                name="meta-keyword" 
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
                        <label for="" class="control-label text-left">
                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                <span>Mô tả SEO</span>
                                <span class="count_meta-description">0 ký tự</span>
                            </div> 
                        </label>
                        <textarea type="text" 
                                name="meta-description" 
                                class="form-control" 
                                autocomplete="off" 
                                placeholder=""
                            >{{ old('meta_description', ($postCatalogue->meta_description)??'')}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row mb15">
                <div class="col-lg-12">
                    <div class="form-row">
                        <label for="" class="control-label text-left">
                            <span>Đường dẫn <span class="text-danger">*</span> </span>
                        </label>
                        <div class="input-wrapper">
                            <input type="text" 
                            value="{{ old('canonical', ($postCatalogue->canonical)??'') }}" 
                            name="canonical" 
                            class="form-control" 
                            autocomplete="off" 
                            placeholder=""
                        >
                        <span class="baseUrl">{{ config('app.url') }}</span>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
