<?php
defined('MOODLE_INTERNAL') || die;
class block_strayquotes_edit_form extends block_edit_form {
    protected function specific_definition($mform) {
        global $PAGE, $DB, $COURSE;

        // Combobox with Random Stray Quotes instances to link with
        $selectArray = array();
        $instance_query = "Select * from {randomstrayquotes} where course = $COURSE->id";
        $instance_arr = $DB->get_records_sql($instance_query);

        foreach($instance_arr as $instance) {
            $key = $instance->id;
            $value = $instance->name;
            $selectArray[$key] = $value;
        }

        $mform->addElement('select', 'config_instance', get_string('configinstance', 'block_strayquotes'),$selectArray);
        $mform->setType('config_instance', PARAM_TEXT);

        // Combobox with categories
        $selectArray = array();
        $selectArray[0] = "Toutes les cats...";
        $query = "Select * from {randomstrayquotes_categories} where course_id = $COURSE->id";
        $category_arr = $DB->get_records_sql($query);

        foreach($category_arr as $category) {
            $key = $category->id;
            $value = $category->category_name;
            $selectArray[$key] = $value;
        }

        $mform->addElement('select', 'config_category', get_string('configcategory', 'block_strayquotes'),$selectArray);
        $mform->setType('config_category', PARAM_TEXT);

        // Dynamic display AJAX Mode activated?
        $yesnooptions = array('yes'=>get_string('yes'), 'no'=>get_string('no'));

       //$mform->addElement('select', 'config_ajax_enabled', get_string('ajaxenabled', $this->block->block_strayquotes), $yesnooptions);
       $mform->addElement('select', 'config_ajax_enabled', get_string('ajaxenabled', 'block_strayquotes'), $yesnooptions);
       if (empty($this->block->config->ajax_enabled) || $this->block->config->ajax_enabled=='yes') {
           $mform->getElement('config_ajax_enabled')->setSelected('yes');
       } else {
           $mform->getElement('config_ajax_enabled')->setSelected('no');
       }

        //Textbox for the value of the timer (How ong a single quote is displayed)
        $mform->addElement('text', 'config_timer', get_string('timer', 'block_strayquotes'));
        $mform->setDefault('config_timer', get_string('timer', 'block_strayquotes'));
        $mform->setType('config_timer', PARAM_INTEGER);

        //Students can add quotes?
        $attributes = array();
        $attributesbtn = array();
        $attributesbtn[1] = "class='radio-opt'";
        $attributes[1] = "class='radio-group'";
        $radioarray=array();
        $radioarray[] = $mform->createElement('radio', 'studentsaddquotes', '', get_string('yes', 'block_strayquotes'), 1, $attributesbtn);
        $radioarray[] = $mform->createElement('radio', 'studentsaddquotes', '', get_string('no', 'block_strayquotes'), 0, $attributesbtn);
        $mform->addGroup($radioarray, 'radioar', get_string('studentsaddquotes', 'block_strayquotes'), array(' '), false);
        if (empty($this->block->config->studentsaddquotes) || $this->block->config->studentsaddquotes==1){
            $mform->setDefault('studentsaddquotes', 1);
        }else{
            $mform->setDefault('studentsaddquotes', 0);
       }
        $mform->setType('studentsaddquotes', PARAM_INT);
    }
}
