<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contact extends Model
{
    //
    protected $fillable = [
        'email',
        'phone',
        'address',
        'city',
        'profile_id'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
