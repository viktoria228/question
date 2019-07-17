<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\Question;

class QuestionController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }



    public function actionIndex()
    {
        $model = new Question();
        $param = $model->getAll();

        if ($model->load(Yii::$app->request->post())) {
            $model->add();
            return $this->goHome();
        }

        return $this->render('index', [
            'model' => $model,
            'param' => $param,
        ]);
    }


    public function actionDetail($id = null)
    {
        $this->layout = 'question';

        if ($id == null) {
            return $this->goBack();
        }

        $question = Question::getById($id);
        if (!$question) {
            return $this->goBack();
        }

        return $this->render('detail', [
            'question' => $question,
        ]);
    }


    public function actionAgree($id = null)
    {
        if ($id == null) {
            $this->goBack();
        }

        $model = Question::getById($id);
        $model->agree += 1;
        $model->save();

        return $model->agree;
    }
}