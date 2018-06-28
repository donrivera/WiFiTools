<?php
namespace App\Modules\User\Helpers;
use Illuminate\Http\Request;
use Curl;
use Response;

class ResponseHelper
{
    
    public static function jsonSuccess($data=[])
    {
        $result = [
                        'code'      => '200',
                        'status'    => 'ST200',
                        'data'      => $data, 
                        'message'   => "Connection Ok",
                        'links'     => array(
                                            'rel' => 'self',
                                            'href' => ''//url()->current()
                                            )
                    ];
        //return Response::json($response);
        return response()->json($result);
    }
    public static function jsonFailed($data=[])
    {
        $response = [
                        'code'      => '400',
                        'status'    => 'ST400',
                        'data'      => $data, 
                        'message'   => "Error"
                    ];
       //return Response::json($response);
       return $response->json($response);
    }
    public static function jsonLogOut($data=[])
    {
        $response = [
                        'code'      => '204',
                        'status'    => 'ST204',
                        'data'      => $data, 
                        'message'   => "Logout"
                    ];
        //return Response::json($response);
        return $response->json($response);
    }
}