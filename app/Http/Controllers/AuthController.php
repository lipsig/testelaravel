<?php
// Início do arquivo PHP

namespace App\Http\Controllers;
// Define o namespace para o controlador

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail; 
use App\Models\User;
use App\Mail\RegistrationSuccessEmail; 
use Tymon\JWTAuth\Facades\JWTAuth;
// Importa as classes necessárias

class AuthController extends Controller
// Define a classe AuthController que estende a classe Controller
{
    public function register(Request $request)
    // Define a função de registro que aceita um objeto Request como parâmetro
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
        ];
        // Define as regras de validação para os dados do usuário

        $messages = [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.regex' => 'The password must be at least 8 characters and contain at least one uppercase letter, one lowercase letter, and one number.',
        ];
        // Define as mensagens de erro personalizadas para as regras de validação

        $validator = Validator::make($request->all(), $rules, $messages);
        // Cria um validador com os dados do request, as regras e as mensagens

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // Se a validação falhar, retorna um erro 400 com as mensagens de erro

        $validatedData = $validator->validated();
        $validatedData['password'] = Hash::make($request->password);
        // Se a validação passar, hash a senha do usuário

        $user = User::create($validatedData);
        // Cria um novo usuário com os dados validados

        Mail::to($user->email)->queue(new RegistrationSuccessEmail($user));
        // Envia um email de sucesso de registro para o usuário

        $token = Auth::attempt($request->only('email', 'password'));
        // Tenta autenticar o usuário e obter um token

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
        // Retorna uma resposta JSON com o usuário e o token
    }

    public function login(Request $request)
    // Define a função de login que aceita um objeto Request como parâmetro
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        // Define as regras de validação para os dados do usuário

        $messages = [
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'password.required' => 'The password field is required.',
        ];
        // Define as mensagens de erro personalizadas para as regras de validação

        $validator = Validator::make($request->all(), $rules, $messages);
        // Cria um validador com os dados do request, as regras e as mensagens

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // Se a validação falhar, retorna um erro 400 com as mensagens de erro

        $credentials = $request->only('email', 'password');
        // Obtém as credenciais do request

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
        // Tenta autenticar o usuário e obter um token. Se falhar, retorna um erro 401

        return response()->json([
            'token' => $token,
        ], 200);
        // Retorna uma resposta JSON com o token
    }
}
// Fim da classe AuthController