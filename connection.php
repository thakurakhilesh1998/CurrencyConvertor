<?php 
    require('config.php');
    class Connection
    {
        protected $db_connection;
        public function __construct()
        {
            $this->db_connection=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME,DB_PORT);
            if($this->db_connection->connect_errno)
            {
                die("Error Connecting to Server".$this->db_connection->connect_error);
                return;
            }
            $this->db_connection->set_charset(DB_CHARSET);
        }
    }
?>