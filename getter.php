<?php
/**
 * Created by PhpStorm.
 * User: nmoller
 * Date: 14/05/18
 * Time: 4:53 PM
 */

require_once("../../config.php");
global $DB;

// Get the parameter
$author = optional_param('author',  '',  PARAM_TEXT);

//TODO: Controler un peu l'access

// If departmentid exists
if($author) {

    //TODO: Problème de noms avec pas 2 composantes
    $comps = explode('_', $author);

    // Do your query
    $quote_arr = $DB->get_records('block_strayquotes', ['author' => "$comps[0] $comps[1]"], 'quote');

    // echo your results, loop the array of objects and echo each one
    echo "<option value='0'>Choose one quote</option>";
    foreach ($quote_arr as $id => $quote) {
        echo "<option value=".$id.">" . substr($quote->quote, 0, 20) . "</option>";
    }

}