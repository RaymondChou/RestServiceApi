<?php
/**
 * Author: RaymondChou
 * Date: 12-10-6
 * File: api_controller.php
 * Email: zhouyt.kai7@gmail.com
 */
abstract class Api_Controller extends Base_Controller{

    public $restful = true;

    public function __construct()
    {
        //@todo
    }

    public function __call($method, $parameters)
    {
        return Api::response(array('status' => false, 'error_code' => 404 ,'error_string' => 'unknown method'), 404);
    }

}