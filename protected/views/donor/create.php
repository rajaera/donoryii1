<?php
/* @var $this DonorController */
/* @var $model Donor */

$this->breadcrumbs=array(
	'Donors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Donor', 'url'=>array('index')),
	array('label'=>'Manage Donor', 'url'=>array('admin')),
);
?>

<h1>Create Donor</h1>
<?php
	if (isset(Yii::app()->session['live_camp_id'])) {
		$camp = Camp::model()->findByPk(Yii::app()->session['live_camp_id']);
		echo '<h3 style="color: green;">'.$camp->name.' has been set as live one. Donor will be auto allocated to this camp.</h3>';
	}
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>