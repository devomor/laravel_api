<?php 
namespace App\Services;

use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
 trait LoginTokenService{
    
    public function loginToken(array $credentials)
    {
        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            $token = $user->createToken('api');

            $response = [
                'message' => 'Login Token Generated Successfully!',
                'data' => [
                    'token' => $token->plainTextToken
                ]
            ];

            return new SuccessResource($response);
        }

        $errors['email'][] = __('auth.failed');
        return (new ErrorResource($errors))->response()->setStatusCode(422);
    }
}


?>