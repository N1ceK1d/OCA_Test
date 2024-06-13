$(document).ready(function(){
    var counter = 1800; // 30 минут
    var interval = setInterval(function(){
      var minutes = Math.floor(counter / 60);
      var seconds = counter % 60;
      $('#timer').text((minutes >= 10 ? minutes : '0' + minutes) + ':' + (seconds >= 10 ? seconds : '0' + seconds));
      counter--;
      if (counter < 0) {
        clearInterval(interval);
        $('.end_test_btn').trigger('click');
      }
    }, 1000);
});