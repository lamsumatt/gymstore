<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

class UserController extends Controller
{
    protected $userService;
    protected $proviceRepository;
    protected $userRepository;
    public function __construct( UserService $userService, ProvinceRepository $proviceRepository, UserRepository $userRepository)
    {
        $this->userService = $userService;
        $this->proviceRepository = $proviceRepository;
        $this->userRepository = $userRepository;
    }
    public function index( Request $request )
{
    $users = $this->userService->paginate($request);
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
    $config['seo'] = config('apps.user');
    $template = 'backend.user.index';
    $title = $config['seo']['index']['title']; // Define the title here
    return view('backend.dashboard.layout', compact('template', 'config', 'users', 'title'));
}

public function create()
{
    $provinces = $this->proviceRepository->all();

    $config = [
        'css' => [
            'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
        ],
        'js' => [
            'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
            'backend/library/location.js',
        ]
    ];
    $config['seo'] = config('apps.user');
    $config['method'] = 'create';
    $template = 'backend.user.store';
    $title = $config['seo']['create']['title']; // Define the title here
    return view('backend.dashboard.layout', compact('template', 'config', 'title', 'provinces'));
}

    public function store(StoreUserRequest $request){
        if($this->userService->create($request)){
            return redirect()->route('user.index')->with('success', 'Thêm mới người dùng thành công');
        }
        return redirect()->route('user.index')->with('error', 'Thêm mới người dùng thất bại');
    }

    public function edit($id){
        $user = $this->userRepository->findById($id);
        $provinces = $this->proviceRepository->all();
        $config = [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'backend/library/location.js',
            ]
        ];
        $config['seo'] = config('apps.user');
        $config['method'] = 'edit';
        $template = 'backend.user.store';
        $title = $config['seo']['create']['title']; // Define the title here
        return view('backend.dashboard.layout', compact('template', 'config', 'title', 'provinces', 'user'));

    }

    public function update( $id, UpdateUserRequest $request){
        if($this->userService->update( $id,$request)){
            return redirect()->route('user.index')->with('success', 'Cập nhật người dùng thành công');
        }
        return redirect()->route('user.index')->with('error', 'Cập nhật người dùng thất bại');
    }

    public function delete($id){
        $user = $this->userRepository->findById($id);
        $config['seo'] = config('apps.user');
        $template = 'backend.user.delete';
       
        return view('backend.dashboard.layout', compact( 'template','config',  'user'));
    }

    public function destroy($id){
        if($this->userService->destroy($id)){
            return redirect()->route('user.index')->with('success', 'Xóa người dùng thành công');
        }
        return redirect()->route('user.index')->with('error', 'Xóa người dùng thất bại');
    }
}