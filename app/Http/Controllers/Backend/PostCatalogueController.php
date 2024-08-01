<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\PostCatalogueService as PostCatalogueService;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostCatalogueRequest;
use App\Http\Requests\UpdatePostCatalogueRequest;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;

class PostCatalogueController extends Controller
{
    protected $postCatalogueService;
    protected $postCatalogueRepository;

    public function __construct(PostCatalogueService $postCatalogueService, PostCatalogueRepository $postCatalogueRepository)
    {
        $this->postCatalogueService = $postCatalogueService;
        $this->postCatalogueRepository = $postCatalogueRepository;
    }

    public function index(Request $request)
    {
        $config = [
            'js' => [
                'backend/js/plugins/switchery/switchery.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
            ],
            'css' => [
                'backend/css/plugins/switchery/switchery.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ]
        ];
        $postCatalogue = $this->postCatalogueService->paginate($request);
        $config['seo'] = config('apps.postcatalogue');
        $template = 'backend.post.catalogue.index';
        $title = $config['seo']['index']['title']; // Define the title here

        return view('backend.dashboard.layout', compact('template', 'config', 'postCatalogue', 'title'));
    }
    public function create()
    {
        $config = $this->configData();
        $config['seo'] = config('apps.postcatalogue');
        $config['method'] = 'create';
        $template = 'backend.post.catalogue.store';
        return view('backend.dashboard.layout', compact('template', 'config'));
    }
    
    public function store(StorePostCatalogueRequest $request){
        if($this->postCatalogueService->create($request)){
            return redirect()->route('post.catalogue.index')->with('success', 'Thêm mới người dùng thành công');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Thêm mới người dùng thất bại');
    }

    public function edit($id){
        $postCatalogues = $this->postCatalogueRepository->findById($id);
        $config = $this->configData();
        $config['seo'] = config('apps.postcatalogue');
        $config['method'] = 'edit';
        $template = 'backend.post.catalogue.store';
        $title = $config['seo']['create']['title']; // Define the title here
        return view('backend.dashboard.layout', compact('template', 'config',  'postCatalogues'));

    }
    
    public function update( $id, UpdatePostCatalogueRequest $request){
        if($this->postCatalogueService->update( $id,$request)){
            return redirect()->route('post.catalogue.index')->with('success', 'Cập nhật người dùng thành công');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Cập nhật người dùng thất bại');
    }

    public function delete($id){
        $postCatalogue = $this->postCatalogueRepository->findById($id);
        $config['seo'] = config('apps.postcatalogue');
        $template = 'backend.post.catalogue.delete';
        
        return view('backend.dashboard.layout', compact( 'template','config',  'postCatalogue'));
    }

    public function destroy($id){
        if($this->postCatalogueService->destroy($id)){
            return redirect()->route('post.catalogue.index')->with('success', 'Xóa người dùng thành công');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Xóa người dùng thất bại');
    }

    private function configData(){
        return [
            'js'=> [
                'backend/plugins/ckeditor/ckeditor.js',
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/library/finder.js',
                'backend/library/seo.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
            ],
            'css'=> [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ]
        ];
    }
}