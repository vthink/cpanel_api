#cpanel_api
This library allow you to manipulate cpanel using the cpanel api json function call. This library can be used with spark or without. Some modifications may be needed.

##Documentation
For updates and documentation based on this api pelase refer to this site
* http://vthink.web.id/index.php/content/categories/19

For origin of cPanel API documentation please refer to this site
* http://docs.cpanel.net/twiki/bin/view/ApiDocs/Api2/WebHome
 
##Using Library
###Requirement
This Library requires

* codeigniter version 2.x
* php with curl support
* php version 5.2.x or above

###Configuration
Before it can be used, the first thing to do is change the configuration file.
Configuration file is located in 

  `config/cpanel_api.php`

The content of configuration file will be like this.

       $config['cpanel']['host']      = 'x3demob.cpx3demo.com';
       $config['cpanel']['port']      = 2082;
       $config['cpanel']['ssl']       = false;
       $config['cpanel']['username']  = 'x3demob';
       $config['cpanel']['password']  = 'x3demob';
   
####Description
* $config['cpanel']['host']     *write down your domain in here, and without http:// or https://)*
* $config['cpanel']['port']     *write down your port here (2082 or 2083))*
* $config['cpanel']['ssl']      *write down if you want using ssl for connection mechanism (true/false))*
* $config['cpanel']['username'] *write down your username for cpanel authentication)*
* $config['cpanel']['password'] *write down your password for cpanel authentication)*

###Running It
After updating your configuration file, try this code

        class test extends CI_Controller{
          function __construct() {
            parent::__construct();
            // if using spark use the line below:
            $this->load->spark('cpanel_api/0.7.0');
            
            // if not using spark, use the line below
            $this->load->library('cpanel_api');
          }
          function index(){
            $mail=$this->cpanel_api->mail()->list_mail();
            print_r($mail);
          }
        }


Now, you are on the fire!!!

##Limitation
Version 1.1.0 allows you to call both API 1 and API 2 calls. This is configured within the function itself using the example below as part of the input array:
    'apiversion' => 2,
