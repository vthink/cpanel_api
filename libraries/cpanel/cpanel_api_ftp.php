<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
     * List FTP accounts associated with the authenticated user's account.
     * 
     * Descriptions<br>
     * <b>$include_acct_types</b> This parameter allows you to specify which FTP account types you wish to view.<br>
     * <b>$skip_acct_types</b> This parameter allows you to exclude certain FTP account types from the list. <br>
     * 
     * @param type $include_acct_types string
     * @param type $skip_acct_types string
     * @return type object
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
     * Retrieve a list of FTP sessions 
     * associated with the authenticated account.
     * 
     * @return type object
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
     * Generate a list of FTP accounts associated with a cPanel account.
     * The list will contain each account's disk information.
     * 
     * Descriptions<br>
     * <b>$dirhtml</b> This parameter allows you to prepend the 'dir' return variable with a URL.<br>
     * <b>$include_acct_types</b> This parameter allows you to specify the type of FTP account you wish to view.<br>
     * <b>$skip_acct_types</b> This parameter allows you to exclude certain FTP account types from the list.<br>
     * 
     * @param type $dirhtml string
     * @param type $include_acct_types string
     * @param type $skip_acct_types string
     * @return type object
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
     * Change an FTP account's password. 
     * This function is only available in cPanel 11.27.x and later.
     * 
     * Descriptions<br>
     * <b>$user</b> The name of the FTP account whose password should be changed.<br>
     * <b>pass</b> The new password for the FTP account.<br>
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
     * Add a new FTP account. 
     * This function is only available in cPanel 11.27.x and later.
     * 
     * Descriptions<br>
     * <b>$user</b> The name of the new FTP account.<br>
     * <b>$pass</b> The password for the new FTP account.<br>
     * <b>$quota</b> quota of ftp account (0 for unlimited)<br>
     * <b>$homedir</b> The path to the FTP account's root directory (public_html).<br>
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
     * Change an FTP account's quota. 
     * This function is only available in cPanel 11.27.x and later.
     * 
     * Descriptions<br>
     * <b>$user</b> The name of the FTP account whose quota should be changed.<br>
     * <b>$quota</b> The new quota (in megabytes) for the FTP account.<br>
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
     * Delete an FTP account.
     * This function is only available in cPanel 11.27.x and later.
     * 
     * Descriptions<br>
     * <b>$user</b> The name of the FTP account to be removed.
     * <b>$destroy</b> if value 1 directory is deleted to, default value is 0
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
