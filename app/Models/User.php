<?php

namespace App\Models;

use MF\Model\Model;

class User extends Model
{

    private $iduser;
    private $username;
    private $passwd;
    private $user_name;
    private $permission;

    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function getAllUsers()
    {
        $users = "SELECT * FROM tb_users";
        $stmt = $this->db->query($users);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getUser()
    {
        $user = "SELECT * FROM tb_users WHERE IDUSER=:iduser";
        $stmt = $this->db->query($user);
        $stmt->bindValue(':iduser', $this->__get('iduser'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function saveUser()
    {
        $user = "INSERT INTO tb_users(username, passwd, user_name, permission) VALUES(:username, :passwd, :user_name, :permission)";
        $stmt = $this->db->query($user);
        $stmt->bindValue(':username', $this->__get('username'));
        $stmt->bindValue(':passwd', $this->__get('passwd'));
        $stmt->bindValue(':user_name', $this->__get('user_name'));
        $stmt->bindValue(':permission', $this->__get('permission'));
        $stmt->execute();

        return $this;
    }

    public function changeUser()
    {
        $user = "UPDATE tb_users SET username=:username, passwd=:passwd, user_name=:user_name, permission=:permission";
        $stmt = $this->db->query($user);
        $stmt->bindValue(':username', $this->__get('username'));
        $stmt->bindValue(':passwd', $this->__get('passwd'));
        $stmt->bindValue(':user_name', $this->__get('user_name'));
        $stmt->bindValue(':permission', $this->__get('permission'));
        $stmt->execute();

        return $this;
    }

    public function deleteUser()
    {
        $user = "DELETE FROM tb_users WHERE IDUSER=:iduser";
        $stmt = $this->db->query($user);
        $stmt->bindValue(':iduser', $this->__get('iduser'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
