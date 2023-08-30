<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'cover_image_id',
    ];

    //une catégorie a une image de profile
    public function imageCover()
    {
        return $this->belongsTo(Image::class, 'cover_image_id');
    }

    //récupérer toutes les produits appartenant à une catégorie...
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

}
