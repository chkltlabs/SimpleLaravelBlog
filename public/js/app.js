$(document).foundation(); //DO NOT DELETE, MOVE TO LAYOUT IF PROBLEMS OCCUR

$(document).ready(function () {
    console.log('ready');
   $('form').submit(function ( event ) {
       console.log('submit');
      let method = $(this).children(':hidden[name=_method]').val();
       console.log(method);
      if ($.type(method) !== 'undefined' && method === 'delete') {
          if(!confirm('Are you sure?')){
              event.preventDefault();
          }
      }
   });
});


