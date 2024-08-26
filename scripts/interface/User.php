<?php
namespace scripts\interface;

interface User
{
    public function set_name($link, $email);
    public function get_name();
    public function set_role($link, $email);
    public function get_role();
    public function login_user($link, $email, $password);
    public function reg_user($link, $name, $password, $email, $phone = null);
}