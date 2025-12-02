<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Test Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Welcome!</h1>
    </div>

    <div class="body-content text-center">
        <p><a class="btn btn-lg btn-success" href="<?= Url::to(['apple/index']) ?>">View Apples</a></p>
    </div>
</div>
