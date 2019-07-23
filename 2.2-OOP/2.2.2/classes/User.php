<?php

class User extends DataRecordModel
{
    public $name;
    public $email;
    public $password;
    public $rate;

    public function addUserFromForm($formData)
    {
        $this->name = (string) $formData['name'];
        $this->email = (string) $formData['email'];
        $this->password = (string) $formData['password'];
        $this->rate = (int) $formData['rate'];
    }
}