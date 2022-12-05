<?php
/* @var $this DonorController */
/* @var $data Donor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode('Name'); ?>:</b>
	<?php echo CHtml::encode(implode(' ', array_filter([$data->first_name, $data->last_name]))); ?>
	<br />

	<b><?php echo CHtml::encode('Address'); ?>:</b>
	<?php echo CHtml::encode(implode(',', array_filter([$data->address1, $data->address2, $data->address3, $data->city]))); ?>	
	<br />	


	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_number')); ?>:</b>
	<?php echo CHtml::encode($data->contact_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('identity_number')); ?>:</b>
	<?php echo CHtml::encode($data->identity_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
	<?php echo CHtml::encode($data->gender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('source')); ?>:</b>
	<?php echo CHtml::encode($data->source ?  Donor::getSourceById($data->source) : ''); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('blood_group')); ?>:</b>
	<?php echo CHtml::encode($data->blood_group ? Donor::getNameById($data->blood_group) : ''); ?>
	<br />
</div>