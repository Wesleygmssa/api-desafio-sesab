<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     *  LISTAGEM COM PAGINAÇÃO (5 POR PÁGINA)
     *  SUPORTA FILTROS POR NOME ,CPF E Período de cadastro;
     */
public function index(Request $request)
{
    $query = User::with(['profile', 'addresses'])
        ->orderBy('id', 'asc');

    if ($request->filled('nome')) {
        $query->where('nome', 'like', '%' . $request->nome . '%');
    }

    if ($request->filled('cpf')) {
        $query->where('cpf','like', '%' . $request->cpf . '%');
    }

    //  FILTRO POR PERÍODO (CORRETO)
    if ($request->filled('data_inicio')) {
        $query->whereDate('created_at', '>=', $request->data_inicio);
    }

    if ($request->filled('data_fim')) {
        $query->whereDate('created_at', '<=', $request->data_fim);
    }

    $users = $query->paginate(8);

    return response()->json($users);
}

    /**
     * CRIAR USUÁRIO (PASSWORD OPCIONAL)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome'        => 'required|string',
            'email'       => 'required|email|unique:users,email',
            'cpf'         => 'required|string|unique:users,cpf',
            'password'    => 'nullable|min:6',
            'profile_id'  => 'required|exists:profiles,id',
            'addresses'   => 'nullable|array',
            'addresses.*' => 'exists:addresses,id',
        ],[
           'email.unique' => 'Já existe um usuário com este e-mail.',
           'cpf.unique'   => 'Já existe um usuário com este CPF.',
           'nome.unique' => 'O campo nome é obrigatório.',
        ]);

        //  password opcional
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user = User::create([
            'nome'       => $data['nome'],
            'email'      => $data['email'],
            'cpf'        => $data['cpf'],
            'password'   => $data['password'] ?? null,
            'profile_id' => $data['profile_id'],
            'session_id' => Str::uuid(),
        ]);
        /**
         * VINCULAR ENDEREÇOS AO USUÁRIO (SE FORNECIDOS)
         *  O MÉTODO SYNC VAI SINCRONIZAR OS ENDEREÇOS ASSOCIADOS AO USUÁRIO, 
         * ADICIONANDO OS NOVOS E REMOVENDO OS QUE NÃO ESTIVEREM NA LISTA FORNECIDA.
         */
        if (!empty($data['addresses'])) {
            $user->addresses()->sync($data['addresses']);
        }

        return response()->json([
            'message' => 'Usuário cadastrado com sucesso',
            'user'    => $user,
        ], 201);
    }

    /**
     *  DETALHE USUÁRIO
     */
    public function show(string $id)
    {
        $user = User::with(['profile', 'addresses'])->find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        return response()->json($user);
    }

    /**
     *  ATUALIZAR USUÁRIO
     */
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
            'addresses'  => 'array',
        ]);

        $user->update($data);

        if (isset($data['addresses'])) {
            $user->addresses()->sync($data['addresses']);
        }

        return response()->json([
            'message' => 'Usuário atualizado com sucesso'
        ]);
    }

    /**
     *  EXCLUIR USUÁRIO
     */
    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Usuário excluído com sucesso'
        ]);
    }
}