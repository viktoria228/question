<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\Security;

class Registration extends ActiveRecord
{
    public $username;
    public $password;
    public $password2;
    public $email;
    public $rememberMe = true;


    public static function tableName()
    {
        return 'user';
    }


    public function rules()
    {
        return [
            [['username', 'password', 'password2', 'email'], 'required', 'message' => 'Поле не може бути пустим.'],
            [['username', 'password', 'password2', 'email'], 'trim'],
            [['username', 'password', 'password2', 'email'], 'string', 'min' => 4, 'max' => 200, 'message' => 'Поле має містити він 4 до 200 символів.'],
            [['email', 'username'], 'unique', 'message' => 'Таке значення вже існує'],
            ['email', 'email', 'message' => 'Емайл вказано не коректно'],
            ['password', 'compare', 'compareAttribute' => 'password2', 'message' => 'Паролі не збігаються'],
            ['rememberMe', 'boolean'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'username' => 'Логін',
            'password' => 'Пароль',
            'password2' => 'Повторіть пароль',
            'email' => 'Емайл',
            'rememberMe' => 'Запам\'ятати',
        ];
    }

    public function registration()
    {

        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }


    private function getPasswordHash()
    {
        return Yii::$app->getSecurity()->generatePasswordHash($this->password);
    }


    private function generateAuthKey()
    {
        return Yii::$app->getSecurity()->generateRandomString();
    }

}