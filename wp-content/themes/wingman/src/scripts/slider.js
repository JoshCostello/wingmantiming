
    $('.slider').addClass('active-slider').append(`<div class="slider__buttons"><button class="slider__button slider__button--prev"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M31.7 239l136-136c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9L127.9 256l96.4 96.4c9.4 9.4 9.4 24.6 0 33.9L201.7 409c-9.4 9.4-24.6 9.4-33.9 0l-136-136c-9.5-9.4-9.5-24.6-.1-34z"/></svg> Prev</button><button class="slider__button slider__button--next">Next <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z"/></svg></button></div>`);
    $('.slider .board').wrapAll('<div class="slider__track" />').each(function(index) {
        if(index == 0) {
            $(this).addClass('active');
        } else {
            $(this).addClass('waiting');
        }
    });

    $('.slider__button--next').on('click', function() {
        if($('.board.active').next().length) {
            $('.board.active').toggleClass('viewed active').next().toggleClass('waiting active');
        }
    });

    $('.slider__button--prev').on('click', function() {
        if($('.board.active').prev().length) {
            $('.board.active').toggleClass('waiting active').prev().toggleClass('viewed active');
        }
    });