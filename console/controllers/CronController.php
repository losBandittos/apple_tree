<?php

namespace console\controllers;

use common\models\Apple;
use yii\console\Controller;

class CronController extends Controller {

    public function actionCheckAndDelete() {
        $applesToDelete = Apple::find()->where(['status' => Apple::STATUS_EMPTY])->all();
        foreach($applesToDelete as $apple) {
            $apple->delete();
        }
    }

    public function actionCheckAndRot() {
        $applesToRot = Apple::find()->where(['status' => Apple::STATUS_FELL])
            ->andWhere(['<', 'fell_at', time() - Apple::TIME_BEFORE_ROTTED])
            ->all();
        foreach($applesToRot as $apple) {
            $apple->makeRotten();
        }
    }
}
