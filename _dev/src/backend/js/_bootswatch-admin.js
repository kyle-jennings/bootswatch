// 'use strict';

/**
 * This stuff isnt used in teh customizer, its used in various admin pages such 
 * as the single post page.
 *
 * These are primarily video preview stuff (post formats)
 */
jQuery(document).ready(function($) {

  require('./video-media-library');
  require('./video-field-updated');
  require('./video-clear');

  if($('body.widgets-php')){
    $('.benjamin-widget-area-options').appendTo('.widgets-sortables');
  }

});

window.$ = jQuery;
