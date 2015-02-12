jQuery(document).ready(function($) {

    var offset = 220,
        duration = 600,
        $up = $('#up'),
        $htmlbody = $('html, body'),
        $body = $htmlbody.eq(1),
        $window = $(window),
        $offCanvas = $('#sidebar.right-off-canvas-menu'),
        $viewMode = $('#viewMode'),
        $block = $('main ul.small-block-grid-1'),
        classStr = 'medium-block-grid-2 large-block-grid-3 xlarge-block-grid-4 xxlarge-block-grid-5';

    $.fn.scrollStopped = function(callback) {
        var $this = $(this), self = this;
        $this.scroll(function(){
            if ($this.data('scrollTimeout')) {
              clearTimeout($this.data('scrollTimeout'));
            }
            $this.data('scrollTimeout', setTimeout(callback,duration,self));
        });
    };

    $window.scrollStopped(function() {
        var scrollTop = $window.scrollTop();
        $offCanvas.animate({'top':scrollTop}, duration);
        if (scrollTop > offset) {
            if (!$up.data('shown'))
                $up.data('shown', true).fadeIn(duration);
        } else {
            if ($up.data('shown'))
                $up.data('shown', false).fadeOut(duration);
        }
    });

    $up.data('shown', false)
        .click( function(e) {
            e.preventDefault();
            $htmlbody.animate({scrollTop: 0}, duration);
            return false;
    });

    if ($body.hasClass('archive')) {
        // remove view mode
        $viewMode.parent().remove();
    } else {
        // setup clicks on th view
        for(var i = 0; i < $('> li', $block).length; i += 1) {
            $('#container-' + i).click(
                (function(n) {
                    return function(e) {
                        if (!$body.hasClass('expanded') && !e.target.id.match(/^link/))
                            $('#link-' + n).trigger('click');
                    };
                }(i)))
            .find('a[target=_blank]')
            .click( function(e) {
                e.stopPropagation();
            });
        }

        // setup view mode button
        $viewMode.on('click', function(e) {
            e.preventDefault();
            if ($body.hasClass('expanded')) {
                $body.removeClass('expanded');
                $block.addClass(classStr);
            } else { 
                $body.addClass('expanded');
                $block.removeClass(classStr);
            }
            return false;
        });
    }

    // init foundation
    $(document).foundation();
});
