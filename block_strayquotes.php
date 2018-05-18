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
        
  /*      $renderer = $this->page->get_renderer('block_strayquotes');
        $row[] = $renderer->get_quote();
  */    
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
              
        
 function get_author($DB, $param){
            //$author = $DB->get_record('block_strayquotes_authors', ['id' => $param]); 
            $author = $DB->get_record('block_strayquotes_authors', array('id' => $param), '*', MUST_EXIST); 
          // $author = $DB->get_record_sql('select * from {block_strayquotes_authors} where id = ?', $param[1] );
           // $author = $DB->get_record_sql('select * from {block_strayquotes_authors} where id=" . &param . " ');
           //$author = $DB->get_record_sql('select * from {block_strayquotes_authors} where id=1'); 
           return $author;
  }        
/*******************************************************/
/*   Retrieve array of quotes and pick one randomly    */
/*******************************************************/       
        
        $this->content = new stdClass;
       // $quote = $DB->get_record('block_strayquotes', ['id' => $this->config->quote_id]);
        $sql = "SELECT `ID`,`quote`,`author_id`,`source` FROM mdl_block_strayquotes WHERE `visible`='yes' ORDER BY id desc " ;
	        $quotes = $DB->get_records_sql($sql);
                $quote = array_random($quotes, $num = 1);
                $authorid = $quote->author_id;
                $author = get_author($DB, $authorid);
              //  echo "auteur:" . $author;
 
/*******************************************************/
/*          Display the quote in the block             */
/*******************************************************/
                
                
                
                
        if ($quote) {
            //$this->content->text = $quote->quote ;
            //$this->content->text = $quote->quote . "-" . $quote->author;
            //$formatage = $quote->quote . "<div> <img src=" . $author->author_picture . " /><br>-&nbsp;" . $author->author_name;
            //$formatage = "<div class=quote><div class=quoteDetails><img src=" . $author->author_picture . " /><div style=float:left; class=quoteText>&ldquo; " . $quote->quote . " &rdquo;<br>  &#8213;"  . $author->author_name . "</div></div></div>" ;
            
            $formatage = "<p><img class=quotepix src=" . $author->author_picture . " />   &ldquo; " . $quote->quote . " &rdquo;<br>  &#8213;"  . $author->author_name . "</p>" ;
            
            //$formatage = "<div id=container><div id=floated><img src=" . $author->author_picture . " /></div>   &ldquo; " . $quote->quote . " &rdquo;<br>  &#8213;"  . $author->author_name . "</div>" ;
            
             //$formatage = "<p class=cossin><img class=cossin2 src=" . $author->author_picture . " /></div>   &ldquo; " . $quote->quote . " &rdquo;<br>  &#8213;"  . $author->author_name . "</p>" ;
            
            
            $this->content->text = $formatage;
        }
        else {
            $this->content->text = 'Bloc à configurer.';
        }

        $this->content->footer = '';
        return $this->content;
    }   
}