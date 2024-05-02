<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    public function index()
    {
        // Busca todas as reserva existentes de forma paginada
        $booking = Booking::paginate(10);

        // Retorna todas as reservas
        return response()->json([
            'Data' => $booking],
            Response::HTTP_OK);
    }

    public function show(int $id)
    {
        // Valida se a reserva existe persistindo na condicional
        $booking = Booking::find($id);
        if (! $booking) {
            return response()->json([
                'Message' => 'The booking is not found'],
                Response::HTTP_NOT_FOUND);
        }

        // Retorna uma resposta
        return response()->json([
            'Data' => $booking],
            Response::HTTP_OK);
    }

    public function store(StoreBookingRequest $request)
    {

        // Validação de Entrada
        $dataValidated = $request->validated();

        // Cria uma nova reserva persistindo na condicional
        $booking = Booking::create($dataValidated);

        if (! $booking) {
            return response()->json([
                'Message' => 'The booking is not create'],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // Retorna uma resposta
        return response()->json([
            'Data' => $booking],
            Response::HTTP_OK);
    }

    public function update(UpdateBookingRequest $request, int $id)
    {
        // Valida se a reserva existe persistindo na condicional
        $booking = Booking::find($id);
        if (! $booking) {
            return response()->json([
                'Message' => 'The booking is not found'],
                Response::HTTP_NOT_FOUND);
        }

        // Validação de Entrada
        $dataValidated = $request->validated();

        // Atualiza uma reserva persistindo na condicional
        $update = $booking->update($dataValidated);
        if (! $update) {
            return response()->json([
                'Message' => 'Error when updating user'],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // Retorna uma resposta
        return response()->json([
            'Data' => $booking],
            Response::HTTP_OK);
    }
}
