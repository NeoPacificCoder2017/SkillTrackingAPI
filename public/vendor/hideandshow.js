$(document).ready(function() {
  $('.requesthideandshow').hide();
  
});

  function showselected(userTypeId) {
    $("#welcomeScreen").hide();
    console.log('hohohhohho ver.55');
    $('.requesthideandshow').hide();
    console.log('all hidden');
    $('#request'+userTypeId).show();
    $('.showTable').show();
    $('.parameterRequest'+ userTypeId).show();
    console.log('show selected');
  }