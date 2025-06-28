<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('edit-admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $adminId = $this->route('id'); // Ambil ID admin dari route parameter {id}

        // Jika ada admin ID, ambil user_id dari admin
        $userId = null;
        if ($adminId) {
            $admin = \App\Models\Admin::find($adminId);
            if ($admin) {
                $userId = $admin->user_id;
            }
        }

        return [
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId, 'id')],
            'password' => 'nullable|string|min:6',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ];
    }
}
