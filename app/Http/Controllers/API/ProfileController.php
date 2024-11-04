<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = Profile::all()->map(function ($profile) {
            if ($profile->photo) {
                $profile->photo = asset('storage/' . $profile->photo);
            }
            return $profile;
        });
        return response()->json($profiles, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'names' => 'required|string',
            'last_name' => 'required|string',
            'birthdate' => 'required|date',
            'gender' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'user_id' => 'required|exists:users,id', 
        ]);
        if($request->hasFile('photo')){
            $photoPath = $request->file('photo')->store('profiles', 'public');
            $validatedData['photo'] = $photoPath;
        }
        $validatedData['qualifications'] = null; 
        $validatedData['status'] = false;
        $profile = Profile::create($validatedData);
        return response()->json($profile, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $profile = Profile::find($id);
        if ($profile) {
            return response()->json($profile, 200);
        } else {
            return response()->json(['message' => 'Profile not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profile = Profile::find($id);
        if ($profile) {
            $validatedData = $request->validate([
                'names' => 'string',
                'last_name' => 'string',
                'birthdate' => 'date',
                'gender' => 'string',
                'photo' => 'string|nullable',
                'user_id' => 'exists:users,id',
                ]);
            $profile->update($validatedData);
            return response()->json($profile, 200);
        } else {
            return response()->json(['message' => 'Profile not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profile = Profile::find($id);
        if ($profile) {
            $profile->delete();
            return response()->json(['message' => 'Profile deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Profile not found'], 404);
        }
    }
}
