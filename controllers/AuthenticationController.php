<?php

namespace app\controllers;

use app\models\Registration;
use app\models\Login;
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
                'only' => ['login', 'logout', 'index'],
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
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }


    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Login();
        if ($model->load(Yii::$app->request->post()) && $model->login())
        {
            return $this->goHome();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}