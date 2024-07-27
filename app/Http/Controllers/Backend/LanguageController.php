<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\languageService as LanguageService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;

class LanguageController extends Controller
{
    protected $LanguageService;
    protected $LanguageRepository;

    public function __construct(LanguageService $LanguageService, LanguageRepository $LanguageRepository)
    {
        $this->LanguageService = $LanguageService;
        $this->LanguageRepository = $LanguageRepository;
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
        $Language = $this->LanguageService->paginate($request);
        $config['seo'] = config('apps.language');
        $template = 'backend.language.index';
        $title = $config['seo']['index']['title']; // Define the title here

        return view('backend.dashboard.layout', compact('template', 'config', 'Language', 'title'));
    }
    public function create()
    {
        $config = $this->configData();
        $config['seo'] = config('apps.language');
        $config['method'] = 'create';
        $template = 'backend.language.store';
        return view('backend.dashboard.layout', compact('template', 'config'));
    }
    
    public function store(StoreLanguageRequest $request){
        if($this->LanguageService->create($request)){
            return redirect()->route('language.index')->with('success', 'Thêm mới người dùng thành công');
        }
        return redirect()->route('language.index')->with('error', 'Thêm mới người dùng thất bại');
    }

    public function edit($id){
        $Languages = $this->LanguageRepository->findById($id);
        $config = $this->configData();
        $config['seo'] = config('apps.language');
        $config['method'] = 'edit';
        $template = 'backend.language.store';
        $title = $config['seo']['create']['title']; // Define the title here
        return view('backend.dashboard.layout', compact('template', 'config',  'Languages'));

    }
    
    public function update( $id, UpdateLanguageRequest $request){
        if($this->LanguageService->update( $id,$request)){
            return redirect()->route('language.index')->with('success', 'Cập nhật người dùng thành công');
        }
        return redirect()->route('language.index')->with('error', 'Cập nhật người dùng thất bại');
    }

    public function delete($id){
        $Language = $this->LanguageRepository->findById($id);
        $config['seo'] = config('apps.language');
        $template = 'backend.language.delete';
        
        return view('backend.dashboard.layout', compact( 'template','config',  'Language'));
    }

    public function destroy($id){
        if($this->LanguageService->destroy($id)){
            return redirect()->route('language.index')->with('success', 'Xóa người dùng thành công');
        }
        return redirect()->route('language.index')->with('error', 'Xóa người dùng thất bại');
    }

    private function configData(){
        return [
            'js'=> [
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/library/finder.js'
            ]
        ];
    }
}