<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
{
    $user = auth()->user();

    $user->load([
        'role',
        'employee',
        'employee.department',
        'employee.position',
    ]);

    return view('profile.index', compact('user'));
}

    public function update(UpdateProfileRequest $request)
{
    $user = auth()->user();

    if ($user->role->name !== 'employee') {
        abort(403);
    }

    $data = $request->validated();

    if ($request->hasFile('photo')) {

        $photoPath = $request->file('photo')
            ->store('employees', 'public');

        $user->employee->update([
            'photo' => $photoPath,
        ]);
    }

    return redirect()
        ->route('profile')
        ->with('success', 'Profile photo updated successfully.');
}
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = auth()->user();
        
        $user->update([
            'password' => Hash::make($request->password),
            ]);
            
            return redirect()
            ->route('profile')
            ->with('success', 'Password updated successfully.');
    }
 }