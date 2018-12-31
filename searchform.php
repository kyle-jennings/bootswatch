<?php
/**
 * The search form for our theme
 *
 * @link https://developer.wordpress.org/reference/functions/get_search_form/
 *
 * @package Bootswatches
 */

?>
<form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
  <div class="form-group" role="search">

        <label class="usa-sr-only" for="search-field-small">
            <?php echo esc_attr_x('Search for:', 'search lable', 'bootswatches'); ?>
        </label>
    
        <input id="search-field-small" type="search" name="s"
        placeholder="<?php echo esc_attr_x('Search ...', 'placeholder', 'bootswatches'); ?>"
        value="<?php echo get_search_query() ?>" name="s"
        title="<?php echo esc_attr_x('Search for:', 'title', 'bootswatches') ?>" />
    
    </div>

    <div class="form-group">
        <button class="btn btn-primary" type="submit" value="<?php echo esc_attr_x('Search', 'submit button', 'bootswatches'); ?>">
            <?php echo __('Search', 'bootswatches'); // WPCS: xss ok. ?>    
        </button>
    </div>

</form>
