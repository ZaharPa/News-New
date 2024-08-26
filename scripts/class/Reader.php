<?php
namespace scripts\class;

use scripts\interface\User; 


class Reader implements User
{
    private $name;
    private $role;
    
    
    public function set_name($link,$email)
    {
        $query = "SELECT name FROM users WHERE email = ?";
        $stmt = mysqli_prepare($link, $query);
        
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_array($result);
        
        if ($row)
            $this->name = $row['name'];
        else $this->name = null;
    }
    
    public function get_name()
    {
        return $this->name;
    }
    
    public function set_role($link, $email)
    {
        $query = "SELECT role FROM users WHERE email = ?";
        $stmt = mysqli_prepare($link, $query);
        
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_array($result);
        
        if ($row)
            $this->role = $row['role'];
            else $this->role = null;

    }
    
    public function get_role()
    {
        return $this->role;
    }
    
    private function hash_pass_user($password)
    {
        $newPass = password_hash($password, PASSWORD_DEFAULT);
        return $newPass;
    }
   
    public function reg_user($link, $name, $password, $email, $phone = null)
    {
        $stmt_check = mysqli_prepare($link, "SELECT * FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt_check, 's', $email);
        mysqli_stmt_execute($stmt_check);
        $result_check = mysqli_stmt_get_result($stmt_check);
        
        if ($result_check && mysqli_num_rows($result_check) < 1) {
            $hash_pass = $this->hash_pass_user($password);
            
            $stmt_insert = mysqli_prepare($link, "INSERT INTO users (name, password, email, phone) VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt_insert, 'ssss', $name, $hash_pass, $email, $phone);
            $result_insert = mysqli_stmt_execute($stmt_insert);
            
            if ($result_insert) {
                $this->set_name($link, $email);
                $this->set_role($link, $email);
                mysqli_stmt_close($stmt_check);
                mysqli_stmt_close($stmt_insert);
                return true;
            } else {
                die(mysqli_error($link));
            }
        } else {
            echo '<script language="javascript">';
            echo 'alert("Користувач з такою поштою вже існує")';
            echo '</script>';
            mysqli_stmt_close($stmt_check);
            return false;
        }
    }
    
    public function login_user($link, $email, $password)
    {
        $stmt = mysqli_prepare($link, "SELECT name, role, password FROM users WHERE email = ?");
        
        mysqli_stmt_bind_param($stmt, 's', $email);
        
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $passHash = $row['password'];
            
            if (password_verify($password, $passHash)) {
                $this->name = $row['name'];
                $this->role = $row['role'];
                return true;
            }
        }
        
        if (!$result) {
            die(mysqli_error($link));
        }
        
        return false;
    }
}
