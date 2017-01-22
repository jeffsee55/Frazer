jQuery(document).ready(function($){
    $('.list-panel .item-header').click(function() {
        $('.list-panel').find('.item-body').addClass('is-hidden');
        $('.list-panel').find('.item-header').removeClass('showing');
        $(this).next('.item-body').removeClass('is-hidden');
        $(this).addClass('showing');
    })
});
