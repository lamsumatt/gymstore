<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserServiceInterface as UserService;
use Illuminate\Http\Request;

class UserCatalogueController extends Controller
{
    protected $userCatalogueService;

    protected $userCatalogueRepository;
    public function __construct( UserService $userCatalogueService)
    {
        $this->userCatalogueService = $userCatalogueService;

    }
    public function index( Request $request )
{
    $userCatalogues = $this->userCatalogueService->paginate($request);
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
    $config['seo'] = config('apps.UserCatalogue');
    $template = 'backend.user.catalogue.index';
    $title = $config['seo']['index']['title']; // Define the title here
    return view('backend.dashboard.layout', compact('template', 'config', 'userCatalogues', 'title'));
}

// public function create()
// {
//     $provinces = $this->proviceRepository->all();

//     $config = [
//         'css' => [
//             'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
//         ],
//         'js' => [
//             'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
//             'backend/library/location.js',
//         ]
//     ];
//     $config['seo'] = config('apps.user');
//     $config['method'] = 'create';
//     $template = 'backend.user.catalogue.store';
//     $title = $config['seo']['create']['title']; // Define the title here
//     return view('backend.dashboard.layout', compact('template', 'config', 'title', 'provinces'));
// }

//     public function store(StoreUserRequest $request){
//         if($this->userCatalogueService->create($request)){
//             return redirect()->route('user.index')->with('success', 'Thêm mới người dùng thành công');
//         }
//         return redirect()->route('user.index')->with('error', 'Thêm mới người dùng thất bại');
//     }

//     public function edit($id){
//         $user = $this->userCatalogueRepository->findById($id);
//         $provinces = $this->proviceRepository->all();
//         $config = [
//             'css' => [
//                 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
//             ],
//             'js' => [
//                 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
//                 'backend/library/location.js',
//             ]
//         ];
//         $config['seo'] = config('apps.user');
//         $config['method'] = 'edit';
//         $template = 'backend.user.catalogue.store';
//         $title = $config['seo']['create']['title']; // Define the title here
//         return view('backend.dashboard.layout', compact('template', 'config', 'title', 'provinces', 'user'));

//     }

//     public function update( $id, UpdateUserRequest $request){
//         if($this->userCatalogueService->update( $id,$request)){
//             return redirect()->route('user.index')->with('success', 'Cập nhật người dùng thành công');
//         }
//         return redirect()->route('user.index')->with('error', 'Cập nhật người dùng thất bại');
//     }

//     public function delete($id){
//         $user = $this->userCatalogueRepository->findById($id);
//         $config['seo'] = config('apps.user');
//         $template = 'backend.user.catalogue.delete';
       
//         return view('backend.dashboard.layout', compact( 'template','config',  'user'));
//     }

//     public function destroy($id){
//         if($this->userCatalogueService->destroy($id)){
//             return redirect()->route('user.index')->with('success', 'Xóa người dùng thành công');
//         }
//         return redirect()->route('user.index')->with('error', 'Xóa người dùng thất bại');
//     }
}