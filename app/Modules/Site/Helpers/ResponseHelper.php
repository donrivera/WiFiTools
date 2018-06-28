<?php
namespace App\Modules\Site\Helpers;
use Illuminate\Http\Request;
use Curl;
use Response;

class ResponseHelper
{
    public static function jsonSuccess($data=[])
    {
        $response = [
                        'code'      => '200',
                        'status'    => 'ST200',
                        'data'      => $data, 
                        'message'   => "Connection Ok",
                        'links'     => array(
                                            'rel' => 'self',
                                            'href' => url()->current()
                                            )
                    ];
        return Response::json($response);
    }
    public static function jsonFailed($data=[])
    {
        $response = [
                        'code'      => '400',
                        'status'    => 'ST400',
                        'data'      => $data, 
                        'message'   => "Error"
                    ];
        return Response::json($response);
    }
}