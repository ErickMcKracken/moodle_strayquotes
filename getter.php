<?php
// Set page context?????
 require_login() ; 
require_once(__DIR__ . "/../../config.php");
require_once($CFG->dirroot . '/blocks/moodleblock.class.php');
require_once(__DIR__ . '/block_strayquotes.php');
require_once($CFG->dirroot . '/lib/outputrenderers.php');
require_once(__DIR__ . '/renderer.php'); ;


global $DB, $PAGE;
$block = new \block_strayquotes();
$render = new \block_strayquotes_renderer($PAGE, $DB);

echo $block->get_quote($DB, $render);