<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new CustomerResource::collection(Customer::with('user')->latest()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string',
            'credit_limit' => 'required|numeric',
            'payment_term' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $customerPerson = DB::transaction(function () use ($validated){
            $role = Role::where('name', 'Customer')->first();
            $user = User::create([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role_id' => $role->id,
            ]);
            $customer = Customer::create([
                'name' => $validated['name'],
                'address' => $validated['address'],
                'phone' => $validated['phone'],
                'user_id' => $user->id,
                'credit_limit' => $validated['credit_limit'],
                'payment_term' => $validated['payment_term'],
            ]);
        });

        return response()->json('KONTOL', );

    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer->load('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string',
            'credit_limit' => 'required|numeric',
            'payment_term' => 'required|numeric',

            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $customerPerson = DB::transaction(function () use ($validated) {
            $user = User::update([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]);

            $customer->update([
                'name' => $validated['name'],
                'address' => $validated['address'],
                'phone' => $validated['phone'],
                'credit_limit' => $validated['credit_limit'],
                'payment_term' => $validated['payment_term'],
            ]);

            return $customer->load('users');
        });

        return new CustomerResource($customerPerson);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
