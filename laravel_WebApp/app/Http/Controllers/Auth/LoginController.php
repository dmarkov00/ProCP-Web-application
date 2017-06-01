<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;
use Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your personal screen.
    |
    */

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
    public function login(Request $data)
    {
        $client = new Client();
        try{
            $res = $client->request('POST', 'http://127.0.0.1:8000/api/login', [
                'form_params' => [
                    'email' => $data->email,
                    'password' => $data->password,
                ]]);
            $response = json_decode($res->getBody());
            Log::info($res->getBody());
            return $this->toPersonal($response);
        }
        catch(RequestException $e){
            //unsuccessful login message
            $exception = $e->getResponse();
            $exceptionBodyAsString = $exception->getBody()->getContents();
            $formattedException = str_replace("\"","",$exceptionBodyAsString);
            //echo $formattedException;
            return view('index', ['exceptionmsg' => $formattedException]);
        }
    }


}
