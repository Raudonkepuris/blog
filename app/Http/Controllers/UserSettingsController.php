<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $user = auth()->user();

        return view('dashboard.user_settings.index', compact('user'));
    }

    public function edit_name(User $user)
    {
        $this->authorize('modify', $user);
        $user = auth()->user();

        return view('dashboard.user_settings.change_name', compact('user'));
    }

    public function update_name(Request $request, User $user){
        $this->authorize('modify', $user);

        $request->validate([
            'name' => 'required|max:80'
        ]);

        $user->update([
            'name'=>$request->name
        ]);

        return redirect()->route('user_settings.index')->with('success', 'Username updated succesfully');
    }

    public function edit_email(User $user)
    {
        $this->authorize('modify', $user);
        $user = auth()->user();

        return view('dashboard.user_settings.change_email', compact('user'));
    }

    public function update_email(Request $request, User $user){
        $this->authorize('modify', $user);

        $request->validate([
            'email' => 'email:rfc,dns'
        ]);

        $user->update([
            'email'=>$request->email
        ]);

        return redirect()->route('user_settings.index')->with('success', 'Email updated succesfully');
    }

    public function edit_psw(User $user)
    {
        $this->authorize('modify', $user);
        $user = auth()->user();

        return view('dashboard.user_settings.change_psw', compact('user'));
    }

    public function update_psw(Request $request, User $user){
        $this->authorize('modify', $user);

        if($request->input('new-psw') != $request->input('new-rpsw')){
            return redirect()->back()->with('error', 'New passwords do not match');
        }

        if(!Hash::check($request->input('curr-psw'),$user->password)){
            return redirect()->back()->with('error', 'Invalid old password');;
        }

        $user->update([
            'password'=>bcrypt($request->input('new-psw'))
        ]);

        return redirect()->route('user_settings.index')->with('success', 'Password updated succesfully');
    }
}
