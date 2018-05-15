<?php
/**
 * Created by PhpStorm.
 * User: nmoller
 * Date: 14/05/18
 * Time: 4:30 PM
 */

class block_strayquotes extends block_base {

    function init() {
        $this->title = 'strayquotes';
        $this->version = 2018051501;
    }

    function applicable_formats() {
        return array('course-view' => true);
    }

    /**
     * Is each block of this type going to have instance-specific configuration?
     * Normally, this setting is controlled by {@link instance_allow_multiple()}: if multiple
     * instances are allowed, then each will surely need its own configuration. However, in some
     * cases it may be necessary to provide instance configuration to blocks that do not want to
     * allow multiple instances. In that case, make this function return true.
     * I stress again that this makes a difference ONLY if {@link instance_allow_multiple()} returns false.
     * @return boolean
     */
    function instance_allow_config() {
        return true;
    }


    function get_content() {
        global $DB;

        if ($this->config == null) {
            //le bloc vient d'être créé
            $this->config = new \stdClass();
            $this->config->author = '';
            $this->config->quote_id = 0;

            $this->content = new stdClass;

            $this->content->text ='Configurer le block';
            $this->content->footer = '';
            parent::instance_config_commit();

            return $this->content;
        }
        //else {
            // On a ajouté ces paramètres
            //var_dump($this->config);
        //}


        $this->content = new stdClass;
        $quote = $DB->get_record('block_strayquotes', ['id' => $this->config->quote_id]);
        if ($quote) {
            $this->content->text = $quote->quotes;
        }
        else {
            $this->content->text = 'Bloc à configurer.';
        }

        $this->content->footer = '';
        return $this->content;
    }

}