window.onload = init;

function init() {

    // When a select is changed, look for the students based on the department id
    // and display on the dropdown students select
    $('#id_config_author').change(function() {
        $('#id_config_quote_id').load(M.cfg.wwwroot + '/blocks/strayquotes/getter.php?author=' + $('#id_config_author').val());
    });

}