<?php
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
     *
     * @param type $display
     * @return type 
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
