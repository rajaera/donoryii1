<?php
/* @var $this DonorCampController */
/* @var $data DonorCamp */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('donor_id')); ?>:</b>
	<?php echo CHtml::encode($data->donor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('camp_id')); ?>:</b>
	<?php echo CHtml::encode($data->camp_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />


</div>