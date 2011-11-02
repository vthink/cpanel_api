<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of cpanel_api_cron
 *
 * @author nunenuh@gmail.com
 */
class Cpanel_Api_Cron extends Cpanel_Api_Query{
    private $param=array();
    function __construct($param) {
        $this->param = $param;
        parent::__construct($this->param);
    }
    
    
    /**
     * Set the default notification email for the cron system.
     * 
     * Descriptions<br>
     * <b>$email</b> The email address that should 
     * receive notifications from the cron system.
     * 
     * @param type $email 
     * @return type object
     */
    public function set_email($email){
        $input=array(
                    'module'    => 'Cron',
                    'function'  => 'set_email',
                    'email'    => $email
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
    
    /**
     * Lists cronjobs by user. 
     * This function will include 
     * the sequence (num) and task of the cronjob.
     * 
     * @return type object
     */
    public function list_cron(){
        $input=array(
                    'module'    => 'Cron',
                    'function'  => 'listcron'
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
    
    /**
     * Add Crontab entry
     * 
     * Descriptions<br>
     * <b>$command</b> The command, script, or program you wish for your cronjob to execute.<br>
     * <b>$day</b> The day on which you would like this crontab entry to run. <br>
     * <b>$hour</b> The hour at which you would like this crontab entry to run. <br> 
     * <b>$minute</b> The minute at which you would like this crontab entry to run. <br>
     * <b>$month</b> The month you would like this crontab entry to run. <br>
     * <b>$weekday</b> The weekday on which you would like this crontab entry to run. <br>
     *  
     * @param type $command string
     * @param type $day string
     * @param type $hour string
     * @param type $minute string
     * @param type $month string
     * @param type $weekday string
     * @return type object
     */
    public function add_cron($command, $day, $hour, $minute, $month, $weekday){
        $input=array(
                    'module'    => 'Cron',
                    'function'  => 'add_line',
                    'command'   => $command,
                    'day'       => $day,
                    'hour'      => $hour,
                    'minute'    => $minute,
                    'month'     => $month,
                    'weekday'   => $weekday
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
    
    /**
     * Remove an entry from the crontab
     * 
     * Descriptions<br>
     * <b>$line</b> The line number of the crontab entry 
     * you wish to remove, as reported by listcron.<br>
     * 
     * @param type $line 
     * @return type object
     */
    public function remove_cron($line){
        $input=array(
                    'module'    => 'Cron',
                    'function'  => 'remove_line',
                    'line'      => $line
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
        
    }
    
    /**
     * This function returns the default notification 
     * email address for the authenticated user's crontab.
     * 
     * @return type object
     * 
     */
    public function get_email(){
        $input=array(
                    'module'    => 'Cron',
                    'function'  => 'get_email'
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
    
    /**
     * Edit Crontab entry
     * 
     * Descriptions<br>
     * <b>$command</b> The command, script, or program you wish for your cronjob to execute.<br>
     * <b>$day</b> The day on which you would like this crontab entry to run. <br>
     * <b>$hour</b> The hour at which you would like this crontab entry to run. <br> 
     * <b>$minute</b> The minute at which you would like this crontab entry to run. <br>
     * <b>$month</b> The month you would like this crontab entry to run. <br>
     * <b>$weekday</b> The weekday on which you would like this crontab entry to run. <br>
     * <b>$linekey</b> The linekey for the entry to be edited, as reported by listcron.<br>
     *  
     * @param type $command string
     * @param type $day string
     * @param type $hour string
     * @param type $minute string
     * @param type $month string
     * @param type $weekday string
     * @param type $linekey integer
     * @return type object
     * 
     */
    public function edit_cron($command, $day, $hour, $minute, $month, $weekday, $linekey){
        $input=array(
                    'module'    => 'Cron',
                    'function'  => 'add_line',
                    'command'   => $command,
                    'day'       => $day,
                    'hour'      => $hour,
                    'minute'    => $minute,
                    'month'     => $month,
                    'weekday'   => $weekday,
                    'linekey'   => $linekey
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
        
    }

    //put your code here
}

?>
