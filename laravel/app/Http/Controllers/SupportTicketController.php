<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SupportTicketController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'attachment' => 'nullable|image|max:2048',
        ]);

        $path = $request->file('attachment')?->store('support_attachments', 'public');

        SupportTicket::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'attachment' => $path,
        ]);

        return redirect()->back()->with('status', 'Обращение отправлено!');
    }
}
