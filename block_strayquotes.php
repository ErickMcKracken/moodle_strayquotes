<?php

class block_strayquotes extends block_base {

    function init() {
        $this->title = 'strayquotes';
        $this->version = 2018051503;
       // $PAGE->set_context(context_course::instance($courseid));
    }

    function applicable_formats() {
        return array('course-view' => true);
    }

    function instance_allow_config() {
        return true;
    }

    function get_content() {
        global $DB, $PAGE, $COURSE;
        //$PAGE->requires->js(new moodle_url('/blocks/strayquotes/js/dyn.js'));
        //$PAGE->requires->js_function_call(new moodle_url('/blocks/strayquotes/js/dyn.js'), [$timer, $COURSE->id], false, 10000 );
        //$PAGE->requires->js(new moodle_url('/blocks/strayquotes/js/test.js'));

        if ($this->config == null) {
            //le bloc vient d'être créé
            $this->content = new stdClass;
            $this->content->text = 'Configurer le block';
            $this->content->footer = '';
            parent::instance_config_commit();
            return $this->content;
        } else {
            $timer = $this->config->timer;
            //$PAGE->requires->js_init_call('testA', [$this->config->timer, 'valeur 2']);
            //$PAGE->requires->js_call_amd('block_strayquotes/test', 'testEric', ['Hello world 3!!']);
            $this->content = new stdClass;   //Correction du warning  "Creating default object from empty value"
            $renderer = $this->page->get_renderer('block_strayquotes');
            $renderer->set_block_instance($this);
            $this->content->text = $this->get_quote($DB, $renderer);
            if ($this->config->ajax_enabled == 'yes'){
               $PAGE->requires->js_call_amd('block_strayquotes/dyn', 'dynamicworker', [$timer, $COURSE->id]);
            }
            return $this->content;
        }
    }

    function get_image($authorid, $courseid){
        global $DB;
        // We define the context
        $ctx = context_course::instance($courseid);
        $imageid = $DB->get_record('randomstrayquotes_authors', ['id' => $authorid], 'author_picture');
        $fs = get_file_storage();

        // We obtain the filePathHash for the file storage area
        $imagePathHash = $fs->get_area_files($ctx->id, 'mod_randomstrayquotes', 'content', $imageid->author_picture, "itemid, filepath, filename", false);
        // We obtain the id of the picture file already present for the author using the imagePathHash
        $files = array_values($imagePathHash);

         foreach ($files as $file){
                if ($file) {
                 $filename = $file->get_filename();
                 if ($filename){
                       $url = moodle_url::make_pluginfile_url($file->get_contextid(), 'mod_randomstrayquotes','content', $file->get_itemid(),'/' ,$filename);
                }else{
                    $url = "crap";
                 }
                }
        return $url;
         }
    }

    /*******************************************************/
    /*   Retrieve array of quotes and pick one randomly    */
    /*******************************************************/
    function get_quote($DB, $renderer) {
        global $DB, $COURSE;
        $courseid = $COURSE->id;

        // Query to get the quote
        $sql = "SELECT * FROM mdl_randomstrayquotes_quotes WHERE `visible`='1' and course_id = $COURSE->id ORDER BY id desc ";
        $quotes = $DB->get_records_sql($sql);
        // If there is some quotes in the array we pick one at random
        if ($quotes){
            $quote = $this->array_random($quotes, $num = 1);
        }else{
               $content = 'You should feed some quotes in the randomstrayquotes module first.';
        }
        // If the is some quotes in the array we pick one at random and call the renderer to display it in the block
        if ($quote) {
            //We get the author associated with the quote
            $authorid = $quote->author_id;
            $authorpix =  $this->get_image($authorid, $courseid);
            $author = $this->get_author($DB, $authorid);
            //We extract the proper infos to be pass to the renderer
            $stray_quote = $quote->quote;
            $author_name = $author->author_name;
            $source = $quote->source;
            //We call the renderer to display the quote in the block
              $content = $renderer->display_quote($stray_quote, $courseid, $authorid, $author_name, $authorpix, $source);
        } else {
            $content = 'Bloc à configurer.';
        }
        return $content;
    }

    /*******************************************************/
    /*       Pick a random key in an array of quotes       */
    /*******************************************************/

    function array_random($arr, $num = 1) {
        shuffle($arr);

        $r = array();
        for ($i = 0; $i < $num; $i++) {
            $r[] = $arr[$i];
        }
        return $num == 1 ? $r[0] : $r;
    }

    /********************************************************************/
    /*   Retrieve the author of the associated quote and his picture    */
    /********************************************************************/

    function get_author($DB, $param) {
        $author = $DB->get_record('randomstrayquotes_authors', array('id' => $param), '*', MUST_EXIST);
        return $author;
    }
}
