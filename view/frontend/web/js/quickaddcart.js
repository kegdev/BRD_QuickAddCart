require(['jquery', 'jquery/ui', 'mage/url'],function($, ui, url){
    $(document).ready(function () {
        var minlength = 3;
        var request = null;
        var ajaxUrl = url.build('/quickaddcart/view/ajax');
        $("#quickaddcart_input").keyup(function () {
            var that = this,
            searchText = $(this).val();
            if (searchText.length >= minlength ) {
                if (request != null)
                    request.abort();
                $('#quickadd_loader').show();
                request = $.ajax({
                    url: ajaxUrl,
                    type: 'post',
                    dataType: 'html',
                    data: {term :searchText},
                }).done(function(response) {
                    if (searchText==$(that).val()) {
                        $('#quickaddcart_body').html(response);
                        $('#quickadd_loader').hide();
                    }
                });
            } else {
            }
        });
    });
});
