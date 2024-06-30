<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceService;

class UserController extends Controller
{
    protected $userService;
    protected $proviceRepository;
    public function __construct( UserService $userService, ProvinceService $proviceRepository)
    {
        $this->userService = $userService;
        $this->proviceRepository = $proviceRepository;
    }
    public function index()
{
    $users = $this->userService->paginate();
    $config = [
        'js' => [
            'backend/js/plugins/switchery/switchery.js'
        ],
        'css' => [
            'backend/css/plugins/switchery/switchery.css'
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
            'backend/library/location.js'
        ]
    ];
    $config['seo'] = config('apps.user');

    $template = 'backend.user.create';
    $title = $config['seo']['create']['title']; // Define the title here
    return view('backend.dashboard.layout', compact('template', 'config', 'title', 'provinces'));
}


}