RestServiceApi
==============

A RESTful web service api bundle for Laravel

#Installation
Install using artisan for Laravel :

	php artisan bundle:install rest_service_api

Then add rest_service_api to your application/bundles.php with auto start enabled :

	return array('rest_service_api' => array('auto' => true, 'handles' => 'api_docs'));
	
Publish the bundle assets to your public folder.

	php artisan bundle:publish
	
#Config
You can set some configs in rest_service_api/config/

this will adding soon


#Example

add a api controller

    class Api_User_Controller extends Api_Controller{
    
        public function get_test()
        {
            $rules = array(
                'username'              => 'required|max:16|unique:users',
                'password'              => 'required|between:6,16|alpha_dash',
            );
            $par = Api::parameters_check($rules);
            if(is_string($par))
            {
                //here can make some logs
                return Api::parameters_error($par);
            }
            else
            {
                print_r($par);
                //here is your code
            }
        }
    
        public function get_test2()
        {
            $par = Api::parameters_check();
    
            print_r($par);
            //here is your code
        }
    }
    
put your api docs to application/documentations like larval docs,you can edit your api docs using markdown

	http://localhost/api_docs
	
if you want change the path , you can set in configs

#Notice

this will be the first version , new things will coming soon!