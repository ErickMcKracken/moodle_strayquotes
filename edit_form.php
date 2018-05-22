<?php

class block_strayquotes_edit_form extends block_edit_form {
    protected function specific_definition($mform) {
        global $PAGE, $DB;
/*
       $mform->addElement('selectyesno', 'ajax_enabled', get_string('ajax_enabled', 'block_strayquotes'));
        if (isset($this->block->config->ajax_enabled)) {
            $mform->setDefault('config_ajax_enabled', $this->block->config->display_skype);
        } else {
            $mform->setDefault('config_ajax_enabled', '0');
        }
*/
        
         $yesnooptions = array('yes'=>get_string('yes'), 'no'=>get_string('no'));

        $mform->addElement('select', 'config_ajax_enabled', get_string('ajaxenabled', $this->block->block_strayquotes), $yesnooptions);
        if (empty($this->block->config->ajax_enabled) || $this->block->config->ajax_enabled=='yes') {
            $mform->getElement('config_ajax_enabled')->setSelected('yes');
        } else {
            $mform->getElement('config_eajax_enabled')->setSelected('no');
        }
        
        $mform->addElement('text', 'config_loading_message', get_string('loadingmessage', 'block_strayquotes'));
        $mform->setDefault('config_loading_message', get_string('loadingmessage', 'block_strayquotes'));
        $mform->setType('config_loading_message', PARAM_TEXT);
        
        $mform->addElement('text', 'config_timer', get_string('timer', 'block_strayquotes'));
        $mform->setDefault('config_timer', get_string('timer', 'block_strayquotes'));
        $mform->setType('config_timer', PARAM_TEXT);
        
        
        
    }     
}

 