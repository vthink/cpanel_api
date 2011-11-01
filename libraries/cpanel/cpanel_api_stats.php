<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cpanel_api_stats
 *
 * @author nunenuh
 */
class Cpanel_Api_Stats extends Cpanel_Api_Query{
    private $param=array();
    
    function __construct($param=array()) {
        $this->param = $param;
        parent::__construct($this->param);
    }
    
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

?>
