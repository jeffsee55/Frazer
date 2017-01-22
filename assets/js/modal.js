jQuery(document).ready(function($){
    $('a[href="#show-contact"]').click(function(e) {
        e.stopPropagation(); // this stops the event from bubbling up to the body
        openModal();
    });

    $(document).click(function(e) {
        if($(e.target).closest('.contact').length === 0)
        {
            closeModal();
        }
    });

    $('.close-contact').click(function() {
        closeModal();
    })

    function openModal()
    {
        $('body').addClass('show-contact');
        $('.contact').addClass('show');
    }
    function closeModal()
    {
        $('body').removeClass('show-contact');
        $('.contact').removeClass('show');
    }

    function renderResponse(response)
    {
        var divHeight = $('.contact-form .inputs').height();
        $('.contact-form .inputs').html('<div style="display:flex; align-items: center; height: ' + divHeight + 'px"><h3>Thank you for reaching out, we\'ll be in touch shortly</h3></div>');
        var icon = $('#contact-submit').find('i');
        icon.removeClass('fa-circle-o-notch');
        icon.removeClass('fa-spin');
        icon.addClass('fa-check');
    }

    $('#contact-form').submit(function(e) {
        e.preventDefault();
        var formData = {
            'name'    : $('input[name=name]').val(),
            'email'   : $('input[name=email]').val(),
            'message' : $('textarea[name=message]').val(),
            'action'  : $('input[name=action]').val()
        };
        var icon = $('#contact-submit').find('i');
        icon.removeClass('fa-send');
        icon.addClass('fa-circle-o-notch');
        icon.addClass('fa-spin');

		$.ajax({
			url: options.ajax_load_url,
            type: 'POST',
            data: formData,
			success: renderResponse,
		});
    });
});
