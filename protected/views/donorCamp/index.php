<?php
/* @var $this DonorCampController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Donor Camps',
);

$this->menu=array(
	array('label'=>'Create DonorCamp', 'url'=>array('create')),
	array('label'=>'Manage DonorCamp', 'url'=>array('admin')),
);
?>

<h1>Donor Camps</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
