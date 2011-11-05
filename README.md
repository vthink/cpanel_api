#cpanel_api
This spark library that allow you to manipulate your cpanel based on cpanel api json function call.

##Documentation
For updates and documentation based on this api pelase refer to this site
* http://vthink.web.id/index.php/content/categories/19

For origin of cPanel API documentation please refer to this site
* http://docs.cpanel.net/twiki/bin/view/ApiDocs/Api2/WebHome
 
##Using Library
###Requirement
This Library require

* codeigniter version 2.0.3
* php with curl support
* php version 5.2.x above

###Configuration
Okey, before it can be user well the first thing to do is change the configuration file.
Configuration file is located in 

  `sparks/cpanel_api/0.7.0/config/cpanel_api.php`

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
Okey, after you finished change your configuration file, try this code

        class test extends CI_Controller{
          function __construct() {
            parent::__construct();
            $this->load->spark('cpanel_api/0.7.0');
          }
          function index(){
            $mail=$this->cpanel_api->mail()->list_mail();
            print_r($mail);
          }
        }


Now, you are on the fire!!!

##Limitation
cpanel_api that i've created only can handle cpanel domain owner type. In the future release I will try to catch up for Web Hosting Manager type.
