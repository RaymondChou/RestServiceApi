<?php
/**
 * Author: RaymondChou
 * Date: 12-10-6
 * File: api.php
 * Email: zhouyt.kai7@gmail.com
 */

class Api {

    protected $format = null;

    public static function response($object, $http_code = 200)
    {
        $format = self::detect_response_format();
        switch($format)
        {
            case 'json':
                $output = Response::json($object, $http_code);
                break;
            case 'xml':
                $output = Response::make(to_xml($object), $http_code, array('Content-Type' => 'text/xml'));
                break;
            default:
                $output = Response::json($object, $http_code);
        }

        return $output;
    }

    public static function parameters_check($rules = null)
    {
        $request = \Laravel\Input::all();
        if(is_array($rules))
        {
            $validation = Validator::make($request, $rules);
            if($validation->fails())
            {
                $error = $validation->errors->first();
                return $error;
            }
            else
            {
                return $request;
            }
        }
        else
        {
            return $request;
        }
    }

    public static function parameters_error($error)
    {
        return self::response(array('status' => false, 'error_code' => 400, 'error_string'=>$error), 400);
    }

    public static function detect_response_format()
    {
        //@todo add format detect,now return default
        return Config::get('rest_service_api::api.default_format');
    }
}