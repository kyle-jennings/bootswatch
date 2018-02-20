$('.js--tab-switch').on('change', function(){


  var $this = $(this);
  var $parent = $this.closest('li');
  var $fields = $parent.siblings('.customize-control-ColorVariable');
  var thisVal = $this.val();

  window.$field = $fields;
  
  $.each($fields, function(i,e){
    var $elm = $(e);
    if( $elm.attr('data-group') == thisVal){
      $elm.fadeIn();
    }else{
      $elm.fadeOut();
    }

  });


});