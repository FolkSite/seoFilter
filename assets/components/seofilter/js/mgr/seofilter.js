var seofilter = function (config) {
	config = config || {};
	seofilter.superclass.constructor.call(this, config);
};
Ext.extend(seofilter, Ext.Component, {
	page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('seofilter', seofilter);

seofilter = new seofilter();