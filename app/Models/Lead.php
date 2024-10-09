<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'photo',
        'phone',
        'headline',
        'address',
        'url',
    ];
     /**
     * Add user.
     *
     * 
     */
    public function user()
        {
            return $this->belongsTo(User::class);
        }

}
