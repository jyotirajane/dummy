<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use softdeletes;
class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('users');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list(Request $request)
    {
    	$users = User::where('user_type','user')->get();
        return view('users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Add User';
        $data['breadcrumbs'] = array('addUser',$data['pageTitle']);
        
        return view('createUser', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $randomPassword = str_random(10);
        $user = new User;
        $rules =  [
            'email' => 'required|email|unique:users,email,NULL,"id",deleted_at,NULL',
        ];

        $result = Validator::make(Input::all(), $rules);
        if ($result->fails()) {
            return \Redirect::back()->withErrors($result)->withInput();
        }
        
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->mobile = $request->get('mobile');
        $user->password = bcrypt($request->get('password'));
        $user->user_type = 'user';
        $user->save();


        \Session::flash('status', "User Created.");
        \Session::flash('alert-class', 'alert-success');
        return redirect('users');
    }

    public function loadUsersJSON(Request $request)
    {
        return datatables()->of(Users::where('user_type','user')->get())->toArray();
    }

}
