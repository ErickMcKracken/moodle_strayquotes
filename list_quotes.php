<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('MOODLE_INTERNAL') || die;
<form name="bulkform" id="bulkform" method="post" action="<?php echo $bulkurl ?>">
        
<div class="tablenav">
<div class="alignleft actions" style="margin-right:10px">   
        
// Combo box for actions        
<select name="bulk" id="bulkselect" style="vertical-align:middle;max-width:110px" onchange="javascript:disable_enable()" />
		<option value="noaction" ><?php _e('Bulk Actions','stray-quotes'); ?></option>
		<option value="multidelete"><?php _e('delete','stray-quotes'); ?></option>
		<option value="togglevisible"><?php _e('toggle visibility','stray-quotes'); ?></option>
		<option value="changecategory"><?php _e('change category','stray-quotes'); ?></option>
		</select>
                
 // Combobox for categories                
<select name="catselect" id="catselect" style="vertical-align:middle;max-width:120px"> 
		<?php 
		if(current_user_can('manage_options'))$categorylist = make_categories();
		else $categorylist = make_categories($current_user->user_nicename);
		foreach($categorylist as $categoryo){ 
			?><option value="<?php echo $categoryo; ?>" >
			<?php echo $categoryo;?></option>
		<?php } ?>   
		</select>
		<input type="submit" value="<?php _e('Apply','stray-quotes'); ?>" class="button-secondary action" />
		</div>
        
// How many quote per page?
<div class="alignleft actions"> 
<span style="color:#666; font-size:11px;white-space:nowrap;">display  </span>
<select name="lines" onchange="switchpage(this)"  style="vertical-align:middle">
<option value=listquotes.php?page=stray_manage&qo=quoteID&qc=all&qs=DESC&qp=1&qr=10 selected >10 quotes</option>
<option value=listquotes.php?page=stray_manage&qo=quoteID&qc=all&qs=DESC&qp=1&qr=15 >15 quotes</option>
<option value=listquotes.php?page=stray_manage&qo=quoteID&qc=all&qs=DESC&qp=1&qr=20 >20 quotes</option>
<option value=listquotes.php?page=stray_manage&qo=quoteID&qc=all&qs=DESC&qp=1&qr=30 >30 quotes</option>
<option value=listquotes.php?page=stray_manage&qo=quoteID&qc=all&qs=DESC&qp=1&qr=50 >50 quotes</option>
<option value=listquotes.php?page=stray_manage&qo=quoteID&qc=all&qs=DESC&qp=1&qr=100 >100 quotes</option>
</select> <!--<span style="color:#666; font-size:11px;white-space:nowrap;"> from  </span>-->
<select name="categories" onchange="switchpage(this)"  style="vertical-align:middle;max-width:120px"> 
<option value="listquotes.php?page=stray_manage&qo=quoteID&qp=1&qr=10&qs=DESC&qc=all" 
 selected>all categories</option>
<option value="listquotes.php?page=stray_manage&qo=quoteID&qp=1&qr=10&qs=DESC&qc=default"  >default</option>
<option value="listquotes.php?page=stray_manage&qo=quoteID&qp=1&qr=10&qs=DESC&qc=Socialism"  >Socialism</option>
<option value="listquotes.php?page=stray_manage&qo=quoteID&qp=1&qr=10&qs=DESC&qc=Communism"  >Communism</option>
</select></div>

// pager
<div class="tablenav-pages">
<span class="displaying-num">Page 1 of 87</span><strong>&nbsp;&nbsp;1 <a href="listquotes.php?page=stray_manage&qo=quoteID&qr=10&qc=all&qs=DESC&qp=2">2</a>  . <a href="listquotes.php?page=stray_manage&qo=quoteID&qr=10&qc=all&qs=DESC&qp=87"> 87</a>  <a href="listquotes.php?page=stray_manage&qo=quoteID&qr=10&qc=all&qs=DESC&qp=2" title=" Next 10">&raquo;</a> </strong>
</div>
</div>


<table class="widefat" id="straymanage">         
<thead><tr>
<th scope="col" style="padding-left: 0; margin-left:0">
<input type="checkbox" style="padding-left:0" /></th>   				
<th scope="col" style="white-space: nowrap;"> ID<a href="listquotes.php??page=stray_manage&qo=quoteID&qp=1&qr=10&qc=all&qs=ASC">
					<img src= http://culturalmarxism.net/wp-content/plugins/stray-quotes/img/s_desc.png alt="Ascending" title="Ascending" /></a>
</th>
<th scope="col"> Quote </th>				
<th scope="col" style="white-space: nowrap;"><a href="listquotes.php?page=stray_manage&qp=1&qr=10&qc=all&qs=DESC&qo=author">Author</a>				            
</th>				
<th scope="col" style="white-space: nowrap;"><a href="listquotes.php?page=stray_manage&qp=1&qr=10&qc=all&qs=DESC&qo=source">Source</a>
</th>
<th scope="col" style="white-space: nowrap;"><a href="listquotes.php?page=stray_manage&qp=1&qr=10&qc=all&qs=DESC&qo=category">Category</a>
</th>			
<th scope="col" style="white-space: nowrap;"><a href="listquotes.php?page=stray_manage&qp=1&qr=10&qc=all&qs=DESC&qo=visible">Visible</a>
</th>           
<th scope="col">&nbsp;</th>
<th scope="col">&nbsp;</th>            
</tr></thead>
                
<tbody>		
<tr  class="alternate"  >      				
<td scope="col" style="white-space: nowrap;"><input type="checkbox" name="check_select0" value="868" /> </td> 
<th scope="row">868</th>
<td>Yeah, well, you know, that’s just, like, your opinion, man.</td>
<td>The Dude</td>
<td>Big Lebowski - The Movie</td>
<td>Nihilism</td>
<td>yes</td>
        
<td align="center">
<a href="listquotes.php?page=stray_manage&qo=quoteID&qp=1&qr=10&qc=all&qs=DESC&qa=edit&qi=868">
Edit</a></td>
<td align="center">
<a href="listquotes.php?page=stray_manage&qo=quoteID&qp=1&qr=10&qc=all&qs=DESC&qa=delete&qi=868"
					onclick="if ( confirm('You are about to delete quote 868.\n\'Cancel\' to stop, \'OK\' to delete.') ) { return true;}return false;">Delete</a></td>			
</tr>				
</tbody>
         
<span class="displaying-num">Page 1 of 87</span><strong>&nbsp;&nbsp;1 <a href="listquotes.php?page=stray_manage&qo=quoteID&qr=10&qc=all&qs=DESC&qp=2">2</a>  . <a href="listquotes.php?page=stray_manage&qo=quoteID&qr=10&qc=all&qs=DESC&qp=87"> 87</a>  <a href="listquotes.php?page=stray_manage&qo=quoteID&qr=10&qc=all&qs=DESC&qp=2" title=" Next 10">&raquo;</a> </strong>            
</div></div></form></div>
