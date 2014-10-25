var InstagramWidget = function (config) {
	config = config || {};
	InstagramWidget.superclass.constructor.call(this, config);
};
Ext.extend(InstagramWidget, Ext.Component, {
	page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('instagramwidget', InstagramWidget);

InstagramWidget = new InstagramWidget();