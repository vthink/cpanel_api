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
     * Add an A, CNAME, or TXT record to a zone file, specified by line number. 
     * You must have access to either 'zoneedit' or 'simplezoneedit' features. 
     * This function does not work in DEMO mode.
     * 
     * Descriptions<br>
     * <b>$domain</b> The domain for which you wish to add an entry. <br>
     * <b>$name</b> The name of the record. <br>
     * <b>$type</b> Acceptable values include 'A', 'CNAME', or 'TXT'.<br>
     * <b>$txtdata</b> If you specify value TXT in $type you can input TXT information with this.<br>
     * <b>$cname</b> If you specify value CNAME in $type you can input CNAME information with this.<br>
     * <b>$address</b> If you specify value A in $type you can input IP Address information with this.<br>
     * <b>$ttl</b> The new record's time to live in seconds.<br>
     * <b>$class</b> The class to be used for the record.<br>
     * 
     * @param type $domain string
     * @param type $name string
     * @param type $type string
     * @param type $txtdata string
     * @param type $cname string
     * @param type $address string
     * @param type $ttl integer
     * @param type $class string
     * @return type object
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
     * Edit an A, CNAME, or TXT record in a zone file, specified by line number. 
     * You must have access to both 'zoneedit' and 'simplezoneedit' features. 
     * This function does not work in DEMO mode. 
     * This function works nicely with fetch_zone() 
     * to easily fetch line number and record information, first.
     * 
     * 
     * Descriptions<br>
     * <b>$domain</b> The domain for which you wish to edit. <br>
     * <b>$line</b> The line number of the zone file you wish to edit<br>
     * <b>$name</b> The name of the record. <br>
     * <b>$type</b> Acceptable values include 'A', 'CNAME', or 'TXT'.<br>
     * <b>$txtdata</b> If you specify value TXT in $type you can input TXT information with this.<br>
     * <b>$cname</b> If you specify value CNAME in $type you can input CNAME information with this.<br>
     * <b>$address</b> If you specify value A in $type you can input IP Address information with this.<br>
     * <b>$ttl</b> The new record's time to live in seconds.<br>
     * 
     * @param type $domain string
     * @param type $line integer
     * @param type $type string
     * @param type $txtdata string
     * @param type $cname string
     * @param type $address string
     * @param type $ttl integer
     * @param type $class string
     * @return type object
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
     * Remove lines from a DNS zone file. 
     * You may only remove A, TXT, and CNAME records with this function. 
     * You must have access to either 'zoneedit' or 'simplezoneedit' to use this function. 
     * You cannot use this function in DEMO mode.
     * 
     * Descriptions<br>
     * <b>$domain</b> The domain corresponding to the zone file from 
     * which you wish to remove a line.<br>
     * <b>$line</b>  The line number you wish to remove. 
     * To get line that you want to delete use fetch_zone method<br>
     * 
     * 
     * @param type $domain string
     * @param type $line integer
     * @return type object
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
     * Retrieve a list of zone modifications for a specific domain.
     * 
     * Descriptions<br>
     * <b>$domain</b> The domain whose zone modifications you wish to view.<br>
     * 
     * @param type $domain string
     * @return type object
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
     * Retrieve a list of your account's zones and zone file contents.
     * 
     * @return type object
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
     * Retrieve DNS zone information for a domain. 
     * The function's output is a list of hashes representing lines in the file.
     * Each column with data is represented as a hash item.
     * 
     * Descriptions<br>
     * <b>$domain</b> The domain that corresponds to the zone file you wish to retrieve.<br>
     * <b>$keys</b> Acceptable values include 'line', 'ttl', 'name', 'class', 'address', 'type', 'txtdata', 'preference', and 'exchange'. <br>
     * <b>customonly</b> If you set to 1 it will return only non-essential A and CNAME records<br>
     *
     * @param type $domain
     * @param type $key string
     * @param type $customonly integer
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
     * Revert a zone file to its original state.
     * 
     * Descriptions<br>
     * <b>$domain</b> The domain that corresponds to the zone file you wish to revert.<br>
     * 
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

