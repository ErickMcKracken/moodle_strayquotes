function dynamicworker(timer, courseid) {
   $.ajax({
    url: M.cfg.wwwroot + '/blocks/strayquotes/getter.php',
    data: {
      "courseid": courseid
    }
    success: function(data) {
      $('.block_strayquotes_quoteDetails').html(data);
    },
    complete: function() {
      // Schedule the next request when the current one's complete
      setTimeout(dynamicworker, timer);
    }
  });
};
