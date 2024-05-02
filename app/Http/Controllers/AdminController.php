<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    // Método para criação de permissão para usuário
    public function permission(StoreAdminRequest $request)
    {
        $validatedData = $request->validated();
        
        // Encontre o usuário pelo ID
        $user = User::find($validatedData['user_id']);

        // Verifique se o usuário existe
        if (!$user) {
            return response()->json([
                'Message' => 'The user is not found'
            ], Response::HTTP_NOT_FOUND);
        }

        // Verifique se a permissão enviada no payload existe
        $permissionName = $validatedData['permission'];
        if (!Permission::findByName($permissionName)->exists()) {
            return response()->json([
                'message' => 'Permission does not exist'
            ], Response::HTTP_BAD_REQUEST);
        }

        // Atualize o status da permissão do usuário
        $user->givePermissionTo($permissionName);

        // Retorna uma resposta
        return response()->json([
            'message' => 'Permission status updated successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }
}
