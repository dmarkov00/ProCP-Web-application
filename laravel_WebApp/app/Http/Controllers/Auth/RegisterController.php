<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use Session;
use Log;


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

    //currrently there is no proper use of session. To be updated in last iteration
    public function register(Request $data)
    {

        $client = new Client();
        try{
        $res = $client->request('POST', 'http://127.0.0.1:8000/api/register', [
            'form_params' => [
                'name' => $data->name,
                'email' => $data->email,
                'password' => $data->password,
                'password_confirmation' => $data->password_confirmation,
            ]]);
        $response = json_decode($res->getBody());
        Log::info($res->getBody());
        return $this->toPersonal($response);
        }
        catch(RequestException $e){
            //unsuccessfull registration message
            $exception = $e->getResponse();
            $exceptionBodyAsString = $exception->getBody()->getContents();
            $formattedException = str_replace("\""," ",$exceptionBodyAsString);
            //echo $formattedException;
            return view('index', ['exceptionmsg' => $formattedException]);
        }








    }
}
