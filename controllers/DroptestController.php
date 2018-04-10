<?php

namespace app\controllers;

use Yii;
use app\models\Droptest;
use app\models\DroptestSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use app\models\Dropdown;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * DroptestController implements the CRUD actions for Droptest model.
 */
class DroptestController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Droptest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DroptestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Droptest model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Droptest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Droptest();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Droptest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Droptest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Droptest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Droptest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Droptest::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionSubcat()
    {


        $out = [];
        if (isset($_POST['depdrop_parents']))
        {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null)
            {
                $cat_id = $parents[0];
                $catList = Dropdown::find()->where('drop_id = :id and id != drop_id', [':id' => $cat_id])->all();
                $out = ArrayHelper::map($catList, 'id', 'name');
                $result = [];
                $tmp_arr = [];
                foreach($out as $key => $value)
                {
                    $tmp_arr = ['id' => $key, 'name' => $value];
                    $result[] = $tmp_arr;
                }
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]




                return Json::encode(['output' => $result, 'selected' => '']);
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }
    public function actionSize()
    {
        $out = [];
        if (isset($_POST['depdrop_parents']))
        {
            $parents = $_POST['depdrop_parents'];

            if ($parents != null)
            {
                $cat_id = $parents[0];
                $catList = \app\models\Dropdown::find()->where('drops_id = :id and id != drops_id', [':id' => $cat_id])->all();
                $out = ArrayHelper::map($catList, 'id', 'name');
                $result = [];
                $tmp_arr = [];
                foreach($out as $key => $value)
                {
                    $tmp_arr = ['id' => $key, 'name' => $value];
                    $result[] = $tmp_arr;
                }
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]

                echo Json::encode(['output' => $result, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }
}
