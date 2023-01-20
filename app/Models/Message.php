<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable=[
        'sender_id',
        'receiver_id',
        'conversation_id',
        'read',
        'type',
        'body',
    ];
    public function conversation(){
        $this->belongsTo(Conversation::class);
    }
    
    public function user(){
        $this->belongsTo(User::class,'sender_id');
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($this->attributes['created_at'])->shortAbsoluteDiffForHumans();
    }
}
