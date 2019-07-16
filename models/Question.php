<?php
/**
 * Created by PhpStorm.
 * User: залупа
 * Date: 16-07-2019
 * Time: 21:56
 */

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Question extends ActiveRecord
{
    //public $id;
//    public $title;
//    public $userId;
//    public $likes;
//    public $dislikes;
//    public $template;


    public function rules()
    {
        return [
            ['title', 'required', 'message' => 'Поле не може бути пустим.'],
            ['title', 'trim'],
            ['title', 'string', 'min' => 10, 'max' => 1500, 'message' => 'Поле має містити він 4 до 200 символів.'],
            [['title', 'userId', 'likes', 'dislike', 'template'], 'safe'],
        ];
    }


    public static function tableName()
    {
        return 'question';
    }


    public function add() {
        $this->userId = Yii::$app->user->identity->getId();
        $this->likes = 0;
        $this->dislikes = 0;
        $this->template = 0;

        $this->save();
    }
    
}