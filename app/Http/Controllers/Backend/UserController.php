<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\UserService as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

class UserController extends Controller
{
    protected $userService;
    protected $provinceRepository;
    protected $userRepository;

    public function __construct(UserService $userService, ProvinceRepository $provinceRepository, UserRepository $userRepository)
    {
        $this->userService = $userService;
        $this->provinceRepository = $provinceRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the users.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
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
        $template = 'backend.user.user.index';
        $title = $config['seo']['index']['title']; // Define the title here

        return view('backend.dashboard.layout', compact('template', 'config', 'users', 'title'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $provinces = $this->provinceRepository->all();
        $config = $this->config();
        $config['seo'] = config('apps.user');
        $config['method'] = 'create';
        $template = 'backend.user.user.store';
        $title = $config['seo']['create']['title']; // Define the title here

        return view('backend.dashboard.layout', compact('template', 'config', 'title', 'provinces'));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        if ($this->userService->create($request)) {
            return redirect()->route('user.index')->with('success', 'Thêm mới người dùng thành công');
        }
        return redirect()->route('user.index')->with('error', 'Thêm mới người dùng thất bại');
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->userRepository->findById($id);
        $provinces = $this->provinceRepository->all();
        $config = $this->config();
        $config['seo'] = config('apps.user');
        $config['method'] = 'edit';
        $template = 'backend.user.user.store';
      

        return view('backend.dashboard.layout', compact('template', 'config',  'provinces', 'user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateUserRequest $request)
    {
        if ($this->userService->update($id, $request)) {
            return redirect()->route('user.index')->with('success', 'Cập nhật người dùng thành công');
        }
        return redirect()->route('user.index')->with('error', 'Cập nhật người dùng thất bại');
    }

    /**
     * Show the form for confirming deletion of the specified user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function delete($id)
    {
        $user = $this->userRepository->findById($id);
        $config['seo'] = config('apps.user');
        $template = 'backend.user.user.delete';

        return view('backend.dashboard.layout', compact('template', 'config', 'user'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if ($this->userService->destroy($id)) {
            return redirect()->route('user.index')->with('success', 'Xóa người dùng thành công');
        }
        return redirect()->route('user.index')->with('error', 'Xóa người dùng thất bại');
    }

    private function config(){
        return [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'backend/library/location.js',
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/library/finder.js',
                'backend/library/seo.js',
            ]
        ];
    }
}
