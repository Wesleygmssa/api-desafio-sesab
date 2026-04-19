<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {

        // return response()->json([ //
        //     'ok' => true // chamada de teste para verificar se a rota está funcionando corretamente
        // ]);
        return response()->json(Profile::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string'
        ]);

        $profile = Profile::create($data);

        return response()->json($profile, 201);
    }

    public function show(string $id)
    {
        $profile = Profile::findOrFail($id);
        return response()->json($profile);
    }

    public function update(Request $request, string $id)
    {
        $profile = Profile::findOrFail($id);

        $data = $request->validate([
            'nome' => 'required|string'
        ]);

        $profile->update($data);

        return response()->json($profile);
    }

    public function destroy(string $id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return response()->json(['message' => 'Perfil excluído com sucesso']);
    }
}