<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
  public function index()
{
    // return response()->json([ //
    //     'ok' => true // chamada de teste para verificar se a rota está funcionando corretamente
    // ]);

    $addresses = Address::all(); // Recupera todos os endereços do banco de dados
    return response()->json($addresses); // Retorna os endereços em formato JSON
}
  public function store(Request $request)
        {
            $data = $request->validate([
                'logradouro' => 'required|string|max:255',
                'numero' => 'nullable|string|max:20',
                'complemento' => 'nullable|string|max:255',
                'bairro' => 'required|string|max:255',
                'cidade' => 'required|string|max:255',
                'estado' => 'required|string|size:2',
                'cep' => 'required|string|size:9'
            ]);

            $address = Address::create($data);

            // vincula ao usuário logado
            $request->user()->addresses()->attach($address->id);

            return response()->json($address, 201);
        }

    public function show(string $id)
    {
        $address = Address::findOrFail($id);
        return response()->json($address);
    }

    public function update(Request $request, string $id)
    {
        $address = Address::findOrFail($id);

        $data = $request->validate([
            'logradouro' => 'required|string',
            'cep' => 'required|string'
        ]);

        $address->update($data);

        return response()->json($address);
    }

    public function destroy(string $id)
    {
        $address = Address::findOrFail($id);
        $address->delete();

        return response()->json(['message' => 'Endereço excluído com sucesso']);
    }
}