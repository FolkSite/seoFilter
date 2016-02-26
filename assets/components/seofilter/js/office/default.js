Ext.onReady(function() {
	seofilter.config.connector_url = OfficeConfig.actionUrl;

	var grid = new seofilter.panel.Home();
	grid.render('office-seofilter-wrapper');

	var preloader = document.getElementById('office-preloader');
	if (preloader) {
		preloader.parentNode.removeChild(preloader);
	}
});