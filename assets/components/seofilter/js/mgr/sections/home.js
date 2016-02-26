seofilter.page.Home = function (config) {
	config = config || {};
	Ext.applyIf(config, {
		components: [{
			xtype: 'seofilter-panel-home', renderTo: 'seofilter-panel-home-div'
		}]
	});
	seofilter.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(seofilter.page.Home, MODx.Component);
Ext.reg('seofilter-page-home', seofilter.page.Home);