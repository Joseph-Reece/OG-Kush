<?php

namespace App\Http\Controllers\Admin;


use App\Commons\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function list()
    {
        $users = User::query()
            ->orderBy('id', 'desc')
            ->get();


        return view('admin.user.user_list', [
            'users' => $users
        ]);
    }

    public function business_list()
    {
        $users = DB::table('users')
           ->whereExists(function ($query) {
               $query->select(DB::raw(1))
                     ->from('places')
                     ->whereColumn('places.user_id', 'users.id');
           })
           ->get();
        //    dd($users);



        return view('admin.user.business_user', [
            'users' => $users
        ]);
    }

    public function loginPage()
    {
        if (Auth::check())
            return redirect(route('admin_dashboard'));

        return view('admin.user.admin_login');
    }

    public function updateStatus(Request $request)
    {
        $data = $this->validate($request, [
            'status' => 'required',
        ]);

        $model = User::find($request->user_id);
        $model->fill($data);

        if ($model->save()) {
            return $this->response->formatResponse(200, $model, 'Update user status success!');
        }
    }

    public function updateRole(Request $request)
    {
        $data = $this->validate($request, [
            'is_admin' => 'required',
        ]);

        $model = User::find($request->user_id);
        $model->fill($data);

        if ($model->save()) {
            return $this->response->formatResponse(200, $model, 'Update role admin success!');
        }
    }
}
