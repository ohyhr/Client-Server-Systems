<?php


class UsersData
{
//Constructor for class users data
    protected $_user_id, $_username, $_password, $_email;
    public function __construct($dbRow) {
        $this->_user_id = $dbRow['user_id'];
        $this->_username = $dbRow['username'];
        $this->_password = $dbRow['password'];
        $this->_email = $dbRow['email'];
    }

    // Get methods for student data.
    public function getUserID() {
        return $this->_user_id;
    }

    public function getUsername() {
        return $this->_username;
    }

    public function getUser_pass() {
        return $this->_password;
    }

    public function getUser_email() {
        return $this->_email;
    }

}