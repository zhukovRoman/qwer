<div class="row">
    <div class="span5">
        <?php echo ($model->status_id==1)? "на модерации!" : ""; ?>
        <?php echo ($model->status_id==3)? "Архив!" : ""; ?>
    </div>
    <div class="span4" style="float:right">
        <?php 

        $this->widget('bootstrap.widgets.BootButton', array(
            'label'=>'Редактировать',
            'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'mini',
            'icon' => 'pencil',// '', 'large', 'small' or 'mini'
            'url'=>array('update','id'=>$model->id),
        )); ?>

        <?php 
            ($model->status_id!=3)?
            $this->widget('bootstrap.widgets.BootButton', array(
            'label'=>'Удалить',
            'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'mini',
            'icon' => 'remove',// '', 'large', 'small' or 'mini'
            'url'=>array('archive','id'=>$model->id),
        )): ""; ?>

        <?php
            ($model->status_id<2)?
                $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Одобрить',
                'type'=>'warning', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size'=>'mini',
                'icon' => 'ok',// '', 'large', 'small' or 'mini'
                'url'=>array('approve','id'=>$model->id),
            )):"";
            ($model->status_id==3)?
                $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Восстановить',
                'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size'=>'mini',
                'icon' => 'repeat',// '', 'large', 'small' or 'mini'
                'url'=>array('restore','id'=>$model->id),
            )):"";
                ?>
        
    </div>
</div>
