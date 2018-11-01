<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('MOODLE_INTERNAL') || die;


function get_image($authorid, $courseid){
        global $DB;
           //var_dump($courseid); die();
        // We define the context
        $ctx = context_course::instance($courseid);
     //   echo "<pre>";
       // var_dump($ctx);
       // echo "</pre>";
       // die();*/
        // We setup the file storage area
        $imageid = $DB->get_record('randomstrayquotes_authors', ['id' => $authorid], 'author_picture');
        //var_dump($imageid); die();
        $fs = get_file_storage();

        // We obtain the filePathHash for the file storage area
        $imagePathHash = $fs->get_area_files($ctx->id, 'mod_randomstrayquotes', 'content', $imageid->author_picture, "itemid, filepath, filename", false);
      //  var_dump($ctx->id);
       // var_dump($imageid->author_picture);
       // die();
        //   var_dump($imagePathHash); die();
        // We obtain the id of the picture file already present for the author using the imagePathHash
        $files = array_values($imagePathHash);
       //var_dump($files ); Die();
        // We store the context and the id of the file in an array of parameters that we will pass at the form instanciation
        $file = $files[0];
       // echo $file;
         // var_dump($ctx);
       // echo "<pre>";
       // var_dump($files);
       // echo "</pre>";
        //die();
        //$file = $files[0];
       // echo $file;
       // var_dump($file); die();
       // $filename = $file->get_filename();
       // $url = moodle_url::make_pluginfile_url($file->get_contextid(), 'mod_randomstrayquotes','content', $file->get_itemid(),'/' ,$filename);
       // return $url;

        if($file){
            $filename = $file->get_filename();
            $url = moodle_url::make_pluginfile_url($file->get_contextid(), 'mod_randomstrayquotes','content', $file->get_itemid(),'/' ,$filename);
        }else{
            echo("shit");
        }
         return $url;

    /*
         foreach ($files as $file){
                if ($file) {
                 $filename = $file->get_filename();
                  $url = moodle_url::make_pluginfile_url($file->get_contextid(), 'mod_randomstrayquotes','content', $file->get_itemid(),'/' ,$filename);
                 if ($filename){
                      //var_dump($filename); Die();
                       $url = moodle_url::make_pluginfile_url($file->get_contextid(), 'mod_randomstrayquotes','content', $file->get_itemid(),'/' ,$filename);
                          //var_dump($url); Die();
                        return $url;
                 }
                }


         }





        /*
       foreach ($files as $file){
                if ($file) {
                 $filename = $file->get_filename();
                 if ($filename){
                      $url = moodle_url::make_pluginfile_url($file->get_contextid(), 'mod_randomstrayquotes','content', $file->get_itemid(),'/' ,$filename);
                      var_dump($url ); Die();
                      return $url;
                }else{
                    $url = "pix/xx.jpg";
                    return $url;
                }
          }
       }
    */
    }

/*******************************************************/
/*          Display the quote in the block             */
/*******************************************************/

class block_strayquotes_renderer extends plugin_renderer_base{

  public function set_block_instance(block_strayquotes $block) {
      $this->block_instance = $block;
  }
    public function display_quote($quote, $courseid, $authorid, $author_name, $authorpix, $source){
        global $COURSE, $USER;
        $courseid = $COURSE->id;
        $userid = $USER->id;
        //$authorpix =  get_image($authorid, $courseid);
        //$authorpix =  get_image(6, 21155);
        $content = html_writer::start_tag('div', array('class' => 'block_strayquotes_quote'));
        $content .= html_writer::start_tag('div', array('class' => 'block_strayquotes_quoteDetails'));
       // $content .= html_writer::empty_tag('img', array('src' => $author_picture, 'alt' => $author_name, 'class' => 'block_strayquotes_authorpix'));
        $content .= html_writer::empty_tag('img', array('src' => $authorpix, 'alt' => $author_name, 'class' => 'block_strayquotes_authorpix'));
        $content .= html_writer::start_span('block_strayquotes_quoteText') . $quote . html_writer::end_span();
        $content .= html_writer::tag('br', null, null);
        $content .= html_writer::start_span('block_strayquotes_author') . "- " . $author_name . html_writer::end_span();
        if ($source){
          $content .= html_writer::start_span('block_strayquotes_source') . "&nbsp;&nbsp;-" . $source . html_writer::end_span();
        }
        $content .= html_writer::empty_tag('br', null, null);
        $content .= html_writer::empty_tag('br', null, null);

        $config = $this->block_instance->config;
        $instance = $config->instance;
        if ($config->studentsaddquotes == 1){
            $content .= html_writer::start_tag('div', array('class' => 'block_strayquotes_link'));
            $content .= html_writer::link(new moodle_url('/mod/randomstrayquotes/list_quotes.php', array('courseid'=>$courseid, 'userid'=>$userid, 'instance'=>$instance)), get_string('addQuotes','block_strayquotes'));
            $content .= html_writer::end_tag('div');
        }
        $content .= html_writer::end_tag('div');
        $content .= html_writer::end_tag('div');
        return $content;
    }
}
