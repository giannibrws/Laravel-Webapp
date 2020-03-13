<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
// Include global DB class:
use DB;
use Auth;

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
     *
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
}
