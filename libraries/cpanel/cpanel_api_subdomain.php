<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Cpanel_Api_Subdomain
 * 
 * @author nunenuh@gmail.com
 */
class Cpanel_Api_Subdomain extends Cpanel_Api_Query{
    private $param= array();
    
    function __construct($param=array()) {
        $this->param = $param;
        parent::__construct($this->param);
    }
    
    /**
     * Retrieve a list of subdomains associated with a cPanel account.
     * 
     * Descriptions<br>
     * <b>$regex</b> Regular expressions allow you to filter results based on a set of criteria.<br>
     * 
     * @param type $regex
     * @return type 
     */
    public function list_subdomain($regex=''){
        $input=array(
                    'module'    => 'SubDomain',
                    'function'  => 'listsubdomains'
                    );
        !empty($regex) && array_push($input, array('regex' => $regex));
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
    
    /**
     * Add a subdomain.
     * 
     * Descriptions<br>
     * <b>$dir</b> The subdomain's document root within your public_html/.<br>
     * <b<$disallowdot</b> If this parameter is enabled (set to '1'), 
     * it will automatically strip dots from the 'domain' value passed to this function. <br>
     * <b>$domain</b> The local part of the subdomain you wish to add.<br>
     * <b>$rootdomain</b> The domain to which you wish to add the subdomain.<br>
     * 
     * @param type $domain
     * @param type $rootdomain
     * @param type $dir
     * @param type $disallowdot
     * @return type boolean
     */
    public function add_subdomain($domain, $rootdomain, $dir='', $disallowdot=''){
        $input=array(
                    'module'        => 'SubDomain',
                    'function'      => 'addsubdomain',
                    'domain'        => $domain,
                    'rootdomain'    => $rootdomain
                    );
        !empty($dir) && array_push($input, array('dir' => $dir));
        !empty($disallowdot) && array_push($input, array('disallowdot' => $disallowdot));
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        $status=$ob->cpanelresult->data[0]->result;
        
        if ($status==1) { 
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    /**
     * Delete a subdomain.
     * 
     * Descriptions<br>
     * <b>$domain</b> The Subdomain do you wish to delete<br>
     * 
     * @param type $domain
     * @return type boolean
     */
    public function delete_subdomain($domain){
        $input=array(
                    'module'        => 'SubDomain',
                    'function'      => 'delsubdomain',
                    'domain'        =>  $domain
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        $status=$ob->cpanelresult->data[0]->result;
        
        if ($status==1) { 
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

?>
