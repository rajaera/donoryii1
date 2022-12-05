<?php
/* @var $this CampController */
/* @var $model Camp */

$this->breadcrumbs=array(
	'Camps'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Camp', 'url'=>array('index')),
	array('label'=>'Create Camp', 'url'=>array('create')),
	array('label'=>'Update Camp', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Camp', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Camp', 'url'=>array('admin')),
	array('label'=> ( isset(Yii::app()->session['live_camp_id']) && Yii::app()->session['live_camp_id'] == $model->id ? 'Unset Live Camp' : 'Set Live Camp') , 'url'=>array('liveCamp', 'id'=>$model->id)),
);
?>

<h1><?php echo ucwords($model->name);  ?></h1>
<h3 style="color: green;"><?php echo isset(Yii::app()->session['live_camp_id']) && Yii::app()->session['live_camp_id'] == $model->id ? 'This camp has been set as live camp' : ''; ?></h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name'=> 'name',
			'value' => $model->markupNameColumn(),
			'type' => 'html'
		),
		'description',
		'location',
		'scheduled_date',
		'created_at',
		'updated_at',
		array(
			'name' => 'created_by',
			'value' => User::model()->findByPk($model->created_by)->username
		),
		'is_done',
	),
)); ?>
