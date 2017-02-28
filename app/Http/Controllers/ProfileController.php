<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.profile');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $currentUser = Auth::user();
        $otherUser = User::where('email', $request->input('email'))->first();
        if($otherUser == null || $otherUser->id == $currentUser->id){
            $this->validate($request, [
                'avatar' => 'image|max:1024',
                'name' => 'max:255',
                'email' => 'email',
                'password' => 'min:6|same:password_confirm',
                'password_confirm' => 'same:password',
                'vk_url' => 'regex:/^(http(s)?:\/\/)?(www\.)?vk\.com\/(\w+)+?\/?$/',
            ]);
        }
        else{
            $this->validate($request, [
                'email' => 'unique:users'
            ]);
        }
        if ($request->hasFile('avatar')) {
            File::delete(storage_path().'/app/public/'.$currentUser->avatar);
            $currentUser->avatar = $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->move(storage_path().'/app/public/', $request->file('avatar')->getClientOriginalName());
        }
        $currentUser->name = $request->input('name');
        $currentUser->email = $request->input('email');
        if($request->input('password') != '') $currentUser->email = bcrypt($request->input('password'));
        $currentUser->vk_url = $request->input('vk_url');
        $currentUser->sex = $request->input('sex');
        if($request->input('dob') != null)
            $currentUser->date_of_birth = $request->input('dob');
        
        $currentUser->save();

        return redirect('profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
