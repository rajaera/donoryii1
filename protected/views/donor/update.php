<?php
/* @var $this DonorController */
/* @var $model Donor */

$this->breadcrumbs=array(
	'Donors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Donor', 'url'=>array('index')),
	array('label'=>'Create Donor', 'url'=>array('create')),
	array('label'=>'View Donor', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Donor', 'url'=>array('admin')),
);
?>

<h1>Update Donor <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>