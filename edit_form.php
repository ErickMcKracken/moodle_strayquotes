<?php
/**
 * Created by PhpStorm.
 * User: nmoller
 * Date: 14/05/18
 * Time: 4:32 PM
 */

class block_strayquotes_edit_form extends block_edit_form {
    protected function specific_definition($mform) {
        global $PAGE, $DB;
        $PAGE->requires->js(new moodle_url('/blocks/strayquotes/js/form.js'));

        $query = "Select distinct author from {block_strayquotes}";
        $quote_arr = $DB->get_records_sql($query);

        // Field for editing Side Bar block title
        $mform->addElement('header', 'configheader', 'strayquotes config');

        $authors = ['Choose author'];
        foreach ($quote_arr as $author) {
            $key = str_replace(" ","_", $author->author);
            $authors[$key] = $author->author;
        }


        $mform->addElement('select', 'config_author', 'config author', $authors);
        $mform->setType('config_author', PARAM_TEXT);

        $quotes_array = ['3'=>"Select author first"];
        $mform->addElement('select', 'config_quote_id', "Select quote", $quotes_array);
        $mform->setType('config_quote_id', PARAM_TEXT);
    }

}