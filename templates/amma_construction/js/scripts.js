(function($){
    document.addEventListener('DOMContentLoaded', function() {
        console.log("Dom Loaded");
        
        var dev_tag = $('.dev-tag-wrapper');
        
        console.log('pos', dev_tag);
        
        $(dev_tag).on('click', function(e){
           console.log("Clicked");
           
        });
        
    });
}(window.jQuery));