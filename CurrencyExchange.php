<?php 
    require('connection.php');
    class CurrencyExchange extends Connection
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function registerUser($name,$email,$password,$phone,$address,$city,$state,$zip,$country)
        {
            $name=$this->db_connection->real_escape_string($name);
            $email=$this->db_connection->real_escape_string($email);
            $password=$this->db_connection->real_escape_string($password);
            $address=$this->db_connection->real_escape_string($address);
            $phone=$this->db_connection->real_escape_string($phone);
            $city=$this->db_connection->real_escape_string($city);
            $state=$this->db_connection->real_escape_string($state);
            $country=$this->db_connection->real_escape_string($country);
            $key=md5(time().$email);
            $password=md5($password);
            $sql="INSERT INTO user (u_name,u_email,u_pass,u_phone,u_address,u_city,u_state,u_zip,u_country,u_doc1,u_doc2,u_doc3,u_is_verify,u_status,u_msg,vkey) 
            VALUES ('$name','$email','$password','$phone','$address','$city','$state','$zip','$country','','','','0','0','0','$key')";
            try
            {
                $stmt=$this->db_connection->prepare($sql);
                if($stmt->execute())
                {
                    $to=$email;
                    $subject="Email verification form Currency Exchage";
                    $message="Hi $name,<br>Thank You for registering on Currency converter<br>Verify now and enjoy full features<br><a href='http://localhost/Currency Exchange/verify.php?vkey=$key'>Verify Email</a>";
                    $headers="From:thakurakhilesh20@gmail.com \r\n";
                    $headers.="MIME-Version:1.0"."\r\n";
                    $headers.="Content-type:text/html;charset-UTF-8"."\r\n";
                    mail($to,$subject,$message,$headers);
                    $stmt->close();
                    return true;
                }
                else
                {
                    return false;
                }
            }
            catch(Exception $e)
            {
                return false;
            }

        }

         public function getVerifiedKey($vkey)
        {
            $sql="SELECT vkey,u_is_verify FROM user WHERE vkey='$vkey' AND u_is_verify=0 LIMIT 1";
            try
            {
                $stmt=$this->db_connection->prepare($sql);
                if($stmt->execute())
                {
                    $result=$stmt->get_result();
                    $row_size=$result->num_rows;
                    if($row_size==1)
                    {
                        $stmt->close();
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
            }
            catch(Exception $e)
            {
                return false;
            }
        }

        public function updateVerification($vkey)
        {
            $sql="UPDATE user SET u_is_verify=1 WHERE vkey='$vkey'";
            try
            {
                $stmt=$this->db_connection->prepare($sql);
                if($stmt->execute())
                {
                    $stmt->close();
                   return true;
                }
                else
                {
                    return false;
                }
            }
            catch (Exception $e)
            {
                return false;
            }
        }

        public function userLogin($email,$password)
        {
            $email=$this->db_connection->real_escape_string($email);
            $password=$this->db_connection->real_escape_string($password);
            $pass=md5($password);
            $sql="SELECT * FROM user WHERE u_email='$email' AND u_pass='$pass'";
            try
            {
                $stmt=$this->db_connection->prepare($sql);
                if($stmt->execute())
                {
                    $result=$stmt->get_result();
                    $rowscount=$result->num_rows;
                    if($rowscount==1)
                    {
                        $stmt->close();
                        return $result;
                    }
                    else
                    {
                        $stmt->close();
                        return "in";
                    }
                }
                else
                {
                    $stmt->close();
                    return "some";
                }
            }
            catch (Exception $e)
            {
                $stmt->close();
                return "some";
            }
        }

        public function getEmail($email)
        {
            $email=$this->db_connection->real_escape_string($email);
            $sql="SELECT * FROM user WHERE u_email='$email'";
            try
            {
                $stmt=$this->db_connection->prepare($sql);
                if($stmt->execute())
                {
                    $result=$stmt->get_result();
                    $numrows=$result->num_rows;
                    if($numrows==1)
                    {
                        $stmt->close();
                        return true;
                    }
                    else
                    {
                        $stmt->close();
                        return false;
                    }
                }
                else
                {
                    $stmt->close();
                    return false;
                }
            }
            catch(Exception $e)
            {
                $stmt->close();
                return false;
            }
        }

        public function resetPassword($password,$email)
        {
            $password=$this->db_connection->real_escape_string($password);
            $password=md5($password);
            $sql="UPDATE user SET u_pass='$password' WHERE u_email='$email'";
            try
            {
                $stmt=$this->db_connection->prepare($sql);
                if($stmt->execute())
                {
                    $stmt->close();
                    return true;
                }
                else
                {
                    $stmt->close();
                    return false;
                }
            }
            catch (Exception $e)
            {
                $stmt->close();
                return false;
            }
        }

        public function uploadDocs($doc1,$doc2,$doc3,$id)
        {
            $doc1=$this->db_connection->real_escape_string($doc1);
            $doc2=$this->db_connection->real_escape_string($doc2);
            $doc3=$this->db_connection->real_escape_string($doc3);
            $update="UPDATE user SET u_doc1='$doc1',u_doc2='$doc2',u_doc3='$doc3' WHERE u_id='$id'";
            try
            {
                $stmt=$this->db_connection->prepare($update);
                if($stmt->execute())
                {
                    unset($_SESSION['user']);
                    $_SESSION['user']=$this->getUserById($id);
                    $stmt->close();
                    return true;
                }
                else
                {
                    $stmt->close();
                    return false;
                }
            }
            catch (Exception $e)
            {
                $stmt->close();
                return false;
            }
        }

        public function getUserById($id)
        {
            $sql="SELECT * FROM user WHERE u_id='$id'";
            $get=$this->db_connection->prepare($sql);
            if($get->execute())
            {
                $getresult=$get->get_result();
                $data=$getresult->fetch_assoc();
                $get->close();
                return $data;
            }
        }

        public function updateDoc($new,$id,$option)
        {   
            $sql="UPDATE user SET $option='$new' WHERE u_id='$id'";
            $update=$this->db_connection->prepare($sql);
            try
            {    
                if($update->execute())
                {
                    $this->updateStatus($id);
                    unset($_SESSION['user']);
                    $_SESSION['user']=$this->getUserById($id);
                    $update->close();
                    return true;
                }
                else
                {
                    $update->close();
                    return false;
                }
            }
            catch (Exception $e)
            {
                $update->close();
                return false;
            }
        }

        public function updateStatus($id)
        {
            $sql="UPDATE user SET u_status='0' WHERE u_id='$id'";
            $status=$this->db_connection->prepare($sql);
            if($status->execute())
            {
                $status->close();
                return true;
            }
        }

        public function updateUserDetails($id,$value,$key)
        {
            $value=$this->db_connection->real_escape_string($value);
            $sql="UPDATE user SET $key='$value' WHERE u_id='$id'";
            $status=$this->db_connection->prepare($sql);
            try 
            {
                if($status->execute())
                {
                    if($key=='u_address' || $key=='u_city' || $key=='u_zip' ||$key=='u_country' ||$key=='u_state')
                    {
                        $this->updateStatus($id);
                    }
                    if($key=='u_pass')
                    {
                        header("Location:../user_login.php");
                        unset($_SESSION['user']);
                        die();
                    }
                    $_SESSION['user'][$key]=$value;
                    $status->close();
                    return true;
                }
                else
                {
                    $status->close();
                    return false;
                }
            }
            catch(Exception $e)
            {
                $status->close();
                return false;
            }
        }

        public function updateVkey($id,$key)
        {
            $sql="UPDATE user SET vkey='$key' WHERE u_id='$id'";
            $status=$this->db_connection->prepare($sql);
            try
            {
                if($status->execute())
                {
                    $status->close();
                    return true;
                }
                else
                {
                    $status->close();
                    return false;
                }
            }
            catch (Exception $e)
            {
                $status->close();
                return false;
            }
        }
        public function updateIsVerify($id)
        {
            $sql="UPDATE user SET u_is_verify=0 WHERE u_id='$id'";
            $status=$this->db_connection->prepare($sql);
            try
            {
                if($status->execute())
                {
                    $status->close();
                    return true;
                }
                else
                {
                    $status->close();
                    return false;
                }
            }
            catch (Exception $e)
            {
                $status->close();
                return false;
            }
        }
        public function updateEmail($id,$value)
        {
            $value=$this->db_connection->real_escape_string($value);
            $sql="UPDATE user SET u_email='$value' WHERE u_id='$id'";
            $status=$this->db_connection->prepare($sql);
            $key=md5(time().$value);
            $isvkey=$this->updateVkey($id,$key);
            if($isvkey)
            {
                try
                {
                    if($status->execute())
                    {
                        $_SESSION['u_email']=$value;
                        $to=$value;
                        $subject="Email verification form Currency Exchage";
                        $message="Hi,<br>Update your email on Currency converter<br>Verify now and enjoy full features<br><a href='http://localhost/Currency Exchange/verify.php?vkey=$key'>Verify Email</a>";
                        $headers="From:thakurakhilesh20@gmail.com \r\n";
                        $headers.="MIME-Version:1.0"."\r\n";
                        $headers.="Content-type:text/html;charset-UTF-8"."\r\n";
                        mail($to,$subject,$message,$headers);
                        if($this->updateIsVerify($id))
                        {
                            echo "<script>alert('Email updated Successfully!!Verify your new email and then login again. Thannk you')</script>";
                            unset($_SESSION['user']);
                            header("Location:../user_login.php");

                        }
                        else
                        {
                            return false;
                        }
                        $status->close();   
                    }
                    else
                    {
                        $status->close();
                        return false;
                    }
                }
                catch(Exception $e)
                {
                    $status->close();
                    return false;
                }
            }
        }
    }
?>