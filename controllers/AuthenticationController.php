<?php

namespace app\controllers;

use app\models\Registration;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class AuthenticationController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
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

        $this->layout = "main-login";

        $model = new Registration();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->registration()){
                if (Yii::$app->getUser()->login($user)) {
                    Yii::$app->user->switchIdentity($user);
                    return $this->goHome();
                }
            }
            return $this->goBack();
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }


    public function actionLogin()
    {

    }


    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}