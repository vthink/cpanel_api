<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of cpanel_api_mysql
 *
 * @author nunenuh@gmail.com
 * @modified by: Dean Elzey @ BitShout
 */
class Cpanel_Api_Mysql extends Cpanel_Api_Query{
    private $param=array();
    function __construct($param) {
        $this->param = $param;
        parent::__construct($this->param);
    }
    
    /**
     * Retrieve a list of permissions that 
     * correspond to a specific user and database.
     * 
     * Descriptions<br>
     * <b>$db</b> The database that corresponds to the user whose permissions you wish to view.<br>
     * <b>$user</b> The user whose permissions you wish to view.<br>
     * 
     * @param type $db
     * @param type $user
     * @return type object
     */
    public function user_db_privs($db, $user){
        $input=array(
                    'apiversion' => 2,
            		'module'    => 'MysqlFE',
                    'function'  => 'userdbprivs',
                    'db'        => $db,
                    'user'      => $user
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
    
    /**
     * Retrieve a list of databases that 
     * belong to a specific account.
     * 
     * Descriptions<br>
     * <b>$regex</b> This parameter allows you to filter based on a regular 
     * expression or string matching the db field.<br>
     * 
     * @param type $regex 
     * @return type object
     */
    public function list_dbs($regex=''){
        $input=array(
                    'apiversion' => 2,
        			'module'    => 'MysqlFE',
                    'function'  => 'listdbs'
                    );
        !empty($regex) && array_push($input, array('regex'=>$regex));
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
    
    /**
     * Retrieve a list of existing database backups.
     * @return type object
     */
    public function list_dbs_backup(){
       $input=array(
                    'apiversion' => 2,
        			'module'    => 'MysqlFE',
                    'function'  => 'listdbsbackup'
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
    /**
     * List users who can access a particular database.
     * 
     * Descriptions<br>
     * <b>$db</b> The name of the database whose users you wish to view. 
     * Be sure to use the cPanel convention's full MySQL database name. 
     * (e.g. cpaneluser_dbname)<br>
     * 
     * @param type $db string
     * @return type object
     */
    public function list_users_in_db($db){
        $input=array(
                    'apiversion' => 2,
        			'module'    => 'MysqlFE',
                    'function'  => 'listusersindb'
                    );
        !empty($db) && array_push($input, array('db'=>$db));
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
        
    }
    
    /**
     * Retrieve a list of remote MySQL connection hosts.
     * @return type object
     */
    public function list_hosts(){
        $input=array(
                    'apiversion' => 2,
        			'module'    => 'MysqlFE',
                    'function'  => 'listhosts'
                    );

        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
    }
    
    /**
     * List all of the MySQL users available to a cPanel account.
     * @return type object
     */
    public function list_users(){
        $input=array(
                    'apiversion' => 2,
        			'module'    => 'MysqlFE',
                    'function'  => 'listusers'
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $status=$ob->cpanelresult->data;
        
    }
    
    /**
     * Remove a user from MySQL.
     * @return type object
     */
    public function del_db_user($dbuser){
        $input=array(
        			'apiversion' => 1,            
        			'module'    => 'Mysql',
                    'function'  => 'deluser',
                    'arg-0'		=> $dbuser
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $ob->data->result;
    }

    /**
     * Remove a database from MySQL.
     * @return type object
     */
    public function del_db($db){
        $input=array(
                    'apiversion' => 1,            
        			'module'    => 'Mysql',
                    'function'  => 'deldb',
                    'arg-0'		=> $db
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $ob->data->result;
    }
    
	/**
     * Retrieve the number of databases currently in use.
     * 
     * @return type object
     */
    public function numb_dbs()
    {
        $input=array(
                    'apiversion' => 1,
        			'module'     => 'Mysql',
                    'function'   => 'number_of_dbs'
                    );
        $query=$this->build_query($input);
        $raw=$this->query($query);
        $ob=json_decode($raw, false);
        return $ob->data->result;
    }

}

?>
