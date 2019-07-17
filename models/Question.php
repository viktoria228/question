<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\data\Pagination;

class Question extends ActiveRecord
{

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
        $this->hash = Yii::$app->security->generateRandomString() . '_' . time();

        $this->save();
    }


    public function getAll()
    {
        $query = Question::find();

        $pages = new Pagination(['totalCount' => count($query)]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return ['models' => $models, 'pages' => $pages];
    }


    public static function getById($id)
    {
        return Question::findOne(['id' => $id]);
    }


    public static function getByHash($hash)
    {
        return Question::findOne(['hash' => $hash]);
    }
}