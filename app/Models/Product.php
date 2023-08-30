<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'user_id', 'category_id', 'is_approve'];

    //un produit est relié a un utilisateur...
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    //ceci peut être néccéssaire pour connaitre le nombre de produit commandé
    public function lineCommands()
    {
        return $this->hasMany(LineCommand::class, 'product_id');
    }


    //ceci peut être néccéssaire pour connaitre les commentaires sur un produit
    public function comments()
    {
        return $this->hasMany(Comment::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'product_id');
    }

}
