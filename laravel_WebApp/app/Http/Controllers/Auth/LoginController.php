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

    public function toPersonal($response, $routesresponse)
    {
        return view('personal', ['response' => $response, 'routesresponse' => $routesresponse]);
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

            $routes= $client->request('GET', 'http://127.0.0.1:8000/api/routes', [
                'headers' => ['api_token' => /*'6UhcQUtcEuE2HXdUM1crQtV9RQQDI6t5IvWVkWcTTFxbc7rtjXz5Od77cqba'*/ $response->api_token]]);
            Log::info($routes->getBody());
            $routesresponse = json_decode($routes->getBody());

            return $this->toPersonal($response, $routesresponse);
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
