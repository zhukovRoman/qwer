<div class="row">
    <div class="span5">
        <?php echo ($model->status_id==1)? "на модерации!" : ""; ?>
        <?php echo ($model->status_id==10)? "Архив!" : ""; ?>
        <?php echo ($model->status_id==3)? "Черновик!" : ""; ?>
    </div>
    <div class="span4">
        <?php 
        $this->widget('bootstrap.widgets.BootButton', array(
            'label'=>'Редактировать',
            'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'mini',
            'icon' => 'pencil',// '', 'large', 'small' or 'mini'
            'url'=>array('update','id'=>$model->id),
        )); ?>

        <?php 
            ($model->status_id!=10)?
            $this->widget('bootstrap.widgets.BootButton', array(
            'label'=>'Удалить',
            'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'mini',
            'icon' => 'remove',// '', 'large', 'small' or 'mini'
            'url'=>array('archive','id'=>$model->id),
        )): ""; ?>

        <?php
            if ($model->status_id==1){
                $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Одобрить, но не обновлять',
                'type'=>'warning', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size'=>'mini',
                'icon' => 'ok',// '', 'large', 'small' or 'mini'
                'url'=>array('approve','id'=>$model->id),
            ));
                 $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Одобрить и обновить',
                'type'=>'warning', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size'=>'mini',
                'icon' => 'time',// '', 'large', 'small' or 'mini'
                'url'=>array('approvetime','id'=>$model->id),
            )) ;  }
            ($model->status_id==10)?
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
