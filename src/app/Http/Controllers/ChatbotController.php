<?php

namespace App\Http\Controllers;

use App\Models\ChatbotSession;
use App\Models\ChatbotMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use LucianoTonet\GroqPHP\Groq;

class ChatbotController extends Controller
{
    private Groq $groq;

    public function __construct()
    {
        $this->groq = new Groq(env('GROQ_API_KEY'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message'    => 'required|string|max:1000',
            'session_id' => 'nullable|integer',
        ]);

        $userId  = Auth::id();
        $session = null;

        // Ambil session yang ada
        if ($request->session_id) {
            $session = ChatbotSession::where('id_chatbot_session', $request->session_id)
                ->where('user_id', $userId)
                ->first();
        }

        // Buat session baru kalau belum ada
        if (!$session) {
            $session = ChatbotSession::create(['user_id' => $userId]);
        }

        // Simpan pesan user ke database
        ChatbotMessage::create([
            'session_id' => $session->id_chatbot_session,
            'role'       => 'user',
            'message'    => $request->message,
        ]);

        // Ambil semua riwayat chat untuk konteks
        $history = ChatbotMessage::where('session_id', $session->id_chatbot_session)
            ->orderBy('id_chatbot_message')
            ->get()
            ->map(fn($m) => [
                'role'    => $m->role,
                'content' => $m->message,
            ])->toArray();

        // Kirim ke Groq
        try {
            $response = $this->groq->chat()->completions()->create([
                'model'    => env('GROQ_MODEL', 'llama-3.3-70b-versatile'),
                'messages' => array_merge(
                    // System prompt — karakter chatbot
                    [[
                        'role'    => 'system',
                        'content' => 'Kamu adalah asisten AI untuk aplikasi Colab, aplikasi manajemen tim kolaboratif. Jawab dalam Bahasa Indonesia dengan ramah dan membantu.',
                    ]],
                    $history
                ),
            ]);

            $reply = $response['choices'][0]['message']['content'] ?? 'Maaf, tidak ada respons.';

        } catch (\Exception $e) {
            Log::error('Groq Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghubungi AI.',
            ], 500);
        }

        // Simpan balasan ke database
        ChatbotMessage::create([
            'session_id' => $session->id_chatbot_session,
            'role'       => 'assistant',
            'message'    => $reply,
        ]);

        return response()->json([
            'success'    => true,
            'reply'      => $reply,
            'session_id' => $session->id_chatbot_session,
        ]);
    }

    public function getHistory()
    {
        $session = ChatbotSession::where('user_id', Auth::id())
            ->latest('id_chatbot_session')
            ->first();

        if (!$session) {
            return response()->json(['messages' => [], 'session_id' => null]);
        }

        $messages = ChatbotMessage::where('session_id', $session->id_chatbot_session)
            ->orderBy('id_chatbot_message')
            ->get(['role', 'message']);

        return response()->json([
            'messages'   => $messages,
            'session_id' => $session->id_chatbot_session,
        ]);
    }
}