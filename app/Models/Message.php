<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'sender_id',
        'receiver_id',
    ];

    public function userSend()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function userReceive()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }


}
