$(window).resize(function (e) {
  window.resizeEvt;
  $(window).resize(function () {
    clearTimeout(window.resizeEvt);
    window.resizeEvt = setTimeout(function () {
      doneresizing();
    }, 250);
  });
});

$(function doneresizing() {
  $('.meat').click(function (){
    if(($(window).width() <= 768) || /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
      event.preventDefault();
      alert('mobile! No links workinf');
    } else {
      $('#meatModalImg').attr('src', $(this).data('img'));
      $('#meatModal').modal({show:true});
    }
  });
});