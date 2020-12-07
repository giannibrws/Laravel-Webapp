<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Include global DB class:
use DB;
use Auth;
use Mockery\Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // add user authentication:
        if(Auth::check()){
            $users = User::paginate(15);
            return view('home', ['users'=>$users]);
        }
        else{
            return view('auth/login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    // @info: Saves a new user record to the database:
    public function store()
    {
        try{
            if(!filter_var(request('email'), FILTER_VALIDATE_EMAIL)){
                throw new Exception('Error: Invalid email adress - please try again');
            }

            $emailExists = User::where('email','like','%'.request('email').'%') -> first();
            if ($emailExists !== null) {
                throw new Exception('Error: This email has already been taken.');
            }

          } catch (Exception $error){
            return view('createcard')->with('error', $error->getMessage());
        }

        $user = new User();
        $user->email = request('email');
        $user->name = request('name');
        $user->password = "default";

        // Store file:
        $user->save();
        // return to home index action:
        return redirect()->action('UserController@index');

    }

    /**
     * Display the specified resource.
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

    }


    public function edit($id)
    {
        if(Auth::check()) {
            $user = User::find($id);
            // return to home index action:
            return view('editcard')->with('user', $user);
        }
        else{
            return view('auth/login');
        }
    }


    public function update($id)
    {

        // check om welke user het gaat:
        $user = User::find($id);

        try{
            if(!filter_var(request('email'), FILTER_VALIDATE_EMAIL)){
                throw new Exception('Error: Invalid email adress - please try again');
            }
            $emailExists = User::where('email','like','%'.request('email').'%') ->first();
            if ($emailExists !== null && ($user->email !== request('email'))) {
                throw new Exception('Error: This email has already been taken.');
            }

        } catch (Exception $error){
            return view('editcard',['user' => $user, 'error' => $error->getMessage()]);
        }

        // request change of details:
        $user->email = request('email');
        $user->name = request('name');

        // Store file:
        $user->save();
        // return to home index action:
        return redirect()->action('UserController@index');
    }

    // Destroy function ==  Delete function
    public function destroy($id)
    {
        // table('users'), // where clause ('id') (action->delete)
        User::find($id)->delete();
        // return to home index action:
        return redirect()->action('UserController@index');
    }

    public function validateUserInfo($id)
    {

    }
}
