<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
     * List email accounts associated with a particular domain. 
     * This function will also list quota and disk usage information.
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
     * Add (create) an e-mail account.
     * 
     * Description <br>
     * <b>$domain</b> Domain name for the e-mail account.<br>
     * <b>$email</b> The address part before "@".<br>
     * <b>$password</b> Password for the e-mail account.<br>
     * <b>$quota</b> Positive integer, 0 for unlimited<br>
     * 
     * @param type $domain string
     * @param type $email string
     * @param type $password string
     * @param type $quota integer
     * @return type boolean (true/false)
     * 

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
     * Modify an email account's quota.
     * 
     *  Description <br>
     * <b>$domain</b> Domain name for the e-mail account.<br>
     * <b>$email</b> The address part before "@".<br>
     * <b>$quota</b> Positive integer, 0 for unlimited<br>
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
     * Delete an Email Account
     * 
     * Description <br>
     * <b>$domain</b> Domain name for the e-mail account.<br>
     * <b>$email</b> The address part before "@".<br>
     * 
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
     * Change an email account's password.
     * Description <br>
     * <b>$domain</b> Domain name for the e-mail account.<br>
     * <b>$email</b> The address part before "@".<br>
     * <b>$new_password</b> The new password for the account<br>
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
     * List all mail exchangers associated with a domain.
     * 
     * Description <br>
     * <b>$domain</b> The domain whose mail exchangers you wish to view.<br>
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
     * Add an MX record. This function will not work if you do not have access to the 'changemx' feature.
     * 
     * Descriptions <br>
     * <b>$domain</b> The domain to which you wish to add the mail exchanger. <br>
     * <b>exchange</b> The name of the mail exchanger (e.g. mail.example.com). <br>
     * <b>$preference</b> priority of the mail exchanger.<br>
     * <b>$alwaysaccept</b> This value describes whether or not the local machine should accept mail for this domain. <br>
     * <br>
     * Possible values for $alwaysaccept are as follows<br>
     * <b>'auto'</b><br> 
     * Allow cPanel to determine the appropriate role based on a DNS query on the MX record.<br>
     * <b>'local'</b><br>
     * Always accept and route mail for the domain.<br>
     * <b>'secondary'</b><br>
     * Accept mail for the domain until a higher priority (lower numbered) mail server becomes available.<br>
     * <b>'remote'</b><br>
     * Do not accept mail for the domain. <br>
     * 
     * @param type $domain string
     * @param type $exchange string
     * @param type $preference integer
     * @param type $always_accept string
     * @return type object
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
     * Change values for a specific MX record.
     * This function is not available in DEMO mode. 
     * You must have access to the 'changemx' feature to use this function.
     * 
     * Descriptions <br>
     * <b>$domain</b> The domain corresponding to the MX record you wish to change.<br>
     * <b>$exchange</b> The name you wish to give to the new exchanger.<br>
     * <b>$oldexchange</b> The name of the exchanger you wish to replace.<br>
     * <b>$oldpreference</b> The priority value of the old exchanger. <br>
     * <b>$preference</b> The new exchanger's priority value. <br>
     * <b>$alwaysaccept</b> This parameter specifies how the new exchanger should behave. <br>
     * <br>
     * Possible values are for <b>$alwaysaccept</b> are : <br>
     * 'local', 'secondary', 'backup', or 'remote'. 
     *  If you choose not to specify this parameter, cPanel will choose the best possible value
     * 
     * @param type $domain string
     * @param type $exchange string
     * @param type $old_exchange string
     * @param type $old_preference integer
     * @param type $preference integer
     * @param type $always_accept string
     * @return type object
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
     * Delete an MX record. 
     * This function will not work if the 'changemx' feature is disabled for the current user.
     * 
     * Descriptions<br>
     * 
     * <b>$domain</b> The domain that corresponds to the mail exchanger you wish to remove. <br>
     * <b>$exchange</b> The name of the mail exchanger you wish to remove (e.g. 'mail.example.com').<br>
     * <b>$preference</b>  The priority of the mail exchanger, 0 being the highest priority exchanger. <br>
     * 
     * @param type $domain string
     * @param type $exchange string
     * @param type $preference integer
     * @return type object
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
     * Set a mail exchanger for a specified domain to local, remote, secondary, or auto. 
     * The 'auto' value allows cPanel to determine the appropriate role for the mail exchanger. 
     * Note: This function only affects the cPanel configuration. 
     * You will need to configure the MX's DNS entry elsewhere. 
     * Remember: This function is not available if the 'changemx' feature is not enabled for the user. 
     * Internally, this call functions as an alias to Email::setalwaysaccept. 
     * However, this call will be parsed as a unique call when used in a hook or custom event handler.
     * 
     * Descriptions<br>
     * <b>$domain</b> The domain corresponding to the mail exchanger you wish to set.<br>
     * <b>$mxcheck</b> The status of the mail exchanger as it corresponds to cPanel's configuration.<br>
     * <br>
     * Input options for <b>$mxcheck</b> are as follows:<br>
     * <b>'auto'</b> - Allow cPanel to determine the appropriate role based on a DNS query on the MX record.<br>
     * <b>'local'</b> - Always accept and route mail for the domain.<br>
     * <b>'secondary'</b> - Accept mail for the domain until a high priority (lower numbered) mail server becomes available.<br>
     * <b>'remote'</b> - Do not accept mail for the domain.<br>
     * 
     * @param type $domain string
     * @param type $mxcheck string
     * @return type object
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
     * List forwarders associated with a specific domain<br>
     * 
     * Descriptions <br>
     * <b>$domain</b> The domain name whose forwarders you wish to review. <br>
     * <b>$regex</b> Regular expressions allow you to filter results based on a set of criteria.<br>
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
     * Create an email forwarder for a specified address. 
     * You can forward mail to a new address or pipe incoming email to a program. <br>
     * 
     * Descriptions<br>
     * <b>$domain</b> The domain for which you wish to add a forwarder (e.g. example.com).<br>
     * <b>$email</b> The local address you wish to use as a forwarder (e.g. 'user' if the address was user@example.com)<br>
     * <b>$fwdopt</b> This parameter defines what type of forwarder should be used.<br>
     * The valid values for this option are: <br>
     * <b>'pipe'</b> - for forwarding to a program <br>
     * <b>'fwd'</b> - for forwarding to another non-system email address <br>
     * <b>'system'</b> - for forwarding to an account on the system <br>
     * <b>'blackhole'</b> - for bouncing emails using the blackhole functionality<br>
     * <b>'fail'</b> - for bounding emails using the fail functionality.<br>
     * <br>
     * <b>$fwdemail</b> The email address to which you want to forward mail.<br>
     * <b>$fwdsystem</b> The system account that you wish to forward email to, this should only be used if 'fwdopt' equals 'system'. <br>
     * <b>$failmsgs</b> If fwdopt is 'fail' this needs to be defined to determine the correct failure message. This should only be used if 'fwdopt' equals 'fail'. <br>
     * <b>$pipefwd</b> The path to the program to which you wish to pipe email. <br>
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
     * Retrieve the default address or action taken
     * when unroutable messages are received by the default address.
     *
     * Descriptions<br>
     * <b>$domain</b> The domain that corresponds to the default address and information you wish to view.<br>
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
     * Configure a default (catchall) email address. 
     * A default address handles unroutable mail sent to a domain. 
     * Note: Irrelevant parameters are passed to the function 
     * regardless of its configuration and will be included in the rule. 
     * This will not cause any problems.
     * 
     * Descriptions<br>
     * <b>$fwdopt</b> Describes how unroutable mail will be handled.<br> 
     * The following options are available:<br>
     * <b>'fail'</b> Bounce unroutable messages, returning a failure message to the sender.<br>
     * <b>'fwd'</b>Forward unroutable messages to another email address.<br>
     * <b>'blackhole'</b> Send undeliverable mail to /dev/null. <br>
     * <b>'pipe'</b> Pipe undeliverable mail to a program.<br><br>
     * <b>$domain</b> The domain to which the rule will apply. Note: The user must own this domain.<br>
     * <b>$failmsgs</b> Note: This parameter only takes effect if fwdopt = 'fail'.<br>
     * <b>$fwdemail</b> Note: This parameter only takes effect if fwdopt = 'fwd'. <br>
     * <b>$pipefwd</b>  Note: cPanel will append the user's home directory to the beginning of the value.<br>
     * 
     * @param type $fwdopt string
     * @param type $domain string
     * @param type $failmsgs string
     * @param type $fwdemail string
     * @param type $pipefwd string
     * @return type object
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