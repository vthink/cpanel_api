<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of cpanel_api_statsbar
 *
 * @author nunenuh@gmail.com
 */
class Cpanel_Api_Statsbar extends Cpanel_Api_Query{
    private $param=array();
    
    function __construct($param=array()) {
        $this->param = $param;
        parent::__construct($this->param);
    }
    
    /**
     * Retrieve statistics about an account. 
     * This will include software versions, program paths, and resource usage.
     * 
     * Descriptions<br>
     * <b>$display</b> 
     * A list of the statistics you would like to view.<br>
     * Each of these values should be separated by a pipe (|). <br>
     * (e.g. 'ftpaccounts|perlversion|cpanelrevision') <br>
     * <br>
     * Possible Value Are : <br>
     * 'ftpaccounts' 'perlversion' 'dedicatedip' <br>
     * 'hostname' 'operatingsystem' 'sendmailpath' <br>
     * 'autoresponders' 'perlpath' 'emailforwarders' <br>
     * 'bandwidthusage' 'emailfilters' 'mailinglists' <br>
     * 'diskusage' 'phpversion' 'sqldatabases' <br>
     * 'apacheversion' 'kernelversion' 'shorthostname' <br> 
     * 'parkeddomains' 'cpanelbuild' 'theme' <br>
     * 'addondomains' 'cpanelrevision' 'machinetype' <br>
     * 'cpanelversion' 'mysqldiskusage' 'mysqlversion' <br>
     * 'subdomains' 'postgresdiskusage' 'sharedip' <br>
     * 'hostingpackage' 'emailaccounts' <br>
     * 
     * @param type $display string
     * @return type object
     */
    public function stats($display){
        $input=array(
                    'module'    => 'StatsBar',
                    'function'  => 'stat',
                    'display'   => $display
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $ob->cpanelresult->data;
        
    }
    
    

    
}

?>
