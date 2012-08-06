<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>300)); ?>

	<?php echo $form->textAreaRow($model,'text',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'code',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'category_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'sub_cat_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'author_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'status_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'time_add',array('class'=>'span5')); ?>

	<?php echo $form->checkBoxRow($model,'is_video'); ?>

	<?php echo $form->checkBoxRow($model,'is_photoset'); ?>

	<?php echo $form->checkBoxRow($model,'is_playlist'); ?>

	<?php echo $form->textFieldRow($model,'view_count',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'favourite_count',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'comment_count',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'rating_count',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'all_vote_count',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'positive_vote_count',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'preview_url',array('class'=>'span5','maxlength'=>120)); ?>

	<?php echo $form->checkBoxRow($model,'important_flag'); ?>

	<?php echo $form->checkBoxRow($model,'landscape'); ?>

	<?php echo $form->textFieldRow($model,'order',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'subtitle',array('class'=>'span5','maxlength'=>300)); ?>

	<?php echo $form->textFieldRow($model,'tag',array('class'=>'span5','maxlength'=>200)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
