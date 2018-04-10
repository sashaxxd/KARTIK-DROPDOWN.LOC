<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Droptest */

$this->title = 'Create Droptest';
$this->params['breadcrumbs'][] = ['label' => 'Droptests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="droptest-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
