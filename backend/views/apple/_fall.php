<?php

/** 
 * @var common\models\FallForm $fallForm
 */
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
            'id' => 'fall-form',
            'action' => ['apple/fall'],
            'options' => ['class' => 'form-horizontal'],
]);
echo $form->field($fallForm, 'apple_id')->hiddenInput(['value' => $fallForm->apple_id])->label(false);?>

<div class="form-group">
    <?=Html::submitButton('Сорвать', ['class' => 'btn btn-primary']);?>
</div>

<?ActiveForm::end();?>