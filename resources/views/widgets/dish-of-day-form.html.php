<p>
  <label for="title"><?php esc_attr_e('Title:', 'text_domain'); ?> </label>
  <input class="widefat" id="title" name="<?php echo $title_name; ?>" type="text" value="<?php echo $title; ?>">
</p>
<p>
  <textarea class="widefat" id="text" name="<?php echo $text_name; ?>" type="text" cols="30" rows="10"><?php echo $text; ?></textarea>
</p>