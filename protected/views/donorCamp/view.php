<?php
/* @var $this DonorCampController */
/* @var $model DonorCamp */

$this->breadcrumbs=array(
	'Donor Camps'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DonorCamp', 'url'=>array('index')),
	array('label'=>'Create DonorCamp', 'url'=>array('create')),
	array('label'=>'Update DonorCamp', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DonorCamp', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DonorCamp', 'url'=>array('admin')),
);
?>

<h1>View DonorCamp #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'donor_id',
		'camp_id',
		'created_at',
		'created_by',
	),
)); ?>
