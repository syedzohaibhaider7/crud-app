<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    // public function rules()
    // {
    //     return [
    //         'name' => 'required|alpha|max:50|unique:users',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6|max:12',
    //         'age' => 'required|numeric|min:1|max:150',
    //         'gender' => 'required',
    //         'image' => 'required|mimes:jpg,png,jpeg,gif,svg'
    //     ];
    // }

    public function rules()
    {
        return ['name' => 'required|max:50']
            +
            ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store()
    {
        return [
            'name' => 'required|alpha|max:50|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:12',
            'age' => 'required|numeric|min:1|max:150',
            'gender' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,gif,svg'
        ];
    }

    protected function update()
    {
        return [
            'name' => 'required|alpha|max:50|unique:users,name,' . $this->user()->id,
            'email' => 'required|email|unique:users,email,' . $this->user()->id,
            'password' => 'required|min:6|max:12',
            'age' => 'required|min:1|max:150',
            'gender' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,gif,svg'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'name.alpha' => 'Only alphabets are allowed.',
            'name.unique' => 'This name is already taken.',
            'name.max' => 'Name must be at most 50 characters long.',
            'email.required' => 'Email is required.',
            'email.email' => 'Enter valid email.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters long.',
            'password.max' => 'Password must be at most 12 characters long.',
            'age.required' => 'Age is required.',
            'age.min' => 'Enter valid age.',
            'age.max' => 'Enter valid age.',
            'gender.required' => 'Gender is required.',
            'image.required' => 'Image is required.',
            'image.mimes' => 'Upload valid image.'
        ];
    }
}
