<?php
/* @var $this DonorCampController */
/* @var $model DonorCamp */

$this->breadcrumbs=array(
	'Donor Camps'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DonorCamp', 'url'=>array('index')),
	array('label'=>'Create DonorCamp', 'url'=>array('create')),
	array('label'=>'View DonorCamp', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DonorCamp', 'url'=>array('admin')),
);
?>

<h1>Update DonorCamp <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>