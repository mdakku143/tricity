<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/js/theia-sticky-sidebar.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>
<script src="{{ asset('frontend/js/lazy.min.js') }}"></script>
<script src="{{ asset('frontend/js/js.scrollPagination.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.bxslider.min.js') }}"></script>
<script src="{{ asset('frontend/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
    var idval = $('.bigStory').attr('id');
    $(document).loadScrollData(0, {
        limit: 10,
        listingId: "#results",
        loadMsgId: '#load-msg',
        ajaxUrl: _site_url + '/ajax/try-getData',
        cat_id: '0',
        top_id: idval,
        isHome: '1',
        loadingMsg: '<div class="alert alert-warning p-1 text-center"><i class="fa fa-fw fa-spin fa-spinner"></i>Please Wait...!</div>',
        loadingSpeed: 10
    });
</script>
<script>
    function dataSearch(e) {
        var code = e.keyCode ? e.keyCode : e.charCode;
        if (code == 13) {
            check_search();
        }
    }

    function check_search() {
        string = $.trim($('#searchText').val());
        $final_Text = string.replace(/[&\/\\#,+()@!$~%'":*?<>{}]/g, ' ');
        $final_Text = $final_Text.trim();
        if ($final_Text == '') {
            $('#searchText').focus();
            return false;
        } else {
            $final_query = $final_Text.split(' ').join('-');
            var $final_url = "/search/" + $final_query;
            $final_url = $final_url.toLowerCase();
            window.location.href = $final_url;
            return false;
        }
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var widthW = $(window).width();
        if (widthW >= 768) {
            $('.theialhsTbl, .theiaCenter, .theiarhsTbl').theiaStickySidebar({

                additionalMarginTop: 30
            });
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('.middleText').bind('cut copy', function(e) {
            e.preventDefault();
            const elem = document.createElement('textarea');
            elem.value = getSelectedText();
            document.body.appendChild(elem);
            elem.select();
            document.execCommand('copy');
            document.body.removeChild(elem);
        });
        $(document).keydown(function(objEvent) {
            if (objEvent.ctrlKey) {
                if (objEvent.keyCode == 65) {

                    return false;
                }
            }
        });
    });

    function getSelectedText() {
        let selectedText = window.getSelection ? window.getSelection() : document.getSelection ? document
            .getSelection() : document.selection ? document.selection.createRange().text : '';

        let text = selectedText.toString();

        if (text.length > 150) {
            finalText = text.substring(0, 150) + "...";
        } else {
            finalText = text;
        }

        return finalText + " " + window.location;
    }
</script>
