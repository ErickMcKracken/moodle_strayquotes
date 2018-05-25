<?php
defined('MOODLE_INTERNAL') || die;
class block_strayquotes_edit_form extends block_edit_form {
    protected function specific_definition($mform) {
        global $PAGE, $DB;

         $yesnooptions = array('yes'=>get_string('yes'), 'no'=>get_string('no'));

        $mform->addElement('select', 'config_ajax_enabled', get_string('ajaxenabled', $this->block->block_strayquotes), $yesnooptions);
        if (empty($this->block->config->ajax_enabled) || $this->block->config->ajax_enabled=='yes') {
            $mform->getElement('config_ajax_enabled')->setSelected('yes');
        } else {
            $mform->getElement('config_ajax_enabled')->setSelected('no');
        }

        // Combobox with categories
        $selectArray = array();
        $selectArray[0] = "Toutes les cats...";
        $query = "Select * from {block_strayquotes_categories}";
        $category_arr = $DB->get_records_sql($query);

        
        foreach($category_arr as $category) {
            $key = $category->id;
            $value = $category->category_name;
            $selectArray[$key] = $value;
        }
   
        $mform->addElement('select', 'config_category', get_string('configcategory', 'block_strayquotes'),$selectArray);
      //  $mform->setDefault('config_category',  $category['selected']);
        $mform->setType('config_category', PARAM_TEXT);
        
        // Textbox for the loading mesage
        $mform->addElement('text', 'config_loading_message', get_string('loadingmessage', 'block_strayquotes'));
        $mform->setDefault('config_loading_message', get_string('Loading...', 'block_strayquotes'));
        $mform->setType('config_loading_message', PARAM_TEXT);
        
        //Textbox for the value of the timer
        $mform->addElement('text', 'config_timer', get_string('timer', 'block_strayquotes'));
        $mform->setDefault('config_timer', get_string('timer', 'block_strayquotes'));
        $mform->setType('config_timer', PARAM_INTEGER);
          
    }     
}

 