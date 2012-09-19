<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('AlumniID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->AlumniID),array('view','id'=>$data->AlumniID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Forename')); ?>:</b>
	<?php echo CHtml::encode($data->Forename); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Surname')); ?>:</b>
	<?php echo CHtml::encode($data->Surname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Workplace')); ?>:</b>
	<?php echo CHtml::encode($data->Workplace); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Mobile')); ?>:</b>
	<?php echo CHtml::encode($data->Mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Email')); ?>:</b>
	<?php echo CHtml::encode($data->Email); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('DepartmentID')); ?>:</b>
	<?php echo CHtml::encode($data->DepartmentID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OtherEducation')); ?>:</b>
	<?php echo CHtml::encode($data->OtherEducation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pass')); ?>:</b>
	<?php echo CHtml::encode($data->pass); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diplom')); ?>:</b>
	<?php echo CHtml::encode($data->diplom); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>