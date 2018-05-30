<?php

class block_strayquotes extends block_base {

    function init() {
        $this->title = 'strayquotes';
        $this->version = 2018051503;
    }

    function applicable_formats() {
        return array('course-view' => true);
    }

    function instance_allow_config() {
        return true;
    }

    function get_content() {
        global $DB, $PAGE;
        $PAGE->requires->js(new moodle_url('/blocks/strayquotes/js/dyn.js'));
        //$PAGE->requires->js(new moodle_url('/blocks/strayquotes/js/test.js'));

        if ($this->config == null) {
            //le bloc vient d'être créé
            $this->config = new stdClass();
            $this->config->author = '';
            $this->config->quote_id = 0;
            $this->content = new stdClass;
            $this->content->text = 'Configurer le block';
            $this->content->footer = '';
            parent::instance_config_commit();
            return $this->content;
        } else {
            $timer = 5000;
            //$PAGE->requires->js_init_call('testA', [$this->config->timer, 'valeur 2']);
            //$PAGE->requires->js_call_amd('block_strayquotes/test', 'testEric', ['Hello world 3!!']);
            $this->content = new stdClass;   //Correction du warning  "Creating default object from empty value"
            $renderer = $this->page->get_renderer('block_strayquotes');
            $this->content->text = $this->get_quote($DB,$renderer);
            $PAGE->requires->js_call_amd('block_strayquotes/dyn', 'dynamicworker', [$timer]);
            return $this->content;
        }
    }

    /*******************************************************/
    /*   Retrieve array of quotes and pick one randomly    */
    /*******************************************************/
    function get_quote($DB, $renderer) {

        //$this->content = new stdClass;
        $sql = "SELECT `ID`,`quote`,`author_id`,`source` FROM mdl_block_strayquotes WHERE `visible`='yes' ORDER BY id desc ";
        $quotes = $DB->get_records_sql($sql);
        $quote = $this->array_random($quotes, $num = 1);
        $authorid = $quote->author_id;
        $author = $this->get_author($DB, $authorid);
        $author_picture = $author->author_picture;
        $stray_quote = $quote->quote;
        $author_name = $author->author_name;
        $source = $quote->source;
        if ($quote) {
            //$renderer = $this->page->get_renderer('block_strayquotes');
            $content = $renderer->display_quote($stray_quote, $author_name, $author_picture, $source);
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
        $author = $DB->get_record('block_strayquotes_authors', array('id' => $param), '*', MUST_EXIST);
        return $author;
    }

}
