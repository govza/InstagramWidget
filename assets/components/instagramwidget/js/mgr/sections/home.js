InstagramWidget.page.Home = function (config) {
	config = config || {};
	Ext.applyIf(config, {
		components: [{
			xtype: 'instagramwidget-panel-home', renderTo: 'instagramwidget-panel-home-div'
		}]
	});
	InstagramWidget.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(InstagramWidget.page.Home, MODx.Component);
Ext.reg('instagramwidget-page-home', InstagramWidget.page.Home);