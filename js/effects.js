var fadeOut = function(){
   var r = $.Deferred();
   $("#graph").fadeOut(150);

   setTimeout(function () {
   r.resolve();
   }, 300);

   return r;
};
