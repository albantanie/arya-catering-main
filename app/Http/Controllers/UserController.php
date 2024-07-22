<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function assignRole(Request $request, User $user, Role $role)
    {
        $user->assignRole($role);

        return redirect()->back()->with('success', 'Role assigned successfully.');
    }
}
