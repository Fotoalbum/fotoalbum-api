<?php
App::import('helper','shortcode');
class BbcodeHelper extends Shortcode{

    function __construct(){
        // Register the shortcodes
        $this->add_shortcode(array(
            array( 'b' , array(&$this, 'shortcode_bold')),
            array( 'i' , array(&$this, 'shortcode_italics') ),
            array( 'u' , array(&$this, 'shortcode_underline') ),
            array( 'url' , array(&$this, 'shortcode_url') ),
            array( 'img' , array(&$this, 'shortcode_image') ),
            array( 'quote' , array(&$this, 'shortcode_quote') )
        ));
    }
    
    function _beforeShortcode($content){
        return htmlspecialchars($content);
    }
    
    function _afterShortcode($content){
		return $content;
        //return nl2br($content);
    }
    

    // No-name attribute fixing
    function attributefix( $atts = array() ) {
        if ( empty($atts[0]) ) return $atts;

        if ( 0 !== preg_match( '#=("|\')(.*?)("|\')#', $atts[0], $match ) )
            $atts[0] = $match[2];

        return $atts;
    }


    // Bold shortcode
    function shortcode_bold( $atts = array(), $content = NULL ) {
        return '<strong>' . $this->do_shortcode( $content ) . '</strong>';
    }

    // Italics shortcode
    function shortcode_italics( $atts = array(), $content = NULL ) {
        return '<em>' . $this->do_shortcode( $content ) . '</em>';
    }

    function shortcode_underline( $atts = array(), $content = NULL ) {
        return '<span style="text-decoration:underline">' . $this->do_shortcode( $content ) . '</span>';
    }

    function shortcode_url( $atts = array(), $content = NULL ) {
        $atts = $this->attributefix( $atts );

        // Google
        if ( isset($atts[0]) ) {
            $url = $atts[0];
            $text = $content;
        }
        // http://www.google.com/
        else {
            $url = $text = $content;
        }

        if ( empty($url) ) return '';
        if ( empty($text) ) $text = $url;

        return '<a href="' . $url . '">' . $this->do_shortcode( $text ) . '</a>';
    }

    function shortcode_image( $atts = array(), $content = NULL ) {
        return '<img src="' . $content . '" alt="" />';
    }

    function shortcode_quote( $atts = array(), $content = NULL ) {
        return '<div class="well well-large well-transparent" style="width:90%;margin-bottom:10px; margin-left:10px; padding:10px"><i class="icon-quote-left icon-2x pull-left icon-muted" style="margin-left:10px"></i>' . $this->do_shortcode( trim(rtrim(ltrim($content,'\n'),'\n')) ) . '<i class="icon-quote-right icon-2x icon-muted" style="margin-top:-10px"></i><br clear="all"></div>';
    }
    
}
?> 
