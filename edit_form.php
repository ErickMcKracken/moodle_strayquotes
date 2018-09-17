<?php
defined('MOODLE_INTERNAL') || die;
class block_strayquotes_edit_form extends block_edit_form {
    protected function specific_definition($mform) {
        global $PAGE, $DB;

         $yesnooptions = array('yes'=>get_string('yes'), 'no'=>get_string('no'));

        //$mform->addElement('select', 'config_ajax_enabled', get_string('ajaxenabled', $this->block->block_strayquotes), $yesnooptions);
        $mform->addElement('select', 'config_ajax_enabled', get_string('ajaxenabled', 'block_strayquotes'), $yesnooptions);
        if (empty($this->block->config->ajax_enabled) || $this->block->config->ajax_enabled=='yes') {
            $mform->getElement('config_ajax_enabled')->setSelected('yes');
        } else {
            $mform->getElement('config_ajax_enabled')->setSelected('no');
        }

        // Combobox with categories
        $selectArray = array();
        $selectArray[0] = "Toutes les cats...";
        $query = "Select * from {randomstrayquotes_categories}";
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

        //Students can add authors?
        $attributes = array();
        $attributesbtn = array();
        $attributesbtn[1] = "class='radio-opt'";
        $attributes[1] = "class='radio-group'";
        $radioarray=array();
        $radioarray[] = $mform->createElement('radio', 'studentsaddauthors', '', get_string('yes', 'block_strayquotes'), 1, $attributesbtn);
        $radioarray[] = $mform->createElement('radio', 'studentsaddauthors', '', get_string('no', 'block_strayquotes'), 0, $attributesbtn);
        $mform->addGroup($radioarray, 'radioar', get_string('studentsaddauthors', 'block_strayquotes'), array(' '), false);
        if (empty($this->block->config->studentsaddauthors) || $this->block->config->studentsaddauthors==1) {
            $mform->setDefault('studentsaddauthors', 1);
        }else{
            $mform->setDefault('studentsaddauthors', 0);
        }
        $mform->setType('studentsaddauthors', PARAM_INT);

        //Students can add categories?
        $attributes = array();
        $attributesbtn = array();
        $attributesbtn[1] = "class='radio-opt'";
        $attributes[1] = "class='radio-group'";
        $radioarray=array();
        $radioarray[] = $mform->createElement('radio', 'studentsaddcategories', '', get_string('yes', 'block_strayquotes'), 1, $attributesbtn);
        $radioarray[] = $mform->createElement('radio', 'studentsaddcategories', '', get_string('no', 'block_strayquotes'), 0, $attributesbtn);
        $mform->addGroup($radioarray, 'radioar', get_string('studentsaddcategories', 'block_strayquotes'), array(' '), false);
        if (empty($this->block->config->studentsaddcategories) || $this->block->config->studentsaddcategories==1) {
            $mform->setDefault('studentsaddcategories', 1);
        }else{
            $mform->setDefault('studentsaddcategories', 0);
        }
        $mform->setType('studentsaddcategories', PARAM_INT);

    }
}
