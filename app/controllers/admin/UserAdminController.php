<?php
/**
 * Created by PhpStorm.
 * User: christian.labini
 * Date: 1/6/16
 * Time: 9:01 PM
 */

class UserAdminController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function ajax()
    {
        /**@$Logger This for instantiate of new translog.*/
        /**@$SOP This for instantiate of  new sophisticated.*/
        /**@$USER This for instantiate of new user.*/
        /**@$type This for input type.*/

        $Logger = new TransLog();
        $user = new User();
        $type = Input::get('type');

        if($type) {
            switch ($type) {

                case 'users-list': {
                    //Get User Country and State
                    if(Input::has('status') && Input::get('status')<2){
                        $status = Input::get('status');
                        if(Auth::user()->id== 1){
                            $pending = User::where('user_type', '!=', 0)
                                ->leftjoin('tbl_usersophisticate', 'id', '=', 'tbl_usersophisticate.userId')
                                ->where('user_status','=',$status)
                                ->where('user_emailverification','=','verified');
                        }else{
                            $pending = User::where('user_type', '!=', 0)
                                ->leftjoin('tbl_usersophisticate', 'id', '=', 'tbl_usersophisticate.userId')
                                ->where('user_countryid', Auth::user()->user_countryId)
                                ->where('user_status','=',$status)
                                ->where('user_emailverification','=','verified');
                        }
                    }else{
                        if(Auth::user()->id== 1){
                            $pending = User::where('user_type', '!=', 0)
                                ->leftjoin('tbl_usersophisticate', 'id', '=', 'tbl_usersophisticate.userId')
                                ->where('user_emailverification','=','verified');
                        }else{
                            $pending = $UserModel->getUserAdminListCountry();
                        }
                    }
                    $dtResult = self::setDatatable($pending, array(
                            'id',
                            'user_fname',
                            'user_lname',
                            'user_email',
                            'user_username',
                            'user_status',
                            'user_isNew',
                            'sop_status'),
                        'id');
                    foreach ($dtResult['objResult'] as $aRow) {

                        try {
                            $usertype= $UserModel->getUserType($aRow->id);
                            $pro = $usertype->user_type;
                        } catch (Exception $ex) {
                            $pro = 0;
                        }
                    }
                 }
            }
        }
    }
}
