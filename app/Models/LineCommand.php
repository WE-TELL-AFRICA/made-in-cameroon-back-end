<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineCommand extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'command_id',
    ];

    //une ligne est relié a une commande ...
    public function command()
    {
        return $this->belongsTo(Command::class, 'command_id');
    }
    
    //une ligne est relié a un produit ...
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}


