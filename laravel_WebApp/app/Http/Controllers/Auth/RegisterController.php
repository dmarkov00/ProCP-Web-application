<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
class RegisterController extends Controller
{

    //redirect to method will take presedence over the redirect to field
//    protected $redirectTo = '/home';
//    protected function redirectTo()
//    {
//        return '/personal';
//    }


    public function __construct()
    {
        $this->middleware('guest');
    }
    public function toPersonal($response)
    {
        return view('personal', ['response' => $response]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function register(Request $data)
    {
        $client = new Client();
        $res = $client->request('POST', 'http://127.0.0.1:8000/api/register', [
            'form_params' => [
                'name' => $data->name,
                'email' => $data->email,
                'password' => $data->password,
                'password_confirmation' => $data->password_confirmation,
            ]
        ]);

        $response = json_decode($res->getBody());

        if($res->getStatusCode()== 201) {
            return $this->toPersonal($response);
        }
        else{
            echo $res->getStatusCode();
            echo $res->getBody();
        }


    }
}
