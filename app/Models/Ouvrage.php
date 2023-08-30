<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ouvrage extends Model
{
    use HasFactory;
    protected $fillable = [
        'artisan_id',
        'image_id',
    ];

    public function artisan()
    {
        return $this->belongsTo(Artisan::class, 'artisan_id');
    }
    
    public function profileImage()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

}
