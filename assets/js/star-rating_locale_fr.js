(function (factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof module === 'object' && typeof module.exports === 'object') { 
        factory(require('jquery'));
    } else { 
        factory(window.jQuery);
    }
}(function ($) {
    "use strict";
    $.fn.ratingLocales['fr'] = {
        defaultCaption: '{rating} étoiles',
        starCaptions: {
            0.5: 'Une demi étoile',
            1: 'Une étoile',
            1.5: 'Une étoile et demi',
            2: 'Deux étoiles',
            2.5: 'Deux étoiles et demi',
            3: 'Trois étoiles',
            3.5: 'Trois étoiles et demi',
            4: 'Quatre étoiles',
            4.5: 'Quatre étoiles et demi',
            5: 'Cinq étoiles'
        },
        clearButtonTitle: 'Effacer',
        clearCaption: 'Non noté'
    };
}));