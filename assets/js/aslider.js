var aslider = {
    // Each slider is stored in this as {currentSlide: xx, timeoutHandle: yy}
    sliders: [],

    // Init Aslider and each defined slider on the webpage
    initAsliders: function () {
        'use strict';

        // Get each slider from the webpage and process it
        var sliders = document.querySelectorAll('.aslider');
        for (var i = 0; i < sliders.length; i++) {

            var currentSlider = sliders[i];

            // Create an object to represent current slider state for this slider
            var sliderObject = {};
            var sliderIndex = aslider.sliders.push(sliderObject) - 1;

            sliderObject.sliderContainer = sliders[i];
            sliderObject.muted = false;

            // Normalise each slider element on the page
            var style = currentSlider.getAttribute('style');
            currentSlider.setAttribute('style', (style)?style+';position:relative':'position:relative');

            // Perform any slider specific setup for the current slider:
            
            // End slider specific setup.

            // Initialise each slide of the current slider
            var slides = currentSlider.querySelectorAll('.aslide');

            for (var j = 0; j < slides.length; j++) {
                var slide = slides[j];

                // Set classes to hide the slide and preload audio if specified
                slide.setAttribute('style', aslider.slideFade + ";" + aslider.slideFadeOut);
                if (slide.hasAttribute('data-audio')) {
                    var audioElement =  document.createElement('audio');
                    audioElement.setAttribute('src', slide.getAttribute('data-audio'));
                    audioElement.setAttribute('preload', '');
                    if (slide.hasAttribute('data-audio-loop')) {
                        audioElement.setAttribute('loop', '');
                    }
                    slide.appendChild(audioElement);
                }
            }

            // Advance to the first slide and start the slider
            if (slides.length > 0) { // Don't crap out if no slides specified
                var duration = slides[0].getAttribute('data-duration') || currentSlider.getAttribute('data-duration');
                if (!duration) throw ("Could not find duration on slide or on slider.");
                
                slides[0].setAttribute('style', aslider.slideFade + ";" + aslider.slideFadeIn);
                sliderObject.timeoutHandle = setTimeout(function (sliderIndex, slides) {
                    aslider.advanceSlide(slides[0], sliderIndex);
                }, parseInt(duration) * 1000, sliderIndex, slides);
                sliderObject.currentSlide = slides[0];
            }
        }
    },

    advanceSlide: function (currentSlide, sliderIndex) {
        'use strict';
        var nextSlide = currentSlide.nextElementSibling;
        var slider = aslider.sliders[sliderIndex].sliderContainer;

        if (!nextSlide ||! /aslide/.test(nextSlide.className)) { // Loop to the first slide if we are on the last slide now
            nextSlide = currentSlide.parentNode.querySelector('.aslide');
        }

        currentSlide.setAttribute('style', aslider.slideFade + ";" + aslider.slideFadeOut);
        nextSlide.setAttribute('style', aslider.slideFade + ";" + aslider.slideFadeIn);


        aslider.sliders[sliderIndex].currentSlide = nextSlide;


        //slider.clientHeight($(nextSlide).height());

        var duration = nextSlide.getAttribute('data-duration') || slider.getAttribute('data-duration');
        if (!duration) throw ("Could not find duration on slide or on slider.");

        aslider.sliders[sliderIndex].timeoutHandle = setTimeout(function () {
            aslider.advanceSlide(nextSlide, sliderIndex);
        }, parseInt(duration) * 1000);
    },

    stop: function() {
        'use strict';
        while (aslider.sliders.length > 0) {
            var slider = aslider.sliders.pop();
            clearTimeout(slider.timeoutHandle);
        }

    },

    init: function () {
        'use strict';
        aslider.stop();
        if (window.addEventListener) {
            window.addEventListener('load', this.initAsliders, false);
        } else if (window.attachEvent) { // IE
            window.attachEvent('onload', this.initAsliders);
        }
    },

    /* Configuration */
    slideFade: "display: block; opacity: 1; top: 0; position: absolute; left: 0; overflow: hidden; transition: opacity 1s ease-in-out; -moz-transition: opacity 1s ease-in-out; -webkit-transition: opacity 1s ease-in-out;",
    slideFadeOut: "opacity: 0",
    slideFadeIn: "opacity: 1",
    slideSlide: "",
    slideSlideOut: "",
    slideSlideIn: "",

};

aslider.init();
