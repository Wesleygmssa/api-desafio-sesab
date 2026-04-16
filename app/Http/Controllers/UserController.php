<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;

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

        if ($request->filled('inicio') && $request->filled('fim')) {
            $query->whereBetween('created_at', [$request->inicio, $request->fim]);
        }

        return response()->json($query->get());
    }
public function store(Request $request)
{
    $messages = [
        // required
        'nome.required' => 'O nome é obrigatório.',
        'email.required' => 'O e-mail é obrigatório.',
        'cpf.required' => 'O CPF é obrigatório.',
        'profile_id.required' => 'O perfil é obrigatório.',

        // formato
        'email.email' => 'Informe um e-mail válido.',

        // unique
        'email.unique' => 'Este e-mail já está cadastrado.',
        'cpf.unique'   => 'Este CPF já está cadastrado.',

        // exists
        'profile_id.exists' => 'O perfil informado não existe.',
        'addresses.*.exists' => 'Um ou mais endereços são inválidos.',

        // tipos
        'nome.string' => 'O nome deve ser um texto.',
        'cpf.string' => 'O CPF deve ser um texto.',
        'addresses.array' => 'Os endereços devem ser uma lista.',
    ];

    $data = $request->validate([
        'nome' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'cpf' => 'required|string|unique:users,cpf',
        'profile_id' => 'required|exists:profiles,id',
        'addresses' => 'nullable|array',
        'addresses.*' => 'exists:addresses,id',
    ], $messages);

    $user = User::create([
        ...$data,
        'session_id' => $data['session_id'] ?? Str::uuid(),
    ]);

    if (!empty($data['addresses'])) {
        $user->addresses()->sync($data['addresses']);
    }

    return response()->json([
        'message' => 'Usuário cadastrado com sucesso!',
        'user' => $user
    ], 201);
}

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'nome' => 'required|string',
    //         'email' => 'required|email', // removido unique
    //         'cpf' => 'required|string',  // removido unique
    //         'profile_id' => 'required|exists:profiles,id',
    //         'addresses' => 'array'
    //     ]);

    //     $user = User::create($data);

    //     if (!empty($data['addresses'])) {
    //         $user->addresses()->attach($data['addresses']);
    //     }

    //     // Retorna todos os usuários após cadastro
    //     return response()->json([
    //         'message' => 'Usuário cadastrado com sucesso!',
    //         'user' => $user->load('profile', 'addresses'),
    //         'all_users' => User::with(['profile', 'addresses'])->get()
    //     ], 201);
    // }

   public function show(string $id)
{
    $user = User::with(['profile', 'addresses'])->find($id);

    if (!$user) {
        return response()->json([
            'message' => "Usuário com ID {$id} não encontrado."
        ], 404);
    }

    return response()->json($user);
}

    public function update(Request $request, string $id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json([
            'message' => "Usuário com ID {$id} não encontrado."
        ], 404);
    }

    $data = $request->validate([
        'nome' => 'string',
        'email' => 'email', // sem unique se quiser permitir duplicados
        'cpf' => 'string',  // sem unique se quiser permitir duplicados
        'profile_id' => 'exists:profiles,id',
        'addresses' => 'array'
    ]);

    $user->update($data);

    if (isset($data['addresses'])) {
        $user->addresses()->sync($data['addresses']);
    }

    return response()->json([
        'message' => 'Usuário atualizado com sucesso!'
    ]);
}

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Usuário excluído com sucesso']);
    }
}