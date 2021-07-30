<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('users.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validate = $request->validate([
           'name'   =>      'required',
           'email'   =>      'required',
           'password' => 'required|confirmed|min:8'
          
       ]);

       if ($validate) {
           $user = User::create([
               'name'   => $request->name,
               'email'   => $request->email,
               'password'   => \Hash::make($request->password),
               'is_admin'   => $request->isadmin
           ]);
           return redirect()->route('users.index')->with(['usersuccess' =>  "Add New User Successfully"]);
       }else {
        return redirect()->route('users.index')->with(['usererror' =>  "error"]);
       }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit',compact('user'));
        // dd($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name'   =>      'required',
            'email'   =>      'required'
        ]);
 
        if ($validate) {
            
            $user = User::find($id);
                
            $user->name   = $request->name;
            $user->email   = $request->email;
            $user->is_admin    = $request->isadmin;
            $user->save();
              
            return redirect()->route('users.index')->with(['updatesuccess' =>  "Update User Successfully"]);
        }
        else {
            return redirect()->route('users.index')->with(['updateerror' =>  "error"]);
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $deleteUser = $user->delete();
        if ($deleteUser) {
            return redirect()->route('users.index')->with(['deletesuccess' =>  "Delete User Successfully"]);
        }
        else {
            return redirect()->route('users.index')->with(['deleterror' =>  "error"]);
        }

    }
}
