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
        $UserModel = new User();
        $type = Input::get('type');

        if($type) {
            switch ($type) {

                case 'users-list': {
                    $pending = $UserModel->getAllUsers();
                    $dtResult = GlobalController::setDatatable($pending, array(
                            'id',
                            'user_fname',
                            'user_lname',
                            'user_email',
                            'user_username',
                            'user_status',
                            'user_type'),
                        'id');
                    foreach ($dtResult['objResult'] as $aRow) {

                        try {
                            $usertype= $UserModel->getUserType($aRow->id);
                            $pro = $usertype->user_type;
                        } catch (Exception $ex) {
                            $pro = 0;
                        }
                        switch($pro){
                            case 1:
                                $pro = 'Admin';
                                break;
                            case 2:
                                $pro = 'Default';
                                break;
                        }
                        $data = array(
                            $aRow->id,
                            $aRow->user_fname,
                            $aRow->user_lname,
                            $aRow->user_email,
                            $aRow->user_username,
                            $aRow->user_status ? "Active" : "Inactive",
                            $pro,
                            'Action'
                        );
                    }
                 }
            }
        }
    }
}
