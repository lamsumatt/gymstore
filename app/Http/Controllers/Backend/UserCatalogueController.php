<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\UserCatalogueService as UserService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserCatalogueRequest;
use App\Repositories\Interfaces\UserRepositoryInterface as UserCatalogueRepository;

class UserCatalogueController extends Controller
{
    protected $userCatalogueService;
    protected $userCatalogueRepository;

    public function __construct(UserService $userCatalogueService, UserCatalogueRepository $userCatalogueRepository)
    {
        $this->userCatalogueService = $userCatalogueService;
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
        $userCatalogues = $this->userCatalogueService->paginate($request);
        $config['seo'] = config('apps.UserCatalogue');
        $template = 'backend.user.catalogue.index';
        $title = $config['seo']['index']['title']; // Define the title here

        return view('backend.dashboard.layout', compact('template', 'config', 'userCatalogues', 'title'));
    }
    public function create()
    {
        $config['seo'] = config('apps.UserCatalogue');
        $config['method'] = 'create';
        $template = 'backend.user.catalogue.store';
        $title = $config['seo']['create']['title']; // Define the title here
        return view('backend.dashboard.layout', compact('template', 'config', 'title'));
    }
    
    public function store(StoreUserCatalogueRequest $request){
        if($this->userCatalogueService->create($request)){
            return redirect()->route('user.catalogue.index')->with('success', 'Thêm mới người dùng thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Thêm mới người dùng thất bại');
    }

    public function edit($id){
        $user = $this->userCatalogueService->findById($id);
        $config = [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'backend/library/location.js',
            ]
        ];
        $config['seo'] = config('apps.userCatalogue');
        $config['method'] = 'edit';
        $template = 'backend.user.catalogue.store';
        $title = $config['seo']['create']['title']; // Define the title here
        return view('backend.dashboard.layout', compact('template', 'config', 'title', 'provinces', 'user'));

    }
    
    public function update( $id, UpdateUserRequest $request){
        if($this->userService->update( $id,$request)){
            return redirect()->route('user.catalogue.index')->with('success', 'Cập nhật người dùng thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Cập nhật người dùng thất bại');
    }

    public function delete($id){
        $user = $this->userRepository->findById($id);
        $config['seo'] = config('apps.userCatalogue');
        $template = 'backend.user.catalogue.delete';
        
        return view('backend.dashboard.layout', compact( 'template','config',  'user'));
    }

    public function destroy($id){
        if($this->userService->destroy($id)){
            return redirect()->route('user.catalogue.index')->with('success', 'Xóa người dùng thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Xóa người dùng thất bại');
    }
}