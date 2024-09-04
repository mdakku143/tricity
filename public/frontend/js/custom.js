
$(document).ready(function () {
  $(".topStrip nav ul li.menubar").click(function () {
    $('#overlay,.searchBox,body.fixed').removeClass('show');
    $('body').addClass('fixed');
    if ($(".desktop").hasClass('show')) {
      $('body').removeClass('fixed');
      $('#overlay,.desktop').removeClass('show');
    } else {
      $('.desktop').addClass('show');
      $('body').addClass('fixed');
    }
  });
  $(".topStrip .closeicon").click(function () {

    if ($(".desktop").hasClass('show')) {
      $('body').removeClass('fixed');
      $('.desktop').removeClass('show');
    } else {


    }
  });


  /*Search Box*/
 /* $(".topStrip nav ul li.search a").click(function(e){ 
   $(".searchBox").toggleClass("show");
      e.stopPropagation(); 
       });                                      
  $(".topStrip nav ul li.search a").click(function(e){ 
   $("#overlay").toggleClass("show");
      e.stopPropagation(); 
       });     
 $("body").click(function(){ 
$(".searchBox,#overlay").removeClass("show");
});  */
  $(".topStrip nav ul li.search a").click(function () {
    $('#overlay,.desktop').removeClass('show');
    if ($(".searchBox").hasClass('show')) {
      $('body').removeClass('fixed');
      $('#overlay,.searchBox').removeClass('show');

    } else {
      $('#overlay,.searchBox').addClass('show');
      $('body').addClass('fixed');
    }
  });
  $("#overlay").click(function () {
    $('body').removeClass('fixed');
    $('#overlay,.desktop,.searchBox').removeClass('show');

  });




  $(".articleTxt .imgSize,.articlePopup .close").click(function () {
    $(".articlePopup").css({'visibility': 'hidden'});
  })

  if ($(window).width() <= 768) {

    $(".articleTxt .imgSize").click(function () {
      //alert()
      $(".articlePopup").css({'visibility': 'visible'});
    })
  }
  $(".articlePopup .goBack").click(function () {
    window.history.back();

  })
  $('.bxslider').bxSlider({
    adaptiveHeight: true

  });
});
/*

(function ($) {
  $.fn.loaddata = function (options) {// Settings
    var settings = $.extend({
      loading_gif_url: "ajax-loader.gif", //url to loading gif
      end_record_text: 'No more records found!', //no more records to load
      data_url: _site_url + '/ajax/try-getData', //url to PHP page
      start_page: 2 //initial page
    }, options);

    var el = this;
    loading = false;
    end_record = false;
    contents(el, settings); //initial data load

    $(window).scroll(function () { //detact scroll
      if ($(window).scrollTop() + $(window).height() >= $(document).height()) { //scrolled to bottom of the page
        contents(el, settings); //load content chunk
      }
    });
  };
  //Ajax load function
  function contents(el, settings) {
    var load_img = $('<img/>').attr('src', settings.loading_gif_url).addClass('loading-image'); //create load image
    var record_end_txt = $('<div/>').text(settings.end_record_text).addClass('end-record-info'); //end record text
    var cat_page = $("#cat_page").val();
    var type_data = $("#type_data").val();
    if (loading == false && end_record == false) {
      loading = true; //set loading flag on
      el.append(load_img); //append loading image
      $.post(settings.data_url, {'page': settings.start_page, 'data_type': type_data, 'cat_id': cat_page}, function (data) { //jQuery Ajax post
        if (data.trim().length == 0) { //no more records
          el.append(record_end_txt); //show end record text
          load_img.remove(); //remove loading img
          end_record = true; //set end record flag on
          return; //exit
        }
        loading = false;  //set loading flag off
        load_img.remove(); //remove loading img
        el.append(data);  //append content
        settings.start_page++; //page increment
      })
    }
  }

})(jQuery);

$("#results").loaddata();
*/