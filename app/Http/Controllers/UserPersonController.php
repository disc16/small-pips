<?php

namespace App\Http\Controllers;

use App\Models\UserPerson;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserPerson $userPerson)
    {
        $users = User::with('userPerson', 'roles')->whereHas('roles', function($q) {
            $q->where('name', 'User');
        })->get();

        $userTypes = UserType::with('roles')->whereHas('roles')->get();
        $roles = Role::with('permissions')->get();

        return Inertia::render('Admin/UserSettings', [
            'users' => $users,
            'userTypes' => $userTypes,
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserPerson $userPerson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        

        $user = User::find($request->id);
        $user->name = $request->first_name.' '.$request->last_name;
        $user->email = $request->email;
        $user->save();

        $user->syncRoles(['User', $request->user_type]);

        // Update User Person
        $person = UserPerson::where('user_id', $request->id)->first();
        $person->first_name = $request->first_name;
        $person->last_name = $request->last_name;
        $person->save();

        return Redirect::route('users.show');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserPerson $userPerson)
    {
        //
    }
}
