<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        return view('profiles.index', [
            'user' => $user,
        ]);
    }

    public function edit(User $user) {

        $this->authorize('update', $user->profile);
        // this protects and requires authorization for editing profiles. via the ProfilePolicy.php

        return view('profiles.edit', compact('user'));
        // Simpler way to return user as in the index function, same thing.
    }

    public function update(User $user) {

        $this->authorize('update', $user->profile);
        
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        if (request('image')) {

            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save(); 

            $imageArray = ['image' => $imagePath ];
        }

        //TODO: aici da eroare daca adaug AUTH:: sau auth()->. 
        $user->profile->update(array_merge(
            $data,
            $imageArray ?? []
            
        )); 

        return redirect("/profile/{$user->id}");
    }
    
}
