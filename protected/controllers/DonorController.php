<?php

class DonorController extends Controller
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
				'actions'=>array('create','update'),
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
		$model=new Donor;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Donor']))
		{
			$message = '';
			$model->attributes=$_POST['Donor'];
			$model->created_at = date('Y-m-d');
			$model->created_by = Yii::app()->user->id;
			if($model->save()) {
				$message .= "New Donor [$model->first_name] has been created successfully.";
				//add donor to donation list
				if (isset(Yii::app()->session['live_camp_id'])) {
					$camp = Camp::model()->findByPK(Yii::app()->session['live_camp_id']);
					if($camp) {
						$donorCamp = new DonorCamp;
						$donorCamp->donor_id = $model->id;
						$donorCamp->camp_id = $camp->id;
						$donorCamp->created_at = date('Y-m-d');
						$donorCamp->created_by = Yii::app()->user->id;
						if($donorCamp->save()){
							$message .= " And has been allocated to camp [$camp->name]";
						}
					}
				}

				Yii::app()->user->setFlash('success', $message);

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

		if(isset($_POST['Donor']))
		{
			$model->attributes=$_POST['Donor'];
			if($model->save()) {
				Yii::app()->user->setFlash('success', "Donor has been updated successfully!");
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
		$donorText = implode(' ', array_filter([$model->first_name, $model->last_name]));

		if($model->delete()) {
			//delete donor from the donor list too
			DonorCamp::model()->deleteAll("donor_id = $id");
			Yii::app()->user->setFlash('success', "Donor [{$donorText}] has been deleted successfully!");
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
		$dataProvider=new CActiveDataProvider('Donor');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Donor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Donor']))
			$model->attributes=$_GET['Donor'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Donor the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Donor::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Donor $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='donor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
