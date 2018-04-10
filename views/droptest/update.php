<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Droptest */

$this->title = 'Update Droptest: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Droptests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="droptest-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
