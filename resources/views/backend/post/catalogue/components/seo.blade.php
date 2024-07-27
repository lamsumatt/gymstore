<div class="ibox">
    <div class="ibox-title"><h5>Cấu hình SEO</h5></div>
    <div class="ibox-content">
        <div class="seo">
            <div class="meta-title">Học Laravel Framework - Học PHP</div>
            <div class="canonical">https://hoclaravel.com</div>
            <div class="meta-description">
                Laravel là một php framework mới, ra đời vào tháng 04/2011.Ngay 
                khi vừa mới ra mắt thì nó đã được cộng đồng chú ý đến bởi nhiều 
                đặc điểm và tính năng mới ...
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
                                value="{{ old('meta_title', ($postCatalogue->meta_title) ?? '') }}" 
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
                                value="{{ old('meta-keyword', ($postCatalogue->meta_keyword) ?? '') }}" 
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
                                value="{{ old('meta-description', ($postCatalogue->meta_description) ?? '') }}" 
                                name="meta-description" 
                                class="form-control" 
                                autocomplete="off" 
                                placeholder=""
                            ></textarea>
                    </div>
                </div>
            </div>
            <div class="row mb15">
                <div class="col-lg-12">
                    <div class="form-row">
                        <label for="" class="control-label text-left">
                            <span>Đường dẫn</span>
                        </label>
                        <input type="text" 
                                value="{{ old('canonical', ($postCatalogue->canonical) ?? '') }}" 
                                name="canonical" 
                                class="form-control" 
                                autocomplete="off" 
                                placeholder=""
                            >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
