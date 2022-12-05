<?php
/* @var $this CampController */
/* @var $model Camp */

$this->breadcrumbs=array(
	'Camps'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Camp', 'url'=>array('index')),
	array('label'=>'Create Camp', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#camp-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Camps</h1>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'camp-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'scheduled_date',
		array(
			'name'=> 'name',
			'value' => '$data->markupNameColumn()',
			'type' => 'html'
		),
		'description',
		'location',		
		'created_at',
		array(
			'name' => 'is_done',
			 'value' => '$data->is_done ? "CLOSED" : "ON GOING"'
		),
		/*
		'updated_at',
		'created_by',
		
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
