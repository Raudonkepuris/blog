<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = User::all();

        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);

        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        if($request->input('psw') != $request->input('rpsw')){
            return redirect()->back()->with('error', 'Passwords do not match');
        }

        $request->validate([
            'email' => 'email:rfc,dns',
            'name' => 'required|max:80'
        ]);

        $user = new User;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        
        $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfully.');
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
    public function edit_name(User $user)
    {
        $this->authorize('modify', $user);

        return view('dashboard.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_name(Request $request, User $user)
    {
        $this->authorize('modify', $user);

        $request->validate([
            'name' => 'required|max:80'
        ]);

        $user->update([
            'name'=>$request->name
        ]);

        return redirect()->route('users.index')->with('success', 'Username updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        DB::table('users')->where('id', $user->id)->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function edit_psw(User $user)
    {
        $this->authorize('modify', $user);

        return view('dashboard.users.psw', compact('user'));
    }

    public function update_psw(Request $request, User $user)
    {
        $this->authorize('modify', $user);

        $user->update([
            'password'=>bcrypt($request->psw)
        ]);

        return redirect()->route('users.index')->with('success', 'Password updated succesfully');
    }
}
