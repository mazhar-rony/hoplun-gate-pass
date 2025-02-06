<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Building;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginFrom()
    {
        return view('auth.login');
    }
    public function showRegisterFrom()
    {
        $departments = Department::orderBy('name')->get();
        $designations = Designation::orderBy('name')->get();
        $buildings = Building::orderBy('name')->get();
        $users = User::where('role', '!=', 2)->orderBy('name')->get();

        return view('auth.register', compact('departments', 'designations', 'buildings', 'users'));
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 2 && $user->status === 1) {
                return redirect()->route('admin.dashboard');
            }elseif ($user->role === 1 && $user->status === 1) {
                return redirect()->route('user.dashboard');
            }elseif ($user->role === 3 && $user->status === 1) {
                return redirect()->route('manager.dashboard');
            }
            else{
                return Redirect::back()->with('error', 'Your Account is Deactivate');
            }

        }
        $user = User::where('email', $request->email)->first();

        if ($user) {
            return redirect()->back()->withInput()->withErrors(['password' => 'Incorrect password']);
        } else {
            return redirect()->back()->withInput()->withErrors(['email' => 'Invalid email']);
            }
    }


    public function registerSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
        ]);


        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->department_id = $request->input('department_id');
        $user->designation_id = $request->input('designation_id');
        $user->building_id = $request->input('building_id');
        $user->manager_id = $request->input('manager_id');
        $user->password = bcrypt($request->input('password'));
        // $user->role = 2;
        $user->role = 1;
        $user->status = 1;

        $user->save();

        Auth::login($user);

        return Redirect::route('login')->with('success', 'User successfully registered');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
