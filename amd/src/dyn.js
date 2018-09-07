define(['jquery', 'core/config'], function($, cfg) {
  return {
    dynamicworker: function(parameter, courseid) {
      $.ajax({
        url: cfg.wwwroot + '/blocks/strayquotes/getter.php',
        data: {
          "courseid": courseid
        },
        success: function(data) {
          $('.block_strayquotes_quoteDetails').html(data);
          //setTimeout(this, parameter);
        }
      });
    }
  }
});
