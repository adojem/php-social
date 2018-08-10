$(function () {

   // On click signup, hide login and show registration form
   $('#signup').click(function (e) {
      console.log(e);
      e.preventDefault();
      $('#second').slideDown('slow', function () {
         console.log('hello');
         $('#first').slideUp('slow');
      });
   });

   // On click signup, hide login and show registration form
   $('#signin').click(function () {
      $('#first').slideDown('slow', function () {
         $('#second').slideUp('slow');
      });
   });
});