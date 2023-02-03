<?php

class RegisterUser
{
    private $raw_login;
    private $raw_password;
    private $confirmed_password;
    private $encrypted_password;
    private $raw_email;
    private $username;

    public $error;
    public $success;
    private $storage = "data.json";
    private $stored_users;
    private $new_user;

    public function __construct($username, $password)
    {

        $this->username = trim($this->username);
        $this->username = filter_var($username, FILTER_SANITIZE_STRING);

        $this->raw_password = filter_var(trim($password), FILTER_SANITIZE_STRING);
        $this->encrypted_password = password_hash($this->raw_password, PASSWORD_DEFAULT);

        $this->stored_users = json_decode(file_get_contents($this->storage), true);

        $this->new_user = [
            "username" => $this->username,
            "password" => $this->encrypted_password,
        ];

        if ($this->checkFieldValues()) {
            $this->insertUser();
        }
    }


    private function checkFieldValues()
    {
        if (empty($this->raw_login) ||
            empty($this->raw_password) ||
            empty($this->confirmed_password) ||
            empty($this->raw_email) ||
            empty($this->username)) {
            $this->error = "Все поля обязательны для заполнения";
            return false;
        } else if (raw_password !== confirmed_password) {
            $this->error = "Пароли не совпадают";
            return false;
        } else if (strlen($this->raw_login) < 6) {
            $this->error = "Длина логина - не менее 6 символов";
            return false;
        } else if (
            !(preg_match('@[A-Z]@', $this->raw_password)) ||
            !(preg_match('@[a-z]@', $this->raw_password)) ||
            !(preg_match('@[0-9]@', $this->raw_password)) ||
            strlen($this->raw_password) < 6
        ) {
            $this->error = "Пароль должен содержать цифры и буквы, длина минимум 6 символов";
            return false;
        }else if (!(filter_var($this->raw_email, FILTER_VALIDATE_EMAIL))) {
            $this->error = "Email указан неверно";
            return false;
        } else {
            return true;
        }
    }


    private function usernameExists()
    {
        foreach ($this->stored_users as $user) {
            if ($this->username == $user['username']) {
                $this->error = "Username already taken, please choose a different one.";
                return true;
            }
        }
        return false;
    }


    private function insertUser()
    {
        if ($this->usernameExists() == FALSE) {
            array_push($this->stored_users, $this->new_user);
            if (file_put_contents($this->storage, json_encode($this->stored_users, JSON_PRETTY_PRINT))) {
                return $this->success = "Your registration was successful";
            } else {
                return $this->error = "Something went wrong, please try again";
            }
        }
    }


} // end of class