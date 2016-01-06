<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class TransLog extends Eloquent implements UserInterface, RemindableInterface
{

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_translog';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    public function transLogger($Module, $Description)
    {

        if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
        }

        $ip = filter_var($ip, FILTER_VALIDATE_IP);
        $ip = ($ip === false) ? '0.0.0.0' : $ip;

        DB::table('tbl_translog')
            ->insert(array(
                'trans_user_id' => Auth::user()->id,
                'trans_module' => $Module,
                'trans_description' => $Description,
                'trans_ip' => $ip
            ));
    }

    public function transLoggerWithId($Module, $Description, $id)
    {

        if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
        }

        $deviceModel = new Device();
        try {
            $dev = $deviceModel->getDeviceIdByUserId($id);
        } catch (Exception $ex) {
            $dev = 1;
        }

        $ip = filter_var($ip, FILTER_VALIDATE_IP);
        $ip = ($ip === false) ? '0.0.0.0' : $ip;

        DB::table('tbl_translog')
            ->insert(array(
                'trans_user_id' => $id,
                'trans_deviceid' => $dev,
                'trans_module' => $Module,
                'trans_description' => $Description,
                'trans_ip' => $ip
            ));
    }

    //Refactoring

    public function getTransactionLogsByUserId($userId)
    {
        $userLog = TransLog::where('trans_user_id', '=', $userId)->orderby('trans_id', 'DESC')
            ->get();
        return $userLog;
    }

    public function getTransLogSelect()
    {
        $_trans_mod = DB::select('select distinct trans_module from tbl_translog');

        return $_trans_mod;
    }

    public function getTransLogId($data)
    {
        if($data['search']=='Guest'){
            $pending = TransLog::where('trans_user_id', '=', $data['id']);
        }else{
            $pending = TransLog::where('trans_user_id', '=', $data['id'])
                ->where('trans_module', '=', $data['search']);
        }

        return $pending;
    }

    public function getTransLogDate($id,$dtFrom,$dtTo)
    {
        $pending = TransLog::where('trans_datecreated', '>=', $dtFrom . ' 00:00:00')
            ->where('trans_user_id', '=', $id)
            ->where('trans_datecreated', '<=', $dtTo . ' 23:59:59');
        return $pending;
    }

    public function getTransLogDateModule($id,$dtFrom,$dtTo,$module)
    {
        $pending = TransLog::where('trans_datecreated', '>=', $dtFrom . ' 00:00:00')
            ->where('trans_user_id', '=', $id)
            ->where('trans_datecreated', '<=', $dtTo . ' 23:59:59')
            ->where('trans_module', '=', $module);
        return $pending;
    }

    public function insertRemarks($id, $type, $status, $desc = "")
    {
        DB::table('tbl_remarks')
            ->insert(array(
                'remark_user_id'    => Auth::user()->id,
                'remark_id'         => $id,
                'remark_type'       => $type,
                'remark_description'=> $desc,
                'remark_status'     => $status
            ));
        return 1;
    }

    public function getRemarksDetails($id,$type){
        $details = DB::table('tbl_remarks')
            ->where('remark_id',$id)
            ->where('remark_type',$type)
            ->get();
        return $details;
    }
}