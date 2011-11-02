<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of cpanel_api_zone_edit
 *
 * @author nunenuh@gmail.com
 */
class Cpanel_Api_Zone_Edit extends Cpanel_Api_Query{
    private $param=array();
    
    function __construct($param) {
        $this->param = $param;
        parent::__construct($this->param);
    }
    
    /**
     *
     * @param type $domain
     * @param type $name
     * @param type $type
     * @param type $txtdata
     * @param type $cname
     * @param type $address
     * @param type $ttl
     * @param type $class
     * @return type 
     */
    public function add_zone_record($domain, $name, $type,
                                    $txtdata='', $cname='',$address='',
                                    $ttl='',$class=''){
        $input=array(
                    'module'    => 'ZoneEdit',
                    'function'  => 'add_zone_record',
                    'domain'    => $domain,
                    'name'      => $name,
                    'type'      => $type
                    );
        !empty($txtdata) && array_push($input, array('txtdata'=>$txtdata)); 
        !empty($cname) && array_push($input, array('cname'=>$cname)); 
        !empty($address) && array_push($input, array('address'=>$address)); 
        !empty($ttl) && array_push($input, array('ttl'=>$ttl));  
        !empty($class) && array_push($input, array('class'=>$class));
        
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
        
    }
    
  
    /**
     *
     * @param type $domain
     * @param type $line
     * @param type $type
     * @param type $txtdata
     * @param type $cname
     * @param type $address
     * @param type $ttl
     * @param type $class
     * @return type 
     */
    public function edit_zone_record($domain, $line, $type, 
                                     $txtdata='',$cname='',$address='',
                                     $ttl='', $class=''){
        $input=array(
                    'module'    => 'ZoneEdit',
                    'function'  => 'edit_zone_record',
                    'domain'    => $domain,
                    'Line'      => $line,
                    'type'      => $type
                    );
        !empty($txtdata) && array_push($input, array('txtdata'=>$txtdata)); 
        !empty($cname) && array_push($input, array('cname'=>$cname)); 
        !empty($address) && array_push($input, array('address'=>$address)); 
        !empty($ttl) && array_push($input, array('ttl'=>$ttl));  
        !empty($class) && array_push($input, array('class'=>$class));
        
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
        
    }
    
    /**
     *
     * @param type $domain
     * @param type $line
     * @return type 
     */
    public function remove_zone_record($domain, $line){
        $input=array(
                    'module'    => 'ZoneEdit',
                    'function'  => 'remove_zone_record',
                    'domain'    => $domain,
                    'line'      => $line,
                    );
        
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
    
    /**
     *
     * @param type $domain
     * @return type 
     */
    public function fetch_zone_records($domain){
        $input=array(
                    'module'    => 'ZoneEdit',
                    'function'  => 'fetchzone_records',
                    'domain'    => $domain
                    );
        
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
        
    }
    
    /**
     *
     * @return type 
     */
    public function fetch_zones(){
        $input=array(
                    'module'    => 'ZoneEdit',
                    'function'  => 'fetchzones'
                    );
        
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
    
    /**
     *
     * @param type $domain
     * @param type $key
     * @param type $customonly
     * @return type 
     */
    public function fetch_zone($domain, $key='',$customonly=''){
        $input=array(
                    'module'    => 'ZoneEdit',
                    'function'  => 'fetchzone',
                    'domain'    => $domain
                    );
        
        !empty($key) && array_push($input, array('key'=>$key)); 
        !empty($customonly) && array_push($input, array('customonly'=>$customonly)); 
        
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
    
    /**
     * @param type $domain
     * @return type 
     */
    public function reset_zone($domain){
        $input=array(
                    'module'    => 'ZoneEdit',
                    'function'  => 'resetzone',
                    'domain'    => $domain
                    );
        
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }

}

