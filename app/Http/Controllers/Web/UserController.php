<?php

namespace App\Http\Controllers\Web;

use App\Helpers\UserActivity;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('admin-panel.pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-panel.pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name'      => 'required',
            'level'     => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8|confirmed',
        ];

        $messages = [
            'name.required'     => 'Nama user wajib diisi',
            'level.required'    => 'Level user wajib diisi',
            'email.required'    => 'Email user wajib diisi',
            'email.email'       => 'Email user harus berformat email',
            'email.unique'      => 'Email user sudah terpakai',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $data = $request->all();

        if($request->has('avatar')) {
            $image = $request->file('avatar');
            $filename = time(). '.jpg';
            $upload_filepath = 'public/users';
            $path = $image->storeAs($upload_filepath, $filename);
            unset($data['image']);
            $data['image'] = Storage::url($path);
        } else {
            $data['image'] = 'default.png';
        }

        $user = User::create($data);
        UserActivity::addToLog('Menambahkan user baru : ' + $user->name);

        return redirect()->route('admin-panel.user.index')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin-panel.pages.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin-panel.pages.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name'      => 'required',
            'level'     => 'required',
            'email'     => 'required|email|unique:users,email,'.$user->id.'id',
            'password'  => 'required|min:8|confirmed',
        ];

        $messages = [
            'name.required'     => 'Nama user wajib diisi',
            'level.required'    => 'Level user wajib diisi',
            'email.required'    => 'Email user wajib diisi',
            'email.email'       => 'Email user harus berformat email',
            'email.unique'      => 'Email user sudah terpakai',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $data = $request->all();

        if($request->has('avatar')) {
            $image = $request->file('avatar');
            $filename = time(). '.jpg';
            $upload_filepath = 'public/users';
            $path = $image->storeAs($upload_filepath, $filename);
            unset($data['image']);
            $data['image'] = Storage::url($path);
        } else {
            $data['image'] = 'default.png';
        }

        $user->update($data);
        UserActivity::addToLog('Mengupdate data user : ' + $user->name);

        return redirect()->route('admin-panel.user.index')->with('success', 'User berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        UserActivity::addToLog('Menghapus user ' + $user->name);
        Storage::delete($user->avatar);
        $user->delete();
        
        return back()->with('success', 'User berhasil dihapus');
    }
}
