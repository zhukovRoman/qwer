
<div> <h3>Результаты голосования: </h3></div>
<?php Yii::app()->getClientScript()->registerCssFile('css/min/poll.css'); ?>
<?php
$vars = json_decode($model->code);
$i = 0;
$allvotes = count(User_Vote::getVotes($model->id));
?>

<ul class="poll-result span8">

    <?php
    foreach ($vars as $var) {
        
        $thiscount = count(User_Vote::getVotes($model->id, $i));
        
        ?>

        
        <li <?php echo ($i % 2 == 1) ? 'class="even"' : ""; ?> >
            <dl>
                <dt>
                <strong><?php echo $var; ?></strong><br>
                <!-- <span>(4.9%)</span> -->
                </dt>
                <dd><span style="width: <?php echo $thiscount*100/$allvotes; ?>%;">
                    </span><span class="counter"><?php echo $thiscount;?></span></dd>
            </dl>
        </li>
        <?php
        $i++;
    }
    ?>   
</ul>

