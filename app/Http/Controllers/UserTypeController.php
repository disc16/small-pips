<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class UserTypeController extends Controller
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
    public function show(UserType $userType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserType $userType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserType $userType)
    {
        // \Log::info('user-type.update '. (string)$request);

        // Save pricing to user type
        $type = UserType::find($request->id);
        $type->pricing = $request->pricing;
        $type->save();

        // Get roles then assign or revoke permission
        $role = Role::where('name', $request->user_type)->first();
        $permissions = ['access-trade-entries', 'access-trade-performance'];

        if($request->journalMultipleAccounts)
        {
            array_push($permissions, 'journal-multiple-accounts');
        }

        if($request->accessMarketData)
        {
            array_push($permissions, 'access-market-data');
        }

        if(count($permissions) > 0)
        {
            $role->syncPermissions($permissions);
        }
        
        return Redirect::route('users.show');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserType $userType)
    {
        //
    }
}
