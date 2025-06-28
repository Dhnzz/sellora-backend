<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\AdminResource;
use App\Http\Requests\Admin\StoreRequest;
use App\Http\Requests\Admin\UpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        $validatedAdmin = $request->validated();

        $adminStore = DB::transaction(function () use ($validatedAdmin) {
            $user = User::create([
                'email' => $validatedAdmin['email'],
                'password' => Hash::make($validatedAdmin['password']),
            ]);
            $user->assignRole('admin');

            $admin = Admin::create([
                'name' => $validatedAdmin['name'],
                'phone' => $validatedAdmin['phone'],
                'user_id' => $user->id,
            ]);

            return $admin->load('users');
        });
        return new AdminResource($adminStore);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return response()->json(
                [
                    'code' => 404,
                    'status' => false,
                    'message' => 'Resource not found. Data Admin dengan ID ini tidak ditemukan.',
                ],
                404,
            );
        }

        // Jika ditemukan, kembalikan resource seperti biasa
        return new AdminResource($admin->load('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return response()->json(
                [
                    'code' => 404,
                    'status' => false,
                    'message' => 'Resource not found. Data Admin dengan ID ini tidak ditemukan.',
                ],
                404,
            );
        }

        $validatedData = $request->validated();
        DB::transaction(function () use ($validatedData, $admin) {
            $admin->update([
                'name' => $validatedData['name'],
                'phone' => $validatedData['phone'],
            ]);

            $admin->users->update([
                'email' => $validatedData['email'],
            ]);

            if (!empty($validatedData['password'])) {
                $admin->users->update([
                    'password' => Hash::make($validatedData['password']),
                ]);
            }
        });

        return new AdminResource($admin->fresh()->load('users'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return response()->json(
                [
                    'code' => 404,
                    'status' => false,
                    'message' => 'Resource not found. Data Admin dengan ID ini tidak ditemukan.',
                ],
                404,
            );
        }

        DB::transaction(function () use ($admin) {
            $user = $admin->users;

            $admin->delete();

            if ($user) {
                $user->delete();
            }
        });

        return response()->json(
            [
                'message' => 'Admin berhasil dihapus',
            ],
            200,
        );
    }
}
