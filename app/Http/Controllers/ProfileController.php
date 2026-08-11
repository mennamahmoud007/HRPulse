<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
   
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = auth()->user();

        $user->load([
            'employee.department',
            'employee.position',
        ]);

        return view('profile.index', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request)
    {
         $data = $request->validated();

        $user = auth()->user();

        DB::transaction(function () use ($user, $data, $request) {

            // Update employee information
            $user->employee->update([
                'phone' => $data['phone'] ?? null,
                'address' => $data['address'] ?? null,
            ]);

            // Update photo if a new one was uploaded
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')
                    ->store('employees', 'public');

                $user->employee->update([
                    'photo' => $photoPath,
                ]);
            }
        });
        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

}
