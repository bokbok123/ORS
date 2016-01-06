<?php
/**
 * Created by PhpStorm.
 * User: christian.labini
 * Date: 1/6/16
 * Time: 5:38 PM
 */
class AdminMainController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function dashboard()
    {
        $MyTheme = Theme::uses('admin')->layout('default');
        return $MyTheme->of('admin.index')->render();
    }
}