define(['jquery', 'core/config'], function($, cfg) {
 
    return {
        dynamicworker: function(parameter) {
                
	$.ajax({
	    url: M.cfg.wwwroot + '/blocks/strayquotes/getter.php', 
	    success: function(data) {
	      $('.block_strayquotes_quoteDetails').html(data);
	    },
	    complete: function() {
	      // Schedule the next request when the current one's complete
	      setTimeout(dynamicworker, parameter);
            }
	}
    }
);
