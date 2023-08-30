<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    use HasFactory;

    //une commande possède plusieurs ligne de commande...
    public function lineCommands()
    {
        return $this->hasMany(LineCommand::class, 'command_id');
    }

}
