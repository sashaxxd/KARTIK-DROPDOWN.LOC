<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\components\Multilevel;

//mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\PodguznikiProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="podguzniki-product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>



    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>







    <?php
    $parents = app\models\PodguznikCategory::find()->where(['parent_id'=>'0'])->all();
    $cat = new app\models\PodguznikCategory();
    $ml = new Multilevel();
    echo $form->field($model, 'cat')->dropDownList($ml->makeDropDown($parents,$cat), ['id' => 'cat-id', 'prompt' => 'Выбрать категорию', 'class'=>'form-control required',
        ]

    );
    ?>

    <?php
    if (!$model->isNewRecord )
    {
        $subcatList = \app\models\Dropdown::find()->where('id != drop_id and drop_id = :id', [':id' => $model->cat])->all();
        $subcatList_ = ArrayHelper::map($subcatList, 'id', 'name');
        $subcatList = ['' => 'Select...'];
        $subcatList = array_merge($subcatList, $subcatList_ );


        if (isset($model->subcat))
        {
            $subcatList = [$model->subcat => $model->subcat->name];
            unset($subcatList_[$model->subcat]);
            $subcatList = $subcatList + ['' => 'Выбрать...'];
        }
        else
        {
            $subcatList = ['' => 'Выбрать...'];
        }

        $subcatList = $subcatList + $subcatList_;
    }
    else
        $subcatList = [];

    echo $form->field($model, 'subcat')->widget(DepDrop::classname(), [
        'options' => ['id' => 'subcat-id',

        ],
        'data' => $subcatList,
        'pluginOptions' => [
            'depends' => ['cat-id'],
//            'initialize' => true, //Выводит значение при апдейте
            'placeholder' => 'Выбрать...',
            'url' => Url::to(['subcat'])
        ]
    ]);
    ?>











    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
