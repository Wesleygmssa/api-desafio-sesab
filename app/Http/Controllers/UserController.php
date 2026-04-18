<?php

namespace App\Http\Controllers;


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash; // ✅ AQUI


class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with(['profile', 'addresses']);

        if ($request->filled('nome')) {
            $query->where('nome', 'like', "%{$request->nome}%");
        }

        if ($request->filled('cpf')) {
            $query->where('cpf', $request->cpf);
        }

        return response()->json($query->get());
    }

 
public function store(Request $request)
    {
        $data = $request->validate([
            'nome'        => 'required|string',
            'email'       => 'required|email|unique:users,email',
            'cpf'         => 'required|string|unique:users,cpf',
            'password'    => 'nullable|min:6', // ✅ NÃO obrigatória
            'profile_id'  => 'required|exists:profiles,id',
            'addresses'   => 'nullable|array',
            'addresses.*' => 'exists:addresses,id',
        ]);

        // ✅ só cria a senha se ela foi enviada
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // 🔥 evita salvar null
        }

        $user = User::create([
            'nome'       => $data['nome'],
            'email'      => $data['email'],
            'cpf'        => $data['cpf'],
            'password'   => $data['password'] ?? null, // ✅ opcional
            'profile_id' => $data['profile_id'],
            'session_id' => Str::uuid(),
        ]);

        if (!empty($data['addresses'])) {
            $user->addresses()->sync($data['addresses']);
        }

        return response()->json([
            'message' => 'Usuário cadastrado com sucesso',
            'user'    => $user,
        ], 201);
    }


    public function show(string $id)
    {
        $user = User::with(['profile', 'addresses'])->find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        return response()->json($user);
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        $data = $request->validate([
            'nome'       => 'string',
            'email'      => 'email',
            'cpf'        => 'string',
            'profile_id' => 'exists:profiles,id',
            'addresses'  => 'array'
        ]);

        $user->update($data);

        if (isset($data['addresses'])) {
            $user->addresses()->sync($data['addresses']);
        }

        return response()->json(['message' => 'Usuário atualizado com sucesso']);
    }

    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();

        return response()->json(['message' => 'Usuário excluído com sucesso']);
    }
}
