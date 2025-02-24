<?php

namespace App\Http\Controllers;

use App\Models\SessionSeat;
use Illuminate\Http\Request;

class SessionSeatController extends Controller
{

    public function index()
    {
        // Получение всех записей из таблицы session_seats
        $sessionSeats = SessionSeat::all();

        return response()->json($sessionSeats);
    }

    public function getSessionSeatsIs_booked(Request $request)
    {
        // Проверка наличия параметра session_id в запросе
        if (!$request->has('session_id')) {
            return response()->json(['error' => 'Параметр session_id не передан'], 400);
        }
        // Извлекаем значение session_id из запроса
        $sessionId = $request->input('session_id');
        // Находим все записи в таблице session_seats по заданному session_id
        $sessionSeats = SessionSeat::where('session_id', $sessionId)->get();
        // Проверка существования записей
        if ($sessionSeats->isEmpty()) {
            return response()->json(['error' => 'Данные по указанному session_id не найдены'], 404);
        }
        // Возвращаем данные в формате JSON
        return response()->json($sessionSeats);
    }


    public function store(Request $request)
    {
        // Валидируем входные данные
        $validatedData = $request->validate([
            'session_id' => 'required|integer',
            'hall_seat_id' => 'required|integer',
            'is_booked' => 'required|boolean',
        ]);

        // Создаем новую запись в таблице session_seats
        $sessionSeat = SessionSeat::create($validatedData);

        return response()->json($sessionSeat, 201);
    }


    public function show(SessionSeat $sessionSeat)
    {
        return response()->json($sessionSeat);
    }


    public function update(Request $request, SessionSeat $sessionSeat)
    {
        // Валидируем входные данные
        $validatedData = $request->validate([
            'session_id' => 'sometimes|integer',
            'hall_seat_id' => 'sometimes|integer',
            'is_booked' => 'sometimes|boolean',
        ]);

        // Обновляем запись в таблице session_seats
        $sessionSeat->update($validatedData);

        return response()->json($sessionSeat);
    }


    public function destroy(SessionSeat $sessionSeat)
    {
        // Удаляем запись из таблицы session_seats
        $sessionSeat->delete();

        return response()->json(null, 204);
    }
}