<?php

/* https://developer.wordpress.org/reference/functions/wp_strip_all_tags/ */

function strip_all_tags($string, $remove_breaks = false) {
    $string = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $string );
    $string = strip_tags($string);
 
    if ( $remove_breaks )
        $string = preg_replace('/[\r\n\t ]+/', ' ', $string);
 
    return trim( $string );
}

/* https://developer.wordpress.org/reference/functions/wp_html_excerpt/ */

function html_excerpt( $str, $count, $more = null ) {
    if ( null === $more )
        $more = '';
    $str = strip_all_tags( $str, true );
    $excerpt = mb_substr( $str, 0, $count );
    // remove part of an entity at the end
    $excerpt = preg_replace( '/&[^;\s]{0,6}$/', '', $excerpt );
    if ( $str != $excerpt )
        $excerpt = trim( $excerpt ) . $more;
    return $excerpt;
}

function the_image_src( $str ) {
    $imgs = array();
    if (! preg_match_all('/<img[^>]*>/i', $str, $imgs))
        return null;
    $imgs = array_filter($imgs[0], function($e) {
        return strpos($e, 'feedburner') === false;
    });
    if (count($imgs) === 0)
        return null;
    $srcs = array_filter(array_map(function($e) {
        $out = array();
        return preg_match('/src=(["\'])([^"\']+)\1/i', $e, $out) ? $out[2] : null;
    }, $imgs));
    return $srcs[0];
}

/* future release compatibility */
function _g($str, $comment='') {
    return $str;
}
