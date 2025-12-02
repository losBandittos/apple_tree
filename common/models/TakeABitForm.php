<?php

namespace common\models;

use yii\base\Model;

class TakeABitForm extends Model
{
    public $apple_id;
    public $percent;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['apple_id','percent'], 'required'],
            ['apple_id', 'integer'],
            ['percent', 'integer', 'min' => 0, 'max' => 100],
        ];
    }
}
