<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\SeatType;
use App\Models\SessionSeat;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SessionsController extends Controller
{
    public function index(Request $request)
    {
        // Проверяем наличие параметра 'date'
        if ($request->has('date')) {
            $date = $request->input('date');
            // Парсим дату и проверяем валидность
            try {
                $parsed_date = Carbon::parse($date)->format('Y-m-d'); // Преобразуем в формат Y-m-d
                $sessions = Session::with('cinemaHall')->whereDate('start_time', $parsed_date)->get(); // Загружаем данные о зале
            } catch (\Exception $e) {
                // Если произошла ошибка при разборе даты, возвращаем пустой массив
                $sessions = [];
            }
        } else {
            // Если дата не была передана, возвращаем все сессии с залами
            $sessions = Session::with('cinemaHall')->get();
        }
        return response()->json($sessions);
    }

    // Новый метод для получения одной сессии по её ID
    public function show($sessionId)
    {
        // Находим сессию по её ID и загружаем данные о зале
        $session = Session::with('cinemaHall')->findOrFail($sessionId);
        return response()->json($session);
    }

    // Новый метод для получения всех мест в зале для конкретной сессии
    public function getHallSeats($sessionId)
    {
        // Находим сессию по её ID и загружаем данные о местах в зале
        $session = Session::with('cinemaHall.seats')->findOrFail($sessionId);
        // Получаем все места в зале
        $hallSeats = $session->cinemaHall->seats;
        return response()->json($hallSeats);
    }

    // Добавляем новый метод для получения данных из таблицы seat_types по seat_type_id
    public function getSeatTypesById(Request $request)
    {
        // Проверка наличия параметра seat_type_id в запросе
        if (!$request->has('seat_type_id')) {
            return response()->json(['error' => 'Параметр seat_type_id не передан'], 400);
        }
        // Извлекаем значение seat_type_id из запроса
        $seatTypeId = $request->input('seat_type_id');
        // Находим запись в таблице seat_types по заданному seat_type_id
        $seatType = SeatType::find($seatTypeId);
        // Проверка существования записи
        if (!$seatType) {
            return response()->json(['error' => 'Тип кресла с указанным id не найден'], 404);
        }
        // Возвращаем данные в формате JSON
        return response()->json($seatType);
    }
    
    public function getSessionSeatsBySessionId(Request $request)
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

}