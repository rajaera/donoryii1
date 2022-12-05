<?php
/* @var $this DonorController */
/* @var $model Donor */

$this->breadcrumbs=array(
	'Donors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Donor', 'url'=>array('index')),
	array('label'=>'Create Donor', 'url'=>array('create')),
	array('label'=>'Update Donor', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Donor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Donor', 'url'=>array('admin')),
);
?>

<h1>View Donor #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'first_name',
		'last_name',
		'address1',
		'address2',
		'address3',
		'city',
		'contact_number',
		'identity_number',
		'gender',
		array(
			'name' => 'source',
			'value' => $model->source ? Donor::getSourceById($model->source) : ''
		),
		array(
			'name' => 'blood_group',
			'value' => $model->blood_group ? Donor::getNameById($model->blood_group) : ''
		),		
		'created_at',
		'updated_at',
		
		array(
			'name' => 'created_by',
			'value' => User::model()->findByPk($model->created_by)->username
		),
	),
)); ?>
