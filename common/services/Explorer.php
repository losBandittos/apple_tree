<?php

namespace common\services;

use common\models\Apple;
use yii\data\ActiveDataProvider;

class Explorer {
    static function getApplesProvider(): ActiveDataProvider {
        return new ActiveDataProvider([
            'query' => Apple::find()->where(['not', ['status' => Apple::STATUS_EMPTY]]),
            'pagination' => false,
            'sort' => false
        ]);
    }
}
