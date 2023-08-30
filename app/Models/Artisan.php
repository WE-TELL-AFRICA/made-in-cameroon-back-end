<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artisan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'labour',
        'city',
        'email',
        'description',
        'phone_number',
        'rating',
        'profile_image_id',
    ];

    //un artisan a beaucoup ouvrages
    public function ouvrages()
    {
        return $this->hasMany(Ouvrage::class, 'artisan_id');
    }

    //un artisan possède un image de profile
    public function profileImage(){
        return $this->belongsTo(Image::class, 'profile_image_id');
    }

}
