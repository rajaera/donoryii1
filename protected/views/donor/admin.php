<?php
/* @var $this DonorController */
/* @var $model Donor */

$this->breadcrumbs=array(
	'Donors'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Donor', 'url'=>array('index')),
	array('label'=>'Create Donor', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#donor-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Donors</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'donor-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'created_at',
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
			'value' => '$data->source ? Donor::getSourceById($data->source) : ""'
		),
		array(
			'name' => 'blood_group',
			'value' => '$data->blood_group ? Donor::getNameById($data->blood_group) : ""'
		),			
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
