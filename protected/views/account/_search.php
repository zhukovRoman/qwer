<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mail'); ?>
		<?php echo $form->textField($model,'mail',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'avatar_url'); ?>
		<?php echo $form->textField($model,'avatar_url',array('size'=>60,'maxlength'=>120)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sex'); ?>
		<?php echo $form->textField($model,'sex',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'country_id'); ?>
		<?php echo $form->textField($model,'country_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'region_id'); ?>
		<?php echo $form->textField($model,'region_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'city_id'); ?>
		<?php echo $form->textField($model,'city_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'birth_date'); ?>
		<?php echo $form->textField($model,'birth_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'about'); ?>
		<?php echo $form->textField($model,'about',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_id'); ?>
		<?php echo $form->textField($model,'status_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rating'); ?>
		<?php echo $form->textField($model,'rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'balance'); ?>
		<?php echo $form->textField($model,'balance'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'register_date'); ?>
		<?php echo $form->textField($model,'register_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_login'); ?>
		<?php echo $form->textField($model,'last_login'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_ip'); ?>
		<?php echo $form->textField($model,'user_ip'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'activate_key'); ?>
		<?php echo $form->textField($model,'activate_key',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'newpass_key'); ?>
		<?php echo $form->textField($model,'newpass_key',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'referral'); ?>
		<?php echo $form->textField($model,'referral'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'badge'); ?>
		<?php echo $form->textField($model,'badge'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vk_url'); ?>
		<?php echo $form->textField($model,'vk_url',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tw_url'); ?>
		<?php echo $form->textField($model,'tw_url',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_count'); ?>
		<?php echo $form->textField($model,'post_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment_count'); ?>
		<?php echo $form->textField($model,'comment_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'friend_count'); ?>
		<?php echo $form->textField($model,'friend_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subscribe_count'); ?>
		<?php echo $form->textField($model,'subscribe_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'all_vote_count'); ?>
		<?php echo $form->textField($model,'all_vote_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'positive_vote_count'); ?>
		<?php echo $form->textField($model,'positive_vote_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'new_msg_count'); ?>
		<?php echo $form->textField($model,'new_msg_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'new_friend_count'); ?>
		<?php echo $form->textField($model,'new_friend_count'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->