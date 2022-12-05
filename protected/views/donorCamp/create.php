<?php
/* @var $this DonorCampController */
/* @var $model DonorCamp */

$this->breadcrumbs=array(
	'Donor Camps'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DonorCamp', 'url'=>array('index')),
	array('label'=>'Manage DonorCamp', 'url'=>array('admin')),
);
?>

<h1>Create DonorCamp</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>