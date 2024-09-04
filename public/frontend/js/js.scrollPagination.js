(function ($) {
  $.fn.loadScrollData = function (start, options) {
    var settings = $.extend({
      limit: 10,
      listingId: '',
      loadMsgId: '',
      ajaxUrl: '',
      cat_id: '',
      top_id: '',
      isHome: false,
      loadingMsg: '<div style:"text-align:center;">Please Wait...!</div>',
      loadingSpeed: 10

    }, options);

    action = "inactive";
	var type_data = $("#type_data").val();
	var cat_page = $("#cat_page").val();
	if(settings.cat_id==''){
		settings.cat_id = $("#cat_page").val();
	}
    $.ajax({
      method: "POST",
      data: {
        'getData': 'ok',
        'limit': settings.limit,
        'cat_id': settings.cat_id,
        'top_id': settings.top_id,
        'isHome': settings.isHome,
        'start': start,
        'data_type': type_data
      },
      url: settings.ajaxUrl,
      success: function (data) {
        $(settings.listingId).append(data);
        if (data == '') {
          $(settings.loadMsgId).html('');
          action = 'active';
        } else {
          $(settings.loadMsgId).html(settings.loadingMsg);
          action = "inactive";
        }
      }
    });

    if (action == 'inactive') {
      action = 'active';
    }

    $(window).scroll(function () {
      if ($(window).scrollTop() + $(window).height() > $(settings.listingId).height() && action == 'inactive') {
        action = 'active';
        start = parseInt(start) + parseInt(settings.limit);
        setTimeout(function () {
          $.fn.loadScrollData(start, options);
        }, settings.loadingSpeed);
      }
    });

  };
}(jQuery));
