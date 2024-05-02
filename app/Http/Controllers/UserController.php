<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index()
    {
        // Busca todos os usuários
        $users = User::all();

        // Retorna uma resposta
        return response()->json([
            'Date' => $users],
            Response::HTTP_OK);
    }

    public function show(int $id)
    {
        // Verifica se o usuário existe persistindo na condicional
        $user = User::find($id);
        if (! $user) {
            return response()->json([
                'Message' => 'The User is not found'],
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Retorna uma resposta
        return response()->json([
            'Data' => $user],
            Response::HTTP_OK);
    }

    public function store(StoreUserRequest $request)
    {
        // Validação de Entrada
        $data = $request->validated();

        // Cria um novo usuário persistindo na condicional
        $user = User::create($data);
        if (! $user) {
            return response()->json([
                'Message' => 'The User is not create'],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // Retorna uma resposta
        return response()->json([
            'Data' => $user],
            Response::HTTP_CREATED);
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        // Verifica se o usuário existe persistindo na condicional
        $user = User::Find($id);
        if (! $user) {
            return response()->json([
                'Message' => 'The User is not found'],
                Response::HTTP_NOT_FOUND);
        }

        // Validação de entrada e atualização
        $data = $request->validated();
        $response = $user->update($data);
        if (! $response) {
            return response()->json([
                'Error when updating user'],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // Retorna uma resposta
        return response()->json([
            'Data' => $response],
            Response::HTTP_OK);
    }
}
