<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Models\Service;
use Illuminate\Http\Response;

class ServiceController extends Controller
{
    public function index()
    {

        // Busca todos os serviços existentes
        $service = Service::all();

        // Retorna todos o serviços da plataforma
        return response()->json([
            'Data' => $service],
            Response::HTTP_OK);
    }

    public function show(int $id)
    {
        // Verifica se o serviço existe persistindo na condicional
        $service = Service::find($id);
        if (! $service) {
            return response()->json([
                'Message' => 'The service is not found'],
                Response::HTTP_NOT_FOUND);
        }

        // Retorna uma resposta
        return response()->json([
            'Data' => $service],
            Response::HTTP_OK);
    }

    public function store(StoreServiceRequest $request)
    {
        // Validação de Entrada
        $dataValidated = $request->validated();

        // Cria um novo serviço persistindo na condicional
        $service = Service::create($dataValidated);
        if (! $service) {
            return response()->json([
                'Message' => 'The service is not create'],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // Retorna uma resposta
        return response()->json([
            'Data' => $service],
            Response::HTTP_CREATED);
    }

    public function update(UpdateServiceRequest $request, int $id)
    {
        // Verifica se o serviço existe persistindo na condicional
        $service = Service::find($id);
        if (! $service) {
            return response()->json([
                'Message' => 'The service is not found'],
                Response::HTTP_NOT_FOUND);
        }

        // Validação de entrada
        $dataValidated = $request->validated();

        // Atualiza o serviço persistindo na condicional
        $update = $service->update($dataValidated);
        if (! $update) {
            return response()->json([
                'Message' => 'Error when updating service'],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // Retorna uma resposta
        return response()->json([
            'data' => $service],
            Response::HTTP_OK);
    }

    public function updateStatus(UpdateStatusRequest $request, $id)
    {

        // Busca o serviço persistindo na condicional
        $service = Service::find($id);
        if (! $service) {
            return response()->json([
                'The service not found'],
                Response::HTTP_NOT_FOUND);
        }
        // Busca o novo status passado no payload
        $newStatus = $request->status;

        $service->status = $newStatus;

        // Salva o novo status do serviço
        if (! $service->save()) {
            return response()->json([
                'Message' => 'Error when saving user'],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // Retorna uma resposta
        return response()->json([
            'Data' => $service],
            Response::HTTP_OK);
    }
}
