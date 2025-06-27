<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\AdminResource;
use App\Http\Requests\Admin\StoreRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::with('users')->latest()->paginate(10);
        return AdminResource::collection($admins);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validatedAdmin = $request->validated()

        $adminStore = DB::transaction(function () use ($validatedAdmin) {
            $user = User::create([
                'email' => $validatedAdmin['email'],
                'password' => Hash::make($validatedAdmin['password']),
            ]);
            $user->assignRole('admin');

            $admin = Admin::create([
                'name' => $validatedAdmin['name'],
                'phone' => $validatedAdmin['phone']
            ]);

            return $admin;
        });
        return new AdminResource($adminStore);
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        DB::transaction(function () use ($admin){
            $user = $admin->user;
        });
    }
}
