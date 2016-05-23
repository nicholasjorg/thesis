function fadeOut(){
   var r = $.Deferred();
   $("#graphContent").fadeOut(150);

   setTimeout(function () {
   r.resolve();
   }, 300);

   return r;
   fadeIn();
};

function fadeIn(){
   var r = $.Deferred();
   $("#graphContent").fadeIn(150);

   setTimeout(function () {
   r.resolve();
   }, 300);

   return r;
};
