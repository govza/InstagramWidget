InstagramWidget.window.CreateItem = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'instagramwidget-item-window-create';
	}
	Ext.applyIf(config, {
		title: _('instagramwidget_item_create'),
		width: 550,
		autoHeight: true,
		url: InstagramWidget.config.connector_url,
		action: 'mgr/item/create',
		fields: this.getFields(config),
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
	InstagramWidget.window.CreateItem.superclass.constructor.call(this, config);
};
Ext.extend(InstagramWidget.window.CreateItem, MODx.Window, {

	getFields: function (config) {
		return [{
			xtype: 'textfield',
			fieldLabel: _('instagramwidget_item_name'),
			name: 'name',
			id: config.id + '-name',
			anchor: '99%',
			allowBlank: false,
		}, {
			xtype: 'textarea',
			fieldLabel: _('instagramwidget_item_description'),
			name: 'description',
			id: config.id + '-description',
			height: 150,
			anchor: '99%'
		}, {
			xtype: 'xcheckbox',
			boxLabel: _('instagramwidget_item_active'),
			name: 'active',
			id: config.id + '-active',
			checked: true,
		}];
	}

});
Ext.reg('instagramwidget-item-window-create', InstagramWidget.window.CreateItem);


InstagramWidget.window.UpdateItem = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'instagramwidget-item-window-update';
	}
	Ext.applyIf(config, {
		title: _('instagramwidget_item_update'),
		width: 550,
		autoHeight: true,
		url: InstagramWidget.config.connector_url,
		action: 'mgr/item/update',
		fields: this.getFields(config),
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
	InstagramWidget.window.UpdateItem.superclass.constructor.call(this, config);
};
Ext.extend(InstagramWidget.window.UpdateItem, MODx.Window, {

	getFields: function (config) {
		return [{
			xtype: 'hidden',
			name: 'id',
			id: config.id + '-id',
		}, {
			xtype: 'textfield',
			fieldLabel: _('instagramwidget_item_name'),
			name: 'name',
			id: config.id + '-name',
			anchor: '99%',
			allowBlank: false,
		}, {
			xtype: 'textarea',
			fieldLabel: _('instagramwidget_item_description'),
			name: 'description',
			id: config.id + '-description',
			anchor: '99%',
			height: 150,
		}, {
			xtype: 'xcheckbox',
			boxLabel: _('instagramwidget_item_active'),
			name: 'active',
			id: config.id + '-active',
		}];
	}

});
Ext.reg('instagramwidget-item-window-update', InstagramWidget.window.UpdateItem);