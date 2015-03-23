/*jslint browser: true*/
/*global $, jQuery, alert*/

// Configure DataTables defaults
$.extend($.fn.dataTable.defaults, {
	paging: false,
	language: { url: window.absolute_url + "index.php/translate/datatables" },
    aaSorting: []
});