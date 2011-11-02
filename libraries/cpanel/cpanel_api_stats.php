<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of cpanel_api_stats
 *
 * @author nunenuh@gmail.com
 */
class Cpanel_Api_Stats extends Cpanel_Api_Query{
    private $param=array();
    
    function __construct($param=array()) {
        $this->param = $param;
        parent::__construct($this->param);
    }
    /**
     * Display domains that have webalizer statistics available.
     * This data can be used to create a link to 
     * webalizer using the following url ":2083/tmp/$user/webalizer/$dir/index.html"
     * 
     * @return type object
     */
    public function list_webalizer(){
        $input=array(
                    'module'    => 'Stats',
                    'function'  => 'listwebalizer',
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $ob->cpanelresult->data;
    }
    
    /**
     * Display domains that have awstats web statistics available. 
     * This data can be used to create a link 
     * to awstats using the following 
     * url ":2083/awstats.pl?config=$domain&ssl=$ssl&lang=$lang"
     * 
     * @return type object
     */
    public function list_awstats(){
        $input=array(
                    'module'    => 'Stats',
                    'function'  => 'listawstats',
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $ob->cpanelresult->data;
    }
    
    /**
     * Display domains that have last visitors information available. 
     * This data can be used to create to 
     * a link the last visitors page using the following 
     * url ":2083/frontend/x3/stats/lastvisit.html?domain=$domain&ssl=$ssl"
     * 
     * @return type object
     */
    public function list_last_visitors(){
        $input=array(
                    'module'    => 'Stats',
                    'function'  => 'listlastvisitors',
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $ob->cpanelresult->data;
    }
    
    /**
     * Display domains that have urchin web statistics available
     * @return type object
     */
    public function list_urchin(){
        $input=array(
                    'module'    => 'Stats',
                    'function'  => 'listurchin',
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $ob->cpanelresult->data;
    }
    
    /**
     * Display domains that have raw log downloads 
     * available and the URL to download the raw logs from.
     * 
     * @return type object
     */
    public function list_rawlogs(){
        $input=array(
                    'module'    => 'Stats',
                    'function'  => 'listrawlogs',
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $ob->cpanelresult->data;
    }
    
    /**
     * Display domains that have analog statistics available. 
     * This data can be used to create 
     * a link to analog using the following 
     * url ":2083/frontend/x3/stats/analog.html?domain=$domain&ssl=$ssl"
     * @return type object
     */
    public function list_analog(){
        $input=array(
                    'module'    => 'Stats',
                    'function'  => 'listanalog',
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $ob->cpanelresult->data;
    }

}
