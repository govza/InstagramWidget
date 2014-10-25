InstagramWidget.panel.Home = function (config) {
	config = config || {};
	Ext.apply(config, {
		baseCls: 'modx-formpanel',
		layout: 'anchor',
		/*
		 stateful: true,
		 stateId: 'instagramwidget-panel-home',
		 stateEvents: ['tabchange'],
		 getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
		 */
		hideMode: 'offsets',
		items: [{
			html: '<h2>' + _('instagramwidget') + '</h2>',
			cls: '',
			style: {margin: '15px 0'}
		}, {
			xtype: 'modx-tabs',
			defaults: {border: false, autoHeight: true},
			border: true,
			hideMode: 'offsets',
			items: [{
				title: _('instagramwidget_items'),
				layout: 'anchor',
				items: [{
					html: _('instagramwidget_intro_msg'),
					cls: 'panel-desc',
				}, {
					xtype: 'instagramwidget-grid-items',
					cls: 'main-wrapper',
				}]
			}]
		}]
	});
	InstagramWidget.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(InstagramWidget.panel.Home, MODx.Panel);
Ext.reg('instagramwidget-panel-home', InstagramWidget.panel.Home);
