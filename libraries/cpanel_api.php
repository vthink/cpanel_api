<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//load parent class
require 'cpanel/cpanel_api_query.php';

//load child class
require 'cpanel/cpanel_api_addon_domain.php';
require 'cpanel/cpanel_api_cron.php';
require 'cpanel/cpanel_api_email.php';
require 'cpanel/cpanel_api_ftp.php';
require 'cpanel/cpanel_api_mysql.php';
require 'cpanel/cpanel_api_net.php';
require 'cpanel/cpanel_api_stats.php';
require 'cpanel/cpanel_api_statsbar.php';
require 'cpanel/cpanel_api_subdomain.php';
require 'cpanel/cpanel_api_zone_edit.php';


/**
 * Description of Cpanel_Api
 *
 * @author Lalu Erfandi Maula Yusnu at nunenuh@gmail.com
 * @license LGPL 2
 * @copyright @ 2011 Mataram Nusa Tenggara Barat Indonesia
 * @link http://www.vthink.web.id
 * @link http://gen5x4.wordpress.com
 * @name Cpanel_Api
 * @version 1.0.0
 */
class Cpanel_Api {
    private $CI;
    private $param=array();
    private $email;
    
    
    /**
     *
     * @param type $param is an array
     * 
     */
    public function __construct($param=array()){
        $this->CI = & get_instance();
        $param_config=$this->CI->config->item('cpanel');
        
        if (isset($param_config) && is_array($param_config)){
            $this->param = $param_config;
        } else {
             $this->param = $param;
        }
        
        log_message('debug','initalized class cpanel_api');
    }
    
    /**
     * Email Access
     * 
     * @return type object 
     */
    public function mail(){
	return new Cpanel_Api_Email($this->param);
    }
    
    /**
     * StatsBar Access
     * 
     * @return type object 
     */
    public function stats_bar(){
        return new Cpanel_Api_Statsbar($this->param);
    }
    
    /**
     * Subdomain Access
     * 
     * @return type object 
     */
    public function subdomain(){
        return new Cpanel_Api_Subdomain($this->param);
    }
    
    /**
     * Stats Access
     * 
     * @return type object 
     */
    public function stats(){
        return new Cpanel_Api_Stats($this->param);
    }
    
    /**
     * ZoneEdit Access
     * 
     * @return type object 
     */
    public function zone_edit(){
        return new Cpanel_Api_Zone_Edit($this->param);
    }
    
    /**
     * Net Access
     * 
     * @return type object 
     */
    public function net(){
        return new Cpanel_Api_Net($this->param);
    }
    
    /**
     * FTP Access
     * 
     * @return type object 
     */
    public function ftp(){
        return new Cpanel_Api_Ftp($this->param);
    }
    
    /**
     * MySQL Access
     * @return type object
     */
    public function mysql(){
        return new Cpanel_Api_Mysql($this->param);
    }
    
    /**
     * Addon Domain Access
     * @return type object
     */
    public function addon_domain(){
        return new Cpanel_Api_Addon_Domain($this->param);
    }
    
    /**
     * Cron Access
     * @return type object
     */
    public function cron(){
        return new Cpanel_Api_Cron($this->param);
    }
    
    /**
     * Get Configuration Data 
     * 
     * @return array
     */
    public function getConfig(){
        return $this->param;
    }
        
        
}

