<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
   
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('profile.index', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('profile.index', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }

}
