<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthyService;

class AuthController extends Controller
{
    protected $authy;

    public function __construct(AuthyService $authy)
    {
        $this->authy = $authy;
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string|email',
            'phone' => 'required|string',
            'country_code' => 'required|string',
        ]);

        $response = $this->authy->registerUser($data['email'], $data['phone'], $data['country_code']);

        return response()->json($response);
    }

    public function sendToken(Request $request)
    {
        $data = $request->validate([
            'authy_id' => 'required|string',
        ]);

        $response = $this->authy->sendToken($data['authy_id']);

        return response()->json($response);
    }

    public function verifyToken(Request $request)
    {
        $data = $request->validate([
            'authy_id' => 'required|string',
            'token' => 'required|string',
        ]);

        $response = $this->authy->verifyToken($data['authy_id'], $data['token']);

        return response()->json($response);
    }
}
