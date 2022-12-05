<?php

class CampController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'LiveCamp'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Camp;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Camp']))
		{
			$model->attributes=$_POST['Camp'];

			$model->created_at = date('Y-m-d');
			$model->created_by = Yii::app()->user->id;
			if($model->save()) {
				$model->scheduled_date = date('Y-m-d', strtotime($model->scheduled_date));
				$this->redirect(array('view','id'=>$model->id));
			}
				
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Camp']))
		{
			$model->attributes=$_POST['Camp'];
			$model->updated_at = date('Y-m-d');
			if($model->save()) {
				$model->scheduled_date = date('Y-m-d', strtotime($model->scheduled_date));
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		$campName = $model->name;
		$donorCamp = DonorCamp::model()->find(array('condition' => "camp_id = {$id}"));

		if($donorCamp) {
			//cannot delete the camp, it is in use
			Yii::app()->user->setFlash('notice', "Cannot delete camp {$campName}! Donors have been allocated to this camp.");
			
		}

		if(!$donorCamp) {

			$model->delete();
			Yii::app()->user->setFlash('success', "Camp {$campName} has been deleted successfully!");
			
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Camp');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Camp('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Camp']))
			$model->attributes=$_GET['Camp'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


	/**
	 * Toggle live camp
	 * This will set a session with live camp Id
	 * @param integer $id the ID of the model to be set live
	 */
	public function actionLiveCamp($id)
	{
		$model=$this->loadModel($id);

		if (isset(Yii::app()->session['live_camp_id']) && Yii::app()->session['live_camp_id'] == $id) {
			unset(Yii::app()->session['live_camp_id']);
		} else {
			Yii::app()->session['live_camp_id'] = $id;
		}

		$this->redirect(array('view','id'=>$id));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Camp the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Camp::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Camp $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='camp-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
