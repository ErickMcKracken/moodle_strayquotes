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
        $this->version = 2018051503;
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
            $this->config = new stdClass();
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
        
/*******************************************************/
/*               Pick a random key in array   #1       */
/*******************************************************/        
        
        function array_random($arr, $num = 1) {
            shuffle($arr);

            $r = array();
            for ($i = 0; $i < $num; $i++) {
                $r[] = $arr[$i];
            }
            return $num == 1 ? $r[0] : $r;
        }
              
/*******************************************************/
/*   Retrieve array of quotes and pick one randomly    */
/*******************************************************/       
        
        $this->content = new stdClass;
       // $quote = $DB->get_record('block_strayquotes', ['id' => $this->config->quote_id]);
        $sql = "SELECT `ID`,`quote`,`author`,`source` FROM mdl_block_strayquotes WHERE `public`='yes' ORDER BY id desc " ;
	        $quotes = $DB->get_records_sql($sql);
		//$totalquotes = count($quote)-1;
               // array_rand($quote, 1)
               // $quote = $quotes[mt_rand(0, count($quotes) -1)];
                $quote = array_random($quotes, $num = 1);
                
/*******************************************************/
/*          Display the quote in the block             */
/*******************************************************/
                
        if ($quote) {
            //$this->content->text = $quote->quote ;
            //$this->content->text = $quote->quote . "-" . $quote->author;
            $formatage = $quote->quote . "<br>-&nbsp;" . $quote->author;
            $this->content->text = $formatage;
        }
        else {
            $this->content->text = 'Bloc à configurer.';
        }

        $this->content->footer = '';
        return $this->content;
    }
    
}