<li class="main-view content-border">
	<div class="main-view-top">
		<?php echo CHtml::link(CHtml::encode($data->title), 
			array('/post/view', 'id'=>$data->id), array('class'=>'black-a ellipsis',
                            'title'=>$data->title));?>
		<?php 
                     $url = $data->preview_url;
                     if ($url=="" || !file_exists($url)) $url=Post::DEF_URL;
					 
					 $link = CHtml::image($url, $data->title,array('class'=>'content-border'))."<div style='border-radius:4px;'><span>";
					 if (mb_strlen($data->subtitle,'utf-8') > 80) {
						$link.=CHtml::encode(mb_substr($data->subtitle, 0, 80, 'utf-8')).'...' ;
					 }
					 else $link.=CHtml::encode ($data->subtitle)." ";
					 
					 $link .= '<hr>'
						.CHtml::encode($data->category->name).
						"</span></div>";
						
			echo CHtml::link($link, array('/post/view', 'id'=>$data->id)); 
		?>
	</div>
	<div class="main-view-bottom color-black">
		<div class="main-user">
			<b><?php echo CHtml::link('<i class="icon-user" rel="tooltip" title="автор"></i>'.substr($data->author->login, 0, 14),
    			Yii::app()->createUrl('account/view',
    			array ("id"=>$data->author->id)), array('class'=>'black-a')); ?></b>
		</div>
		<i class="icon-star" rel="tooltip" title="рейтинг"></i>
		<?php echo CHtml::encode($data->getraiting());?>
		<i class="icon-comment" rel="tooltip" title="число комментариев"></i>
		<?php echo CHtml::encode($data->comment_count);?> 
			&nbsp;
		<!--<?php if($data->is_photoset==true)
					{ 
						echo '<i class="icon-camera" rel="tooltip" title="Тип"></i>';
				};?>
		<?php if($data->is_video==true)
					{ 
						echo '<i class="icon-film" rel="tooltip" title="Тип"></i>';
				};?>
		<?php if($data->is_video==false&&$data->is_photoset==false)
					{ 
						echo '<i class="icon-file" rel="tooltip" title="Тип"></i>';
				};?>    --> 
	</div>
	<?php /*
<!-- 	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::decode($data->text); ?>
	<br /> -->

<!-- 	<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::decode($data->code); ?>
	<br /> -->

<!-- 	<b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
	<?php echo CHtml::encode($data->category_id); ?>
	<br /> -->

<!-- 	<b><?php echo CHtml::encode($data->getAttributeLabel('sub_cat_id')); ?>:</b>
	<?php echo CHtml::encode($data->sub_cat_id); ?>
	<br /> -->

<!-- 	<b><?php echo CHtml::encode($data->getAttributeLabel('author_id')); ?>:</b>
	<?php echo CHtml::encode($data->author_id); ?>
	<br /> -->


	<b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
	<?php echo CHtml::encode($data->status_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_add')); ?>:</b>
	<?php echo CHtml::encode($data->time_add); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_video')); ?>:</b>
	<?php echo CHtml::encode($data->is_video); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_photoset')); ?>:</b>
	<?php echo CHtml::encode($data->is_photoset); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_playlist')); ?>:</b>
	<?php echo CHtml::encode($data->is_playlist); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('view_count')); ?>:</b>
	<?php echo CHtml::encode($data->view_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('favourite_count')); ?>:</b>
	<?php echo CHtml::encode($data->favourite_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment_count')); ?>:</b>
	<?php echo CHtml::encode($data->comment_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rating_count')); ?>:</b>
	<?php echo CHtml::encode($data->rating_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('all_vote_count')); ?>:</b>
	<?php echo CHtml::encode($data->all_vote_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('positive_vote_count')); ?>:</b>
	<?php echo CHtml::encode($data->positive_vote_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('preview_url')); ?>:</b>
	<?php echo CHtml::encode($data->preview_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('important_flag')); ?>:</b>
	<?php echo CHtml::encode($data->important_flag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('landscape')); ?>:</b>
	<?php echo CHtml::encode($data->landscape); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order')); ?>:</b>
	<?php echo CHtml::encode($data->order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subtitle')); ?>:</b>
	<?php echo CHtml::encode($data->subtitle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tag')); ?>:</b>
	<?php echo CHtml::encode($data->tag); ?>
	<br />

	*/ ?>

</li>