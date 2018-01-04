<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Employee;
use common\models\AdminPost;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'index', 'home', 'forgot', 'new-password'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(array('site/home'));
        }

        $this->layout = 'login';
        $model = new Employee();
        $model->scenario = 'login';
        if ($model->load(Yii::$app->request->post()) && $model->login() && $this->setSession()) {

            return $this->redirect(array('site/home'));
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Set Session.
     *
     * @return Session Array
     */
    public function setSession() {
        $post = AdminPost::findOne(Yii::$app->user->identity->post_id);
        if (!empty($post)) {
            Yii::$app->session['post'] = $post->attributes;
            Yii::$app->session['encrypted_user_id'] = Yii::$app->EncryptDecrypt->Encrypt('encrypt', Yii::$app->user->identity->post_id);
            return true;
        } else {
            return FALSE;
        }
    }

    public function actionHome() {
        if (isset(Yii::$app->user->identity->id)) {
            if (Yii::$app->user->isGuest) {
                return $this->redirect(array('site/index'));
            }
            return $this->render('index');
        } else {
            throw new \yii\web\HttpException(2000, 'Session Expired.');
        }
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
