<?php

namespace backend\controllers;

use common\models\Apple;
use common\models\FallForm;
use common\models\TakeABitForm;
use common\services\Explorer;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Apple controller
 */
class AppleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'fall', 'take-a-bit'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => Explorer::getApplesProvider(),
        ]);
    }

    public function actionCreate()
    {
        Apple::addAppleOnTree();
        return $this->redirect(['apple/index']);
    }

    public function actionFall()
    {
        $fallForm = new FallForm();
        if ($fallForm->load(Yii::$app->request->post())) {
            $apple = Apple::findOne(['id' => $fallForm->apple_id]);
            if ($apple !== null) {
                $apple->fall();
            }

        }
        return $this->redirect(['apple/index']);
    }

    public function actionTakeABit()
    {
        $takeABitForm = new TakeABitForm();
        if ($takeABitForm->load(Yii::$app->request->post())) {
            $apple = Apple::findOne(['id' => $takeABitForm->apple_id]);
            if ($apple !== null) {
                $apple->takeABit($takeABitForm->percent);
            }
        }
        return $this->redirect(['apple/index']);
    }
}
