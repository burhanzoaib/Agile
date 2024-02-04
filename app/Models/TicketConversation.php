<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketConversation extends Model
{
    protected $fillable=['sender','reciver','msg','file','status','ticket_id','seen'];
    public function user(){
        return $this->hasOne(User::class,'id','sender');
    }
}
