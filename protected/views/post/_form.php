<div class="form span7">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textArea($model,'code',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->textField($model,'category_id'); ?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sub_cat_id'); ?>
		<?php echo $form->textField($model,'sub_cat_id'); ?>
		<?php echo $form->error($model,'sub_cat_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'author_id'); ?>
		<?php echo $form->textField($model,'author_id'); ?>
		<?php echo $form->error($model,'author_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_id'); ?>
		<?php echo $form->textField($model,'status_id'); ?>
		<?php echo $form->error($model,'status_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'time_add'); ?>
		<?php echo $form->textField($model,'time_add'); ?>
		<?php echo $form->error($model,'time_add'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_video'); ?>
		<?php echo $form->checkBox($model,'is_video'); ?>
		<?php echo $form->error($model,'is_video'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_photoset'); ?>
		<?php echo $form->checkBox($model,'is_photoset'); ?>
		<?php echo $form->error($model,'is_photoset'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_playlist'); ?>
		<?php echo $form->checkBox($model,'is_playlist'); ?>
		<?php echo $form->error($model,'is_playlist'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'view_count'); ?>
		<?php echo $form->textField($model,'view_count'); ?>
		<?php echo $form->error($model,'view_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'favourite_count'); ?>
		<?php echo $form->textField($model,'favourite_count'); ?>
		<?php echo $form->error($model,'favourite_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment_count'); ?>
		<?php echo $form->textField($model,'comment_count'); ?>
		<?php echo $form->error($model,'comment_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rating_count'); ?>
		<?php echo $form->textField($model,'rating_count'); ?>
		<?php echo $form->error($model,'rating_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'all_vote_count'); ?>
		<?php echo $form->textField($model,'all_vote_count'); ?>
		<?php echo $form->error($model,'all_vote_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'positive_vote_count'); ?>
		<?php echo $form->textField($model,'positive_vote_count'); ?>
		<?php echo $form->error($model,'positive_vote_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'preview_url'); ?>
		<?php echo $form->textField($model,'preview_url',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'preview_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'important_flag'); ?>
		<?php echo $form->checkBox($model,'important_flag'); ?>
		<?php echo $form->error($model,'important_flag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'landscape'); ?>
		<?php echo $form->checkBox($model,'landscape'); ?>
		<?php echo $form->error($model,'landscape'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'order'); ?>
		<?php echo $form->textField($model,'order'); ?>
		<?php echo $form->error($model,'order'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subtitle'); ?>
		<?php echo $form->textField($model,'subtitle',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'subtitle'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tag'); ?>
		<?php echo $form->textField($model,'tag',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'tag'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->