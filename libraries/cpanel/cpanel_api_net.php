<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
     * Perform a traceroute back to your local IP address 
     * while displaying packet speed at each hop in milliseconds.
     * 
     * @return type object
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
     * This API call performs an A record DNS query for the 
     * hostname presented via the 'host' variable, with a 60 second timeout. 
     * If more than one A record exists for a given FQDN, all will be returned.
     * 
     * Descriptions<br>
     * <b>$host</b> This value is a fully qualified domain name. 
     * Either host.domain.com, or domain.com, i.e., www.cpanel.net, or simply cpanel.net.<br>
     * 
     * @param type object
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
