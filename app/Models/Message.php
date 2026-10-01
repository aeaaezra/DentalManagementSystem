<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Message extends Model
{
    protected $fillable = [

        'sender_id',
        'receiver_id',
        'message',
        'reply_to',
        'attachment',
        'is_pinned'
    ];

    public function sender()
    {
        return $this->belongsTo(
            User::class,
            'sender_id'
        );
    }

    public function receiver()
    {
        return $this->belongsTo(
            User::class,
            'receiver_id'
        );
    }

    public function repliedMessage()
{
    return $this->belongsTo(
        Message::class,
        'reply_to'
    );
}
    public function reactions()
{
    return $this->hasMany(MessageReaction::class);
}
}

