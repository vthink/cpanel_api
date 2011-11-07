<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Description of cpanel_api_addon_domain
 *
 * @author nunenuh@gmail.com
 */
class Cpanel_Api_Addon_Domain extends Cpanel_Api_Query{
    private $param=array();
    function __construct($param) {
        $this->param = $param;
        parent::__construct($this->param);
    }
    
    /**
     * Delete an existing addon domain. 
     * This function will also remove the addon 
     * domain's subdomain and corresponding FTP username.
     * 
     * Descriptions<br>
     * <b>$domain</b> The addon domain do you wish to delete. <br>
     * <b>$subdomain</b> This value should contain the addon domain's username 
     * followed by an underscore (_), then the addon domain's main domain 
     * (e.g. addonuser_maindomain.com).<br>
     * 
     * @param type $domain
     * @param type $subdomain 
     * @return type object
     */
    public function delete_addon_domain($domain, $subdomain){
        $input=array(
                    'module'    => 'AddonDomain',
                    'function'  => 'deladdondomain',
                    'domain'    => $domain,
                    'subdomain' => $subdomain
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
    
    /**
     * Create an addon domain. 
     * This function will also create a subdomain.
     * 
     * Descriptions<br>
     * <b>$dir</b> The path that will serve as the addon domain's home directory.<br>
     * <b>newdomain</b> The domain name of the addon domain you wish to create. (e.g. sub.example.com).<br>
     * <b>subdomain</b> This value is the subdomain and FTP username corresponding to the new addon domain.<br>
     * 
     * @param type $dir string
     * @param type $new_domain string
     * @param type $subdomain string
     */
    public function add_addon_domain($dir, $new_domain, $subdomain){
        $input=array(
                    'module'    => 'AddonDomain',
                    'function'  => 'addaddondomain',
                    'dir'       => $dir,
                    'newdomain' => $new_domain,
                    'subdomain' => $subdomain
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
    
    /**
     * List all of the addon domains associated with your server.
     * 
     * Descriptions<br>
     * Regular expressions allow you to filter based on the domain key returned.
     *  
     * @param type $regex 
     * @return type object
     */
    public function list_addon_domains($regex=''){
        $input=array(
                    'module'    => 'AddonDomain',
                    'function'  => 'listaddondomains',
                    'regex'    => $regex
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
}
