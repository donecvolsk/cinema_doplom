<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketsController extends Controller {
    public function store(Request $request) {
        $ticket = new Ticket([
            'session_id' => $request->input('session_id'),
            'row' => $request->input('row'),
            'seat' => $request->input('seat'),
            'type' => $request->input('type')
        ]);
        $ticket->save();
        
        // Генерация QR-кода
        //$qrCode = QrCode::generate($ticket->id); // Используйте подходящий пакет для генерации QR-кодов
        //$ticket->update(['qr_code' => $qrCode]);
        
        return response()->json($ticket->id);
    }
}
