<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotSession extends Model
{
    protected $table = 'chatbot_sessions';
    public $timestamps  = false;
    protected $primaryKey = 'id_chatbot_session';
    protected $fillable   = ['user_id'];

    public function messages()
    {
        return $this->hasMany(ChatbotMessage::class, 'session_id', 'id_chatbot_session');
    }
}