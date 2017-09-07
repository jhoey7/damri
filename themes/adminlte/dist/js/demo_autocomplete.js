
	$('#autocomplete').autocomplete({
    //lookup: countries,
    type: "GET",
    serviceUrl: 'index.php/transactions/member/',

	   minChars: 1,
        onSelect: function (suggestion) {
            $('#selection').html('You selected: ' + suggestion.value + ', ' + suggestion.data.category);
        },
        showNoSuggestionNotice: true,
        noSuggestionNotice: 'Sorry, no matching results'
});