<?php
    require('connection.php');
    class UpdateModal extends Connection
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function updateForm($value,$id,$field)
        {
            $value=$this->db_connection->real_escape_string($value);
            $sql="UPDATE user SET $field='$value' WHERE u_id='$id'";
            $stmt=$this->db_connection->prepare($sql);
        }
    }

       
?>