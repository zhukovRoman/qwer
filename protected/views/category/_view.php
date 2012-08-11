<div class="main-view">
	<h2 class="main-view-top">
		<?php echo CHtml::link(CHtml::encode($data->name), 
						array('view', 'id'=>$data->id), array('title'=>'Читают: '.$data->order));?>
		<!-- подписчики:
		<?php echo CHtml::link(CHtml::encode($data->order), 
						array('view', 'id'=>$data->id));?> -->
		<!-- <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
		<br />

		<b><?php echo CHtml::encode($data->getAttributeLabel('parent_id')); ?>:</b>
		<?php echo CHtml::encode($data->parent_id); ?>
		<br />

		<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
		<?php echo CHtml::encode($data->name); ?>
		<br />

		<b><?php echo CHtml::encode($data->getAttributeLabel('order')); ?>:</b>
		<?php echo CHtml::encode($data->order); ?>
		<br /> -->
	</h2>
	


</div>