<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = [];
    // disabling mass asignment guard, we are doing this as we are specific with the data we are introducing in the DB

    public function profileImage() 
    {
        return ($this->image) ? '/storage/' . $this->image : 'https://st3.depositphotos.com/6672868/13701/v/600/depositphotos_137014128-stock-illustration-user-profile-icon.jpg';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
