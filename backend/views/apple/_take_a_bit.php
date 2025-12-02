<?php

/** 
 * @var common\models\TakeABitForm $takeABitForm
 * @var int $maxPercent
 */
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
            'id' => 'take-a-bit-form',
            'action' => ['apple/take-a-bit'],
            'options' => ['class' => 'form-horizontal'],
]);
?>

<div class="card" style="width: 50%; float: left;">
    <?= $form->field($takeABitForm, 'apple_id')->hiddenInput(['value' => $takeABitForm->apple_id])->label(false);?>
    <?= $form->field($takeABitForm, 'percent')->textInput([
        'placeholder' => "0-$maxPercent"
    ])->label(false);?>
</div>

<div class="card" style="width: 50%; float: right;">
        <?=Html::submitButton('Откусить', ['class' => 'btn btn-primary']);?>
</div>

<?ActiveForm::end();?>