<?php

namespace common\models;

use yii\base\Model;

class FallForm extends Model
{
    public $apple_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['apple_id',], 'required'],
            ['apple_id', 'integer'],
        ];
    }
}
