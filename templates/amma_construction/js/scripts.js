// Dom Content Loaded Function
(function($) {
    // Rotate Prototype
    $.fn.animateRotate = function(angle, duration, easing, complete) {
        return this.each(function() {
            var $elem = $(this);

            $({
                deg: 0
            }).animate({
                deg: angle
            }, {
                duration: duration,
                easing: easing,
                step: function(now) {
                    $elem.css({
                        transform: 'rotate(' + now + 'deg)'
                    });
                },
                complete: complete || $.noop
            });
        });
    };
    
    document.addEventListener('DOMContentLoaded', function() {
        console.log("Dom Loaded");

        var dev_tag = $('.dev-tag-wrapper');
        // Dev Brand Functionality
        var dev_btn = $('.dev-link');
    
        dev_btn.on('click', function(e) {
            e.preventDefault();
            var chevron = '.dev-chevron';
            var dev_bar = '.dev-tag';
            rotate(chevron)
            moveUp(dev_bar)
            changeColor(chevron);
            // console.log("Clicked")
        })
    
        function rotate(selector) {
            $(selector).toggleClass("down");
            // console.log("Rotated", $(selector));
        }
    
        function moveUp(selector) {
            if ($(selector).css('height') !== '500px') $(selector).animate({
                height: '500px'
            });
            else $(selector).animate({
                height: '50px'
            });
            // console.log("Moved", $(selector).css('height'));
        }
    
        function changeColor(selector) {
            if ($(selector).css("color") === 'rgb(251, 168, 60)') $(selector).css("color", 'rgb(255, 255, 255)');
            else $(selector).css("color", 'rgb(251, 168, 60)');
            // console.log("Changed Color", $(selector).css("color"));
        }
    });
}(window.jQuery));