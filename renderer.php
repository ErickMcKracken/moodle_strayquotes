<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('MOODLE_INTERNAL') || die;

/*******************************************************/
/*          Display the quote in the block             */
/*******************************************************/

class block_strayquotes_renderer extends plugin_renderer_base{
    public function display_quote($quote, $author_name, $author_picture, $source){
         
        $content = html_writer::start_tag('div', array('class' => 'block_strayquotes_quote'));
        $content .= html_writer::start_tag('div', array('class' => 'block_strayquotes_quoteDetails'));
        $content .= html_writer::empty_tag('img', array('src' => $author_picture, 'alt' => $author_name, 'class' => 'block_strayquotes_authorpix'));
        $content .= html_writer::start_span('block_strayquotes_quoteText') . $quote . html_writer::end_span();
        $content .= html_writer::tag('br');
        $content .= html_writer::start_span('block_strayquotes_author') . "- " . $author_name . html_writer::end_span();
        if ($source){
          $content .= html_writer::start_span('block_strayquotes_source') . "&nbsp;&nbsp;-" . $source . html_writer::end_span();
        }
        $content .= html_writer::end_tag('div');
        $content .= html_writer::end_tag('div');
        
        return $content;
    }
}