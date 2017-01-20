<?php

namespace app\controllers;

use Yii;
use app\models\Compra;
use app\models\CompraSearch;
use app\models\CompraForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
* ComprasController implements the CRUD actions for Compra model.
*/
class ComprasController extends Controller
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
    * Lists all Compra models.
    * @return mixed
    */
   public function actionIndex()
   {
      $compra = new Compra;
      $total = $compra->getTotal();

      $pr = $compra->pruebaFind();

       $searchModel = new CompraSearch();
       $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

       return $this->render('index',[
           'searchModel' => $searchModel,
           'dataProvider' => $dataProvider,
           'total' => $total,
           'pr',$pr,
       ]);
   }

   /**
    * Displays a single Compra model.
    * @param integer $id
    * @return mixed
    */
   public function actionView($id)
   {
       return $this->render('view', [
           'model' => $this->findModel($id),
       ]);
   }


   /**
    * Updates an existing Compra model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id
    * @return mixed
    */
   public function actionUpdate($id)
   {
       $model = $this->findModel($id);

       if ($model->load(Yii::$app->request->post()) && $model->save()) {
           return $this->redirect(['view', 'id' => $model->id]);
       } else {
           return $this->render('update', [
               'model' => $model,
           ]);
       }
   }

   /**
    * Deletes an existing Compra model.
    * If deletion is successful, the browser will be redirected to the 'index' page.
    * @param integer $id
    * @return mixed
    */
   public function actionDelete($id)
   {
       $this->findModel($id)->delete();

       return $this->redirect(['index']);
   }

   /**
    * Finds the Compra model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return Compra the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
   protected function findModel($id)
   {
       if (($model = Compra::findOne($id)) !== null) {
           return $model;
       } else {
           throw new NotFoundHttpException('The requested page does not exist.');
       }
   }

    public function actionComprar()
    {
        $model = new CompraForm;

        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $compra = new Compra;
            if ($compra->comprar($model->producto,$model->cliente,$model->precio)) {
                # code...
                return $this->render('comprar',['model'=>$model]);
            }
        }
        else {
            return $this->render('comprar',['model'=>$model]);
        }
    }

    public function actionCompra_tabla()
    {
      $buy = Compra::find()->all();
      return $this->render('compra_tabla',[
         'buy'=>$buy,
      ]);
   }

}
