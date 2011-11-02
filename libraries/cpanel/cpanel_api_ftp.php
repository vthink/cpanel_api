<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cpanel_api_ftp
 *
 * @author nunenuh@gmail.com
 */
class Cpanel_Api_Ftp extends Cpanel_Api_Query {
    private $param=array();
    function __construct($param) {
        $this->param = $param;
        parent::__construct($this->param);
    }
    
    /**
     *
     * @param type $include_acct_types
     * @param type $skip_acct_types
     * @return type 
     */
    public function list_ftp($include_acct_types, $skip_acct_types){
        $input=array(
                    'module'                => 'Ftp',
                    'function'              => 'listftp',
                    'include_acct_types'    => $include_acct_types,
                    'skip_acct_types'       => $skip_acct_types
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
    public function list_ftp_sessions(){
        $input=array(
                    'module'                => 'Ftp',
                    'function'              => 'listftpsessions'
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
    
    /**
     *
     * @param type $dirhtml
     * @param type $include_acct_types
     * @param type $skip_acct_types
     * @return type 
     */
    public function list_ftp_with_disk($dirhtml, $include_acct_types='', $skip_acct_types=''){
        $input=array(
                    'module'    => 'Ftp',
                    'function'  => 'listftpwithdisk',
                    'dirhtml'   => $dirhtml
                    );
        !empty($include_acct_types) && array_push($input, array('include_acct_types' => $include_acct_types));
        !empty($skip_acct_types) && array_push($input, array('skip_acct_types' => $skip_acct_types));
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
    
    /**
     *
     * @param type $user
     * @param type $new_pass
     * @return type 
     */
    public function passwd($user, $new_pass){
        $input=array(
                    'module'    => 'Ftp',
                    'function'  => 'passwd',
                    'user'      => $user,
                    'pass'      => $new_pass
                    );
        
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
    
    /**
     *
     * @param type $user
     * @param type $pass
     * @param type $quota
     * @param type $homedir
     * @return type 
     */
    public function add_ftp($user, $pass, $quota, $homedir){
        $input=array(
                    'module'    => 'Ftp',
                    'function'  => 'addftp',
                    'user'      => $user,
                    'pass'      => $pass,
                    'quota'     => $quota,
                    'homedir'   => $homedir
                    );
        
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
    
    /**
     *
     * @param type $user
     * @param type $quota
     * @return type 
     */
    public function set_quota($user, $quota){
        $input=array(
                    'module'    => 'Ftp',
                    'function'  => 'setquota',
                    'user'      => $user,
                    'quota'     => $quota
                    );
        
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
    
    /**
     *
     * @param type $user
     * @param type $destroy
     * @return type 
     */
    public function delete_ftp($user,$destroy=false){
        $input=array(
                    'module'    => 'Ftp',
                    'function'  => 'delftp',
                    'user'      => $user,
                    'destroy'   => $destroy
                    );
        
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }

}

?>
