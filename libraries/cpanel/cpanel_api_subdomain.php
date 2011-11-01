<?php
/**
 * Description of Cpanel_Api_Email
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
     *
     * @param type $domain
     * @param type $rootdomain
     * @param type $dir
     * @param type $disallowdot
     * @return type 
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
