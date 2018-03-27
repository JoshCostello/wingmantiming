$('#menu-toggle').on('click', function(c) {
    c.preventDefault();
    $('.site__nav').toggleClass('site__nav--closed site__nav--open');
});