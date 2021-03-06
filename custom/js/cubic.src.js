jQuery(document).ready(function($) {

    // init foundation
    $(document).foundation();

    var offset = 220,
        duration = 600,
        $up = $('#up'),
        $htmlbody = $('html, body'),
        $body = $htmlbody.eq(1),
        $window = $(window),
        $offCanvas = $('#sidebar.right-off-canvas-menu'),
        $viewMode = $('#viewMode'),
        $viewModeIcon = $('> i', $viewMode),
        $block = $('main ul.small-block-grid-1'),
        thClass = 'medium-block-grid-2 large-block-grid-3 xlarge-block-grid-4 xxlarge-block-grid-5';

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

        // setup view mode button
        $viewMode.on('click', function(e) {
            e.preventDefault();
            if ($body.hasClass('expanded')) {
                // going into th view mode
                $body.removeClass('expanded');
                $block.addClass(thClass);
                $viewModeIcon.attr('class', 'icon-list');
            } else { 
                $body.addClass('expanded');
                $block.removeClass(thClass);
                $viewModeIcon.attr('class', 'icon-th');
            }
            return false;
        });

        // setup clicks on th view
        var makeClickHandler = function(i) {
            return function(e) {
                    if (!$body.hasClass('expanded') &&
                            !e.target.id.match(/^link/))
                        $('#link-' + i).trigger('click');
                };

        };
        for(var i = 0; i < $('> li', $block).length; i += 1) {
            $('#container-' + i).click(makeClickHandler(i))
            .find('a[target=_blank]')
            .click( function(e) {
                e.stopPropagation();
            });

            // Lazy load items
            $('#content-' + i + ' .article-content')
                .load('index.php', { item: i });
        }
    }

});
