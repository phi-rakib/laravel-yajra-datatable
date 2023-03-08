<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $users = User::all(['id', 'name', 'email']);

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', 'users.datatables.action-buttons')
                ->make(true);
        }

        return view('users.index');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['success' => 'User Delete Successflly']);
    }

    public function edit(User $user)
    {
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $data = $request->only(['id', 'name', 'email']);
        $data['password'] = Hash::make('123456');

        User::create($data);

        return response()->json(['success' => 'User Saved Successfully']);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->only(['id', 'name', 'email']));

        return response()->json(['success' => 'User Updated Successfully']);
    }
}
