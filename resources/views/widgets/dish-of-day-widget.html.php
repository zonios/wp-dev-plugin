<?= $args['before_widget'] ?>
<div class="widget-wrapper">

  <?php 
  if (!empty($instance['title'])) : 
    echo $args['before_title'] .  $instance['title'] . $args['after_title'];
  endif; 
  ?>

  <div class="textwidget">

  <?php   
  if (!empty($instance['text'])) : 
    echo esc_html__($instance['text']); 
  endif; 
  ?>

  </div>

</div>
<?= $args['after_widget'] ?>