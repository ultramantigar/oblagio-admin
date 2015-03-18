<?php
/* @var $this CrudController */
/* @var $data Crud */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('crud')); ?>:</b>
	<?php echo CHtml::encode($data->crud); ?>
	<br />


</div>