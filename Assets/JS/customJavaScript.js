/* 
    Created on : Feb 2, 2017, 9:56:13 AM
    Author     : Scott Muth <scottdotm.com>
*/
$(function (e) {
     $('[data-toggle="tooltip"]').tooltip();
     $('[data-toggle="popover"]').popover();

     $('#test').click(function () {
          alert('this is working');
     });
});

