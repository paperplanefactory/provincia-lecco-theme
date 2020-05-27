/* globals global */
jQuery(function($) {
  var searchRequest;
  $('.search-autocomplete').autoComplete({
    minChars: 2,
    select: function(event, ui) {
      var permalink = 'https://www.yahoo.it/'; // Get permalink from the datasource

      window.location.replace(permalink);
    },
    source: function(term, suggest) {
      try {
        searchRequest.abort();
      } catch (e) {}
      searchRequest = $.post(global.ajax, {
        search: term,
        action: 'search_site'
      }, function(res) {
        suggest(res.data);
      });
    }
  });

});