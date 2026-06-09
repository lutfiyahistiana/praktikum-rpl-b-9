<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotMessage extends Model
{
    public $timestamps    = false;
    protected $primaryKey = 'id_chatbot_message';
    protected $fillable   = ['session_id', 'role', 'message'];
}