<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registration.create');
    }

    public function store(RegistrationRequest $request)
    {
//        Validate the form
        $request->persist();
        session()->flash('message', 'Thanks so much for registering');


        return redirect()->home();
    }
}
