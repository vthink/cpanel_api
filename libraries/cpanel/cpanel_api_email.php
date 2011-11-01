<?php
/**
 * Description of Cpanel_Api
 *
 * @author nunenuh@gmail.com
 */
class Cpanel_Api_Email extends Cpanel_Api_Query{
    private $param=array();
    
    function __construct($param=array()) {
        $this->param = $param;
        parent::__construct($param);
    }
    
    /**
     *
     * @return type array of object
     * 
     */
    public function  list_mail(){
        $input=array(
                    'module'    => 'Email',
                    'function'  => 'listpopswithdisk'
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
    
    
    /**
     * @param type $domain string
     * @param type $email string
     * @param type $password string
     * @param type $quota integer
     * @return type boolean (true/false)
     */
    public function add_mail($domain, $email, $password, $quota){
        $input=array(
                    'module'    => 'Email',
                    'function'  => 'addpop',
                    'domain'    => $domain,
                    'email'     => $email,
                    'password'  => $password,
                    'quota'     => $quota
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
    
    /**
     *
     * @param type $domain
     * @param type $email
     * @param type $quota
     * @return type 
     */
    public function edit_mail_quota($domain, $email, $quota){
        $input=array(
                    'module'    => 'Email',
                    'function'  => 'editquota',
                    'domain'    => $domain,
                    'email'     => $email,
                    'quota'     => $quota
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
    
    /**
     *`
     * @param type $domain
     * @param type $email
     * @return type 
     */
    public function delete_mail($domain, $email){
        $input=array(
                    'module'    => 'Email',
                    'function'  => 'delpop',
                    'domain'    => $domain,
                    'email'     => $email
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
    
    /**
     *
     * @param type $domain string
     * @param type $email string
     * @param type $new_password string
     * @return type 
     */
    public function update_mail_password($domain, $email, $new_password){
        $input=array(
                    'module'    => 'Email',
                    'function'  => 'passwdpop',
                    'domain'    => $domain,
                    'email'     => $email,
                    'password'  => $new_password
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
    
    /**
     *
     * @param type $domain string
     * @return type 
     */
    public function list_mx($domain=''){
        $input=array(
                    'module'    => 'Email',
                    'function'  => 'listmxs'
               );
        !empty($domain) && array_push($input, array('domain' => $domain));
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $ob->cpanelresult->data;
    }
    
    /**
     *
     * @param type $domain
     * @param type $exchange
     * @param type $preference
     * @param type $always_accept
     * @return type 
     */
    public function add_mx($domain, $exchange, $preference, $always_accept=''){
        $input=array(
                    'module'        => 'Email',
                    'function'      => 'addmx',
                    'domain'        => $domain,
                    'exchange'      => $exchange,
                    'preference'    => $preference
               );
        !empty($always_accept) && array_push($input, array('alwaysaccept' => $always_accept));
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $ob->cpanelresult->data;
    }
    
    /**
     *
     * @param type $domain
     * @param type $exchange
     * @param type $old_exchange
     * @param type $old_preference
     * @param type $preference
     * @param type $always_accept
     * @return type 
     */
    public function change_mx($domain, $exchange, $old_exchange, $old_preference, $preference, $always_accept=''){
        $input=array(
                    'module'        => 'Email',
                    'function'      => 'changemx',
                    'domain'        => $domain,
                    'exchange'      => $exchange,
                    'oldexchange'   => $old_exchange,
                    'oldpreference' => $old_preference,
                    'preference'    => $preference
               );
        !empty($always_accept) && array_push($input, array('alwaysaccept' => $always_accept));
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $ob->cpanelresult->data;
    }
    
    /**
     *
     * @param type $domain
     * @param type $exchange
     * @param type $preference
     * @return type 
     */
    public function delete_mx($domain, $exchange, $preference){
        $input=array(
                    'module'        => 'Email',
                    'function'      => 'delmx',
                    'domain'        => $domain,
                    'exchange'      => $exchange,
                    'preference'    => $preference
               );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $ob->cpanelresult->data;
    }
    
    /**
     *
     * @param type $domain
     * @param type $mxcheck
     * @return type 
     */
    public function set_mx_check($domain, $mxcheck){
         $input=array(
                    'module'        => 'Email',
                    'function'      => 'setmxcheck',
                    'domain'        => $domain,
                    'mxcheck'       => $mxcheck
               );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $ob->cpanelresult->data;
    }
    
    /**
     *
     * @param type $domain
     * @param type $regex
     * @return type 
     */
    
    public function list_forwarders($domain='', $regex=''){
        $input=array(
                    'module'        => 'Email',
                    'function'      => 'listforwards'
               );
        
        !empty($domain) && array_push($input, array('domain' =>$domain));
        !empty($regex) && array_push($input, array('regex' =>$regex));
        
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $ob->cpanelresult->data;
    }
    
    /**
     *
     * @param type $domain
     * @param type $email
     * @param type $fwdopt
     * @param type $fwdemail
     * @param type $fwdsystem
     * @param type $failmsgs
     * @param type $pipefwd
     * @return type 
     */
    public function add_forwader($domain, $email, $fwdopt, 
                                 $fwdemail='', $fwdsystem='',$failmsgs='',$pipefwd=''){
        $input=array(
                    'module'        => 'Email',
                    'function'      => 'addforward',
                    'domain'        => $domain,
                    'email'         => $email,
                    'fwdopt'        => $fwdopt
               );
        !empty($fwdemail) && array_push($input, array('fwdemail' =>$fwdemail));
        !empty($fwdsystem) && array_push($input, array('fwdsystem' =>$fwdsystem));
        !empty($failmsgs) && array_push($input, array('failmsgs' =>$failmsgs));
        !empty($pipefwd) && array_push($input, array('failmsgs' =>$pipefwd));
        
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $ob->cpanelresult->data;
    }
    
    
    /**
     *
     * @param type $domain
     * @return type 
     */
    public function list_default_adresses($domain){
        $input=array(
                    'module'        => 'Email',
                    'function'      => 'listdefaultaddresses',
                    'domain'        => $domain
               );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $ob->cpanelresult->data;
    }
    
    /**
     *
     * @param type $fwdopt
     * @param type $domain
     * @param type $failmsgs
     * @param type $fwdemail
     * @param type $pipefwd
     * @return type 
     */
    public function set_default_address($fwdopt, $domain, $failmsgs='', $fwdemail='', $pipefwd=''){
        $input=array(
                    'module'        => 'Email',
                    'function'      => 'setdefaultaddress',
                    'fwdopt'        => $fwdopt,
                    'domain'        => $domain
               );
        !empty($fwdemail) && array_push($input, array('fwdemail' =>$fwdemail));
        !empty($failmsgs) && array_push($input, array('failmsgs' =>$failmsgs));
        !empty($pipefwd) && array_push($input, array('failmsgs' =>$pipefwd));
        
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $ob->cpanelresult->data;
    }
    
    


}