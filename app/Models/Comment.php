<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'user_id',
        'product_id',
    ];

    //un commentaire a un utilisateur...
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
