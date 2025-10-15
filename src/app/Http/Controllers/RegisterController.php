<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(ContactRequest $request)
    {
        $contact = $request->only(['name','email', 'password']);
        return view('auth.register', ['contact' => $contact]);
    }

    public function admin(ContactRequest $request)
    {
        $contact = $request->only(['name','email', 'password']);
        Contact::create($contact);

        return redirect()->route('admin');

    }
}