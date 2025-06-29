<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSendedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateChatRequest;
use App\Http\Requests\SendMessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    public function create(CreateChatRequest $request)
    {
        if (auth()->user()->role == 'user') {
            $chat = Chat::where('user_id', auth()->user()->id)->where('tourGuide_id', $request->tourGuide_id)->first();
            if ($chat) {
                return response()->json([ 'chat'=>[
                'id'=>$chat->id,
                'uuid'=>$chat->uuid,
            ], 'messages' => MessageResource::collection($chat->messages)], 200);
            }
        } else {
            $chat = Chat::where('user_id', $request->tourGuide_id)->where('tourGuide_id', auth()->user()->id)->first();
            if ($chat) {
                return response()->json([ 'chat'=>[
                'id'=>$chat->id,
                'uuid'=>$chat->uuid,
            ], 'messages' => MessageResource::collection($chat->messages)], 200);
            }
        }

        $chat = Chat::create([
            'user_id' => auth()->user()->id,
            'tourGuide_id' => $request->tourGuide_id,
            'uuid' => (string) Str::uuid(),
        ]);
        return response()->json([
            'message' => 'chat created successfully',
            'chat' => [
                'id'=>$chat->id,
               'uuid'=> $chat->uuid]
        ], 200);
    }
    public function chat($uuid)
    {
        $chat = Chat::where('uuid', $uuid)->first();
        if (!$chat) {
            abort(404);
        }
        return response()->json([
            'chat'=>[
                'id'=>$chat->id,
                'uuid'=>$chat->uuid,
            ],
            'messages' => MessageResource::collection($chat->messages)], 200);
    }
    public function sendMessage(SendMessageRequest $request)
    {
        $chat = Chat::where('uuid', $request->uuid)->first();
        Gate::authorize('ChatOwners', $chat);
        $message = Message::create([
            'chat_id' => $chat->id,
            'sender' => auth()->user()->role == 'user' ? 'user' : 'tourGide',
            'message' => $request->message
        ]);
              event(new MessageSendedEvent($message));
        return response()->json(['message' => 'message sended successfully'], 201);
    }
}
