<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Login extends ActiveRecord
{
    public $username;
    public $password;
    public $email;
    public $rememberMe = true;

    private $_user = false;



    public function rules()
    {
        return [
            [['username', 'password'], 'required', 'message' => 'Поле не може бути пустим.'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword', ],
        ];
    }


    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Невірний логін або пароль');
            }
        }
    }


    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }


    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
