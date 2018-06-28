<?php

namespace App\Modules\Log\Models;

#use Laravel\Passport\HasApiTokens;
#use Illuminate\Notifications\Notifiable;
#use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;
class Log extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'captive_log';
    
    /**
     * Database table used for this model.
     *
     * @var string
     */
    protected $table = 'captive_log';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'connection_log_id';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //'auth_ip', 'auth_key', 'auth_port', 'ac_brand'
        'product_type_id','site_id','site_group_id','mac_address','reference_code','pop_ads'
    ];

    public static function Connect()
    {
        //return DB::connection('captive_log');
        return app('db')->connection('captive_log');
    }
    public static function Total()
    {
        
        $date="20180405";//date('Ymd');
        $from_date= "2018-04-05 00:00:00";
        $to= "NOW()";
        $conn=self::connect();
        $query = $conn->select('SELECT COUNT(nas_log_id) as total
                                FROM nas_log_'.$date.' 
                                WHERE created_at between :from AND NOW()', ["from"=>$from_date]);
        return $query;
    }
    public function TotalPerMC($data=array())
    {
        extract($data);
        $date=date('Ymd');
        $conn=self::connect();
		$sql='	SELECT COUNT(nas_log_id) as total
				FROM nas_log_'.$date.'
				WHERE url LIKE :ip
				AND created_at BETWEEN :fr AND NOW()';
        $query=$conn->select($sql,["fr"=>$from_date,'ip' => '%'.$ip.'%']);
        //$result_total = $query[0]->total_logs;
        return $query;//$result_total;
    }
    public static function TotalPerCode($data)
    {   
        extract($data);
        $date=date('Ymd');
        //$total_logs=self::Total();
        //dd($total->total);
        $conn=self::connect();
		$sql='	SELECT COUNT(nas_log_id) as total_logs
				FROM nas_log_'.$date.'
				WHERE response LIKE :code
				AND created_at BETWEEN :fr AND NOW()';
        $query=$conn->select($sql,["fr"=>$from_date,'code' => '%'.$code.'%']);
        $result_total = $query[0]->total_logs;
		if($result_total==0 && $total_logs[0]->total==0)
		{
			$logs=0;
		}
		else
		{
			$logs=($result_total / $total_logs[0]->total) * 100;
		}
		
        return round($logs,2);
    }
    public function TotalPerMcCode($data=array())
    {
        extract($data);
        $date=date('Ymd');
        $conn=self::connect();
		$sql='	SELECT COUNT(nas_log_id) as total_logs
				FROM nas_log_'.$date.'
                WHERE url LIKE :ip
                AND response LIKE :code
				AND created_at BETWEEN :fr AND NOW()';
        $query=$conn->select($sql,["fr"=>$from_date,'ip' => '%'.$ip.'%','code' => '%'.$code.'%']);
        $result_total = $query[0]->total_logs;
		if($result_total==0 && $total_logs[0]->total==0)
		{
			$logs=0;
		}
		else
		{
			$logs=($result_total / $total_logs[0]->total) * 100;
		}
		return round($logs,2);
    }
}
