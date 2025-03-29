<?php

namespace App\Http\Controllers\Core;

use App\Facades\Model\RoleModel;
use App\Facades\Model\UserModel;
use App\Http\Requests\Core\LoginRequest;
use App\Http\Requests\Core\UserRequest;
use App\Services\Master\CreateService;
use App\Services\Master\SingleService;
use App\Services\Master\UpdateService;
use Illuminate\Support\Facades\Hash;
use Plugins\Notes;
use Plugins\Response;

class UserController extends MasterController
{
    public function __construct(UserModel $model, SingleService $service)
    {
        $this->model = $model::getModel();
        self::$service = self::$service ?? $service;
        self::$is_core = true;
    }

    protected function beforeForm()
    {
        $roles = RoleModel::getOptions();

        self::$share = [
            'roles' => $roles,
        ];
    }

    public function postCreate(UserRequest $request, CreateService $service)
    {
        $data = $service->save($this->model, $request);

        return Response::redirectBack($data);
    }

    public function postUpdate($code, UserRequest $request, UpdateService $service)
    {
        $data = $service->update($this->model, $request, $code);

        return Response::redirectBack($data);
    }

    public function changePassword()
    {

        if (request()->method() == 'POST') {

            UserModel::find(auth()->user()->id)->update([
                'password' => bcrypt(request()->get('password')),
            ]);

            return redirect()->route('home');
        }

        return view('auth.change_password')->with($this->share());
    }

    public function postLoginApi(LoginRequest $request)
    {
        $user = UserModel::where('username', $request->username)->first();

        if (! Hash::check($request->password, $user->password)) {
            return Notes::error([
                'password' => 'Password Tidak Di temukan',
            ], 'Login Gagal');
        }

        $token = $user->createToken($user->name);
        $string_token = $token->plainTextToken;
        $user->api_token = $string_token;
        $user->save();

        return Notes::token($user->toArray());
    }

    public function getExportJob()
    {
        return moduleView(modulePathForm(path: true), $this->share());
    }

    public function getProfile()
    {
        $this->beforeForm();

        return moduleView(modulePathForm(name: 'form', path: 'core.profile'), $this->share([
            'model' => auth()->user(),
        ]));
    }

    public function updateProfile(UserRequest $request, UpdateService $service)
    {
        $data = $service->update($this->model, $request, auth()->id());

        return Response::redirectBack($data);
    }
}
