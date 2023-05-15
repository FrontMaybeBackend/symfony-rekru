<?php

namespace App\Entity;

class Register
{

    public  $username;
    public  $surname;
    public  $email;
    protected $password;

    public function getUsername() :string
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }


    /**
     * @return mixed
     */
    protected function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    protected function setPassword($password): void
    {
        $this->password = $password;
    }


}