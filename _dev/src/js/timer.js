var timer;

object.addEventListener(eventType, function(event) {
  clearTimeout(timer);
  timer = setTimeout(function(){
    callback(event);
  }, 500);
}, false);
