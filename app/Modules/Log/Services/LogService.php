<?php
namespace App\Modules\Log\Services;
use App\Modules\Log\Contracts\LogServiceInterface;
use App\Modules\Log\Models\Log;
use App\Modules\Log\Helpers\ResponseHelper;
use App\Http\Requests;
use Auth;
use DB;
class LogService implements LogServiceInterface
{
    
    public function view()
    { 
      $total=Log::Total();
      return ResponseHelper::jsonSuccess($total);
    }
    public function findByMc($mc)
    {
      //$findbyid=User::find($id);
      //$error="ID Not Found...";
      //return (($findbyid)?ResponseHelper::jsonSuccess($findbyid):ResponseHelper::jsonFailed($error));
    }
    public function show($min)
    {
      $current_date=date('Ymd');
      $from_date= date("Y-m-d g:i:s",strtotime("-$min minutes"));
      $aruba_code0='"code":"0"';
      $aruba_code1='"code":"1"';
      $aruba_code3='"code":"3"';
      $aruba_code4='"code":"4"';
      $aruba_code_false="false";
      $ruckus_code101='"ResponseCode":101';
      $ruckus_code201='"ResponseCode":201';
      $ruckus_code301='"ResponseCode":301';
      $total_logs=Log::Total();
      //get aruba code 0 logs percentage
      $aruba_code0_params=array('code'=>$aruba_code0,'from_date'=>$from_date,'total_logs'=>$total_logs);
      $log_aruba_code0=Log::TotalPerCode($aruba_code0_params);
      
      $aruba_code1_params=array('code'=>$aruba_code1,'from_date'=>$from_date,'total_logs'=>$total_logs);
      $log_aruba_code1=Log::TotalPerCode($aruba_code1_params);

      $aruba_code3_params=array('code'=>$aruba_code3,'from_date'=>$from_date,'total_logs'=>$total_logs);
      $log_aruba_code3=Log::TotalPerCode($aruba_code3_params);

      $aruba_code4_params=array('code'=>$aruba_code4,'from_date'=>$from_date,'total_logs'=>$total_logs);
      $log_aruba_code4=Log::TotalPerCode($aruba_code4_params);

      $aruba_codefalse_params=array('code'=>$aruba_code_false,'from_date'=>$from_date,'total_logs'=>$total_logs);
      $log_aruba_code_false=Log::TotalPerCode($aruba_codefalse_params);
     
      $ruckus_code101_params=array('code'=>$ruckus_code101,"from_date"=>$from_date,'total_logs'=>$total_logs);
      $log_ruckus_code101=Log::TotalPerCode($ruckus_code101_params);

      $ruckus_code101_params=array('code'=>$ruckus_code101,"from_date"=>$from_date,'total_logs'=>$total_logs);
      $log_ruckus_code101=Log::TotalPerCode($ruckus_code101_params);

      $ruckus_code201_params=array('code'=>$ruckus_code201,"from_date"=>$from_date,'total_logs'=>$total_logs);
      $log_ruckus_code201=Log::TotalPerCode($ruckus_code201_params);
      
      $ruckus_code301_params=array('code'=>$ruckus_code301,"from_date"=>$from_date,'total_logs'=>$total_logs);
      $log_ruckus_code301=Log::TotalPerCode($ruckus_code301_params);

      $total_codes=array(
        'code 0'     =>array("description"=>"Authenticated Aruba","count"=>$log_aruba_code0),
        'code 1'     =>array("description"=>"Unknown User","count"=>$log_aruba_code1),
        'code 3'     =>array("description"=>"Unknown External Agent","count"=>$log_aruba_code3),
        'code 4'     =>array("description"=>"Authentication Failed","count"=>$log_aruba_code4),
        'code false' =>array("description"=>"false","count"=>$log_aruba_code_false),
        'code 101'   =>array("description"=>"Client Authorized","count"=>$log_ruckus_code101),
        'code 201'   =>array("description"=>"Authenticated Ruckus","count"=>$log_ruckus_code201),
        'code 301'   =>array("description"=>"Password has Expired","count"=>$log_ruckus_code301),
      );
      
      return ResponseHelper::jsonSuccess($total_codes);

    }

    public function showPerMC($data=array())
    {
      $ip="112.198.100.186";
      $log=New Log();
      extract($data);
      $from_date= date("Y-m-d g:i:s",strtotime("-$min minutes"));
      $mc1="112.198.100.220";
      $mc2="112.198.100.212";
      $mc3="112.198.100.204";
      $mc4="112.198.100.196";
      $mc5="112.198.100.156";
      $ruckus186="112.198.100.186";
      $ruckus183="112.198.100.183";
      $ar_code0='"code":"0"';
      $ar_code1='"code":"1"';
      $ar_code3='"code":"3"';
      $ar_code4='"code":"4"';
      $ar_code_false="false";
      //$aruba_codeOK='"code":"0k"';
      $rc_code101='"ResponseCode":101';
      //$ruckus_code200='"ResponseCode":200';
      $rc_code201='"ResponseCode":201';
      $rc_code301='"ResponseCode":301';
      if($ip==$ruckus186 || $ip==$ruckus183)
      {
          $total_logs=$log->TotalPerMC(array("ip"=>$ip,"from_date"=>$from_date));
          $logs=array("Ruckus"=>array
                      (
                        'code 101'  =>array("description"=>"Client Authorized",
                            "count"=>$log->TotalPerMcCode(array
                                    (
                                      "ip"=>$ip,
                                      "code"=>$rc_code101,
                                      "from_date"=>$from_date,
                                      "total_logs"=>$total_logs
                                    ))),
                        'code 201'  =>array("description"=>"Authenticated Ruckus",
                                    "count"=>$log->TotalPerMcCode(array
                                            (
                                              "ip"=>$ip,
                                              "code"=>$rc_code201,
                                              "from_date"=>$from_date,
                                              "total_logs"=>$total_logs
                                            ))),
                        'code 301'  =>array("description"=>"Password has Expired",
                                            "count"=>$log->TotalPerMcCode(array
                                                    (
                                                      "ip"=>$ip,
                                                      "code"=>$rc_code301,
                                                      "from_date"=>$from_date,
                                                      "total_logs"=>$total_logs
                                                    ))),
           ));
      }
      else
      {
        $total_logs=$log->TotalPerMC(array("ip"=>$ip,"from_date"=>$from_date));
        $logs=array("Ruckus"=>array
                    (
                      'code 101'  =>array("description"=>"Client Authorized",
                          "count"=>$log->TotalPerMcCode(array
                                  (
                                    "ip"=>$ip,
                                    "code"=>$rc_code101,
                                    "from_date"=>$from_date,
                                    "total_logs"=>$total_logs
                                  ))),
                      'code 201'  =>array("description"=>"Authenticated Ruckus",
                                  "count"=>$log->TotalPerMcCode(array
                                          (
                                            "ip"=>$ip,
                                            "code"=>$rc_code201,
                                            "from_date"=>$from_date,
                                            "total_logs"=>$total_logs
                                          ))),
                      'code 301'  =>array("description"=>"Password has Expired",
                                          "count"=>$log->TotalPerMcCode(array
                                                  (
                                                    "ip"=>$ip,
                                                    "code"=>$rc_code301,
                                                    "from_date"=>$from_date,
                                                    "total_logs"=>$total_logs
                                                  ))),
         ));
      }
      return ResponseHelper::jsonSuccess($logs);
    }
    public function showError($min)
    {
      //extract($data);
      $current_date=date('Ymd');
      $from_date= date("Y-m-d g:i:s",strtotime("-$min minutes"));
      $log= New Log();
      $mc=array(
                "MC 1"      => "112.198.100.220",
                "MC 2"      => "112.198.100.212",
                "MC 3"      => "112.198.100.204",
                "MC 4"      => "112.198.100.196",
                "MC 5"      => "112.198.100.156",
                "MC 6"      => "222.127.112.83",
                "MC 7"      => "222.127.112.80",
                "MC 8"      => "222.127.112.81",
                "MC 9"      => "222.127.112.82",
                "MC 10"     => "222.127.112.79",
                "Ruckus 183"    => "112.198.100.183",
                "Ruckus 186"    => "112.198.100.186",
                "Boracay"       => "112.198.100.19",
                "BHS"           => "112.198.100.1",
                "Eastwood"      => "112.198.100.6",
                "MCIA"          => "112.198.100.20",
                "LCTM"          => "112.198.100.3",
                "Fairview"      => "112.198.100.25",
                "Venice"        => "112.198.100.14",
                "PICC"          => "112.198.100.24",
                "Solenad"       => "112.198.100.52",
              );
      $ar_code0='"code":"0"';
      $ar_code1='"code":"1"';
      $ar_code3='"code":"3"';
      $ar_code4='"code":"4"';
      $ar_code_false="false";
      $rc_code101='"ResponseCode":101';
      $rc_code201='"ResponseCode":201';
      $rc_code301='"ResponseCode":301';
      $logs_result=array();
      foreach($mc as $key=>$value)
      {
        //echo $key.$value;
        $ip=$value;
        //$total_logs=$tools->TotalLogsPerMC(array("ip"=>$ip,"date"=>$current_date,"from_date"=>$from_date));
        $total_logs=$log->TotalPerMC(array("ip"=>$ip,"from_date"=>$from_date));
        switch($key)
        {
            case 'Ruckus 183':
            case 'Ruckus 186':  
            {
                $code_101_total=$log->TotalPerMcCode(array
                                    (
                                      "ip"=>$ip,
                                      "code"=>$rc_code101,
                                      "from_date"=>$from_date,
                                      "total_logs"=>$total_logs
                                    ));
                $code_201_total=$log->TotalPerMcCode(array
                                    (
                                      "ip"=>$ip,
                                      "code"=>$rc_code201,
                                      "from_date"=>$from_date,
                                      "total_logs"=>$total_logs
                                    ));
                $code_301_total=$log->TotalPerMcCode(array
                                    (
                                      "ip"=>$ip,
                                      "code"=>$rc_code101,
                                      "from_date"=>$from_date,
                                      "total_logs"=>$total_logs
                                    ));
                $result_logs=$code_101_total + $code_201_total + $code_301_total;                         
            }break;
            default:
            {
              $code_0_total=$log->TotalPerMcCode(array
                                (
                                  "ip"=>$ip,
                                  "code"=>$ar_code0,
                                  "from_date"=>$from_date,
                                  "total_logs"=>$total_logs
                                ));
              $code_1_total=$log->TotalPerMcCode(array
                                (
                                  "ip"=>$ip,
                                  "code"=>$ar_code1,
                                  "from_date"=>$from_date,
                                  "total_logs"=>$total_logs
                                ));
              $code_3_total=$log->TotalPerMcCode(array
                                (
                                  "ip"=>$ip,
                                  "code"=>$ar_code3,
                                  "from_date"=>$from_date,
                                  "total_logs"=>$total_logs
                                ));
              $code_4_total=$log->TotalPerMcCode(array
                                (
                                  "ip"=>$ip,
                                  "code"=>$ar_code4,
                                  "from_date"=>$from_date,
                                  "total_logs"=>$total_logs
                                ));
              $code_f_total=$log->TotalPerMcCode(array
                                (
                                  "ip"=>$ip,
                                  "code"=>$ar_code_false,
                                  "from_date"=>$from_date,
                                  "total_logs"=>$total_logs
                                ));  
              $result_logs=$code_1_total + $code_3_total + $code_4_total + $code_f_total; 
            }break;
        }
        $logs_result[$key]=round($result_logs,2);
      }
      return ResponseHelper::jsonSuccess($logs_result);
    }
}