<?php

/** 
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

use common\models\Apple;
use common\models\FallForm;
use common\models\TakeABitForm;
use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Apples';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4 mb-3">
                <?
                        echo Html::a('Add new Apple', ['/apple/create'], ['class' => 'btn btn-primary']);
                ?>
                <br>
                <br>
                <br>
                <?
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'id',
                            'color',
                            'status',
                            'intact_percent',
                            [
                                'attribute' => 'action',
                                'content' => function (Apple $apple) {
                                    if ($apple->canFall()) {
                                        return $this->render(
                                            '_fall',
                                            ['fallForm' => new FallForm(['apple_id' => $apple->id])
                                        ]);
                                    }
                                    if ($apple->canTakeABit()) {
                                        return $this->render(
                                            '_take_a_bit',
                                            [
                                                'takeABitForm' => new TakeABitForm(['apple_id' => $apple->id]),
                                                'maxPercent' => $apple->intact_percent
                                            ]
                                        );
                                    }
                                },
                            ],
                        ],
                    ]);
                ?>
            </div>
        </div>

    </div>
</div>