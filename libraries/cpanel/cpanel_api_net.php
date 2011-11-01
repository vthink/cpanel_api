<?php

/**
 * Description of cpanel_api_net
 *
 * @author nunenuh@gmail.com
 */
class Cpanel_Api_Net extends Cpanel_Api_Query {
    private $param=array();
    
    function __construct($param) {
        $this->param = $param;
        parent::__construct($this->param);
    }
    
    /**
     *
     * @return type 
     */
    public function traceroute(){
        $input=array(
                    'module'    => 'Net',
                    'function'  => 'traceroute'
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
    
    /**
     *
     * @param type $host 
     */
    public function dns_zone($host){
        $input=array(
                    'module'    => 'Net',
                    'function'  => 'dnszone',
                    'host'      => $host
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }

}

?>
