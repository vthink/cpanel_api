#cPanel Api
This is cPanel Api for accessing your cPanel

@site 	: http://vthink.web.id

@author	: Fandi Vthink at nunenuh@gmail.com


#DOCUMENTATION:
Documentation WILL BE located at :
	http://vthink.web.id/index.php/content/categories/19

for complete documentation about api please open this link :
	http://docs.cpanel.net/twiki/bin/view/ApiDocs/Api2/WebHome

#INSTALLATION:
Just write in your codeigniter spark directory with this sintax

	$ php tools/spark install -v0.5.0 cpanel_api



#USING THE LIBRARY:

##configuration
okey, first let change configuration file for using your cpanel

configuration file are located in : 
  
	$ spark/cpanel_api/0.5.0/config/cpanel_api.php

the content will be like this :

	$config['cpanel']['host']     = 'x3demob.cpx3demo.com';
	$config['cpanel']['port']     = 2082;
	$config['cpanel']['ssl']      = false;
	$config['cpanel']['username'] = 'x3demob';
	$config['cpanel']['password'] = 'x3demob';

Description :
	$config['cpanel']['host'] 	-> write down your domain in here, and without http:// or https://
	$config['cpanel']['port'] 	-> write down your port here (2082 or 2083)
	$config['cpanel']['ssl']  	-> write down if you want using ssl for connection mechanism (true/false)
	$config['cpanel']['username'] 	-> write down your username for cpanel authentication
	$config['cpanel']['password'] 	-> write down your password for cpanel authentication


##Running
after you finish configure cpanel_api, lets try it in your controller

	class test extends CI_Controller{
	    function __construct() {
			parent::__construct();
			$this->load->spark('cpanel_api/0.5.0');
	    }
	    
	    function index(){
			$mail=$this->cpanel_api->mail()->list_mail();
			print_r($mail);
	    }
	}

you are now on the fire!!


#LIMITATIONS
Cpanel Api that i've created just functional well on domain owner cpanel type
in the future release i will try to catch up for Werb Hosting Manager manipulating

