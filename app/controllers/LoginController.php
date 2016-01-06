<?php
/**
 * Created by PhpStorm.
 * User: christian.labini
 * Date: 1/6/16
 * Time: 5:46 PM
 */

class LoginController extends BaseController
{

    public $GlobalModel;
    public $User;
    public $TransLog;

//    public function __construct(GlobalModel $GlobalModel,User $User,TransLog $TransLog, Encrypter $encrypter)
    public function __construct(User $User, TransLog $TransLog)
    {
        $this->User = $User;
        $this->TransLog = $TransLog;
        parent::__construct();
    }

    public function adminLogin()
    {
        if(isset(Auth::user()->id) != NULL){
            if(Auth::user()->id == 1) {
                return Redirect::to('admin/dashboard');
            }
        }
        if (Request::isMethod('post')) {

                $user = $this->User->getUserDetailByPassword(Input::get('user_name'), Input::get('password'));
                if ($user) {
                    if($user->user_date_banned == null)
                    {
                        if ($user->user_type == 1) {
                            /** check whether user's account is active*/
                            if ($user->user_status == 1) {
                                Auth::login($user);
                                $this->TransLog->transLogger('Login Module', 'Logged In');
                                return Redirect::to('admin/users');
                            } else {
                                return'User is deactivated.';
                            }
                        }
                    }
                    else
                    {
                        $startDate = date("Y-m-d h:i:s");
                        $endDate = date("Y-m-d h:i:s", strtotime($user->user_date_banned));

                        if($startDate > $endDate)
                        {
                            /** check user type*/
                            if ($user->user_type == 1) {
                                /** check whether user's account is active*/
                                if ($user->user_status == 1) {
                                    Auth::login($user);
                                    $this->TransLog->transLogger('Login Module', 'Logged In');
//                            return Redirect::to('/admin/dashboard');
                                    return "admin";
                                } else {
                                    return'User is deactivated.';
                                }
                            }
                        }
                        else
                        {
                            return 3;
                        }
                    }

                }else{
                    return 'Incorrect username or password';
                }

        } else {
            $MyTheme = Theme::uses('admin')->layout('default');
            return $MyTheme->of('admin.adminLogin')->render();
        }
    }

    /**
     * Performs a Logout event
     */
    public function logout()
    {
        $this->TransLog->transLogger('Login Module', 'User Logged Out');
        if(Auth::user()->user_type==1)
        {
            Auth::logout();
            return Redirect::to('/admin');
        }
        Auth::logout();
        session_start();
        session_destroy();
        return Redirect::to('/');
    }

}