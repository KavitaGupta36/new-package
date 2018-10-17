<?php

namespace Chat\Message;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Chat\Message\Models\Message;
use App\Events\NewMessage;
use Pusher\Laravel\Facades\Pusher;

class ChatController extends Controller
{
    
    public function get()
    {
        try {
            // get all users except the authenticated one
            $contacts = User::where('id', '!=', auth()->id())->get();
            // get a collection of items where sender_id is the user who sent us a message
            // and messages_count is the number of unread messages we have from him
            $unreadIds = Message::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
                ->where('to', auth()->id())
                ->where('read', false)
                ->groupBy('from')
                ->get();

            // add an unread key to each contact with the count of unread messages
            $contacts = $contacts->map(function($contact) use ($unreadIds) {
                $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();
                $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
                return $contact;
            });
            return response()->json($contacts);   
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function getMessagesFor($id)
    {
        // mark all messages with the selected contact as read
        Message::where('from', $id)->where('to', auth()->id())->update(['read' => true]);

        // get all messages between the authenticated user and the selected user
        $messages = Message::where(function($q) use ($id) {
            $q->where('from', auth()->id());
            $q->where('to', $id);
        })->orWhere(function($q) use ($id) {
            $q->where('from', $id);
            $q->where('to', auth()->id());
        })
        ->get();

        return response()->json($messages);
    }

    public function send(Request $request)
    {
        try {
            if($request->all()){
                $message = Message::create([
                    'from' => auth()->id(),
                    'to' => $request->contact_id,
                    'text' => $request->text
                ]);

                broadcast(new NewMessage($message));
                return response()->json($message);
            }else{
                return response()->json('message','No Data Found');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}

