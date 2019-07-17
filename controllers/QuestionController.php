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
                'only' => ['index', 'vote', 'detail'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['vote', 'detail'],
                        'allow' => true,
                        'roles' => ['?', '@'],
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

        $question = Question::getByHash($id);
        if (!$question) {
            return $this->goBack();
        }


        return $this->render('detail', [
            'question' => $question,
        ]);
    }


    public function actionVote($id = null, $status = 'agree')
    {
        if ($id == null) {
            $this->goBack();
        }

        $model = Question::getByHash($id);
        if (!$model) {
            return $this->goBack();
        }

        switch ($status) {
            case 'agree': $model->agree += 1; break;
            case 'stop': $model->stop += 1; break;
            case 'against': $model->against += 1; break;
            default: $model->agree += 1;
        }

        $model->countUser += 1;
        $model->save();

        return $this->redirect(['question/detail', 'id' => $id]);
    }
}