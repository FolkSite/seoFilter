seoFilter.combo.ParamType = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        store: new Ext.data.ArrayStore({
            id: 0,
            fields: ['code', 'display'],
            data: [
                ['field', _('seofilter_param_type_field')],
                ['field_json', _('seofilter_param_type_field_json')],
                ['vendor', _('seofilter_param_type_vendor')]
            ]
        }),
        mode: 'local',
        displayField: 'display',
        valueField: 'code'
    });
    seoFilter.combo.ParamType.superclass.constructor.call(this,config);
};
Ext.extend(seoFilter.combo.ParamType,MODx.combo.ComboBox);
Ext.reg('seofilter-combo-param-type', seoFilter.combo.ParamType);


seoFilter.combo.Param = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        fields: ['id','name']
        ,valueField: 'id'
        ,displayField: 'name'
        ,hiddenName: 'thread'
        ,allowBlank: false
        ,url: seoFilter.config.connector_url
        ,baseParams: {
            action: 'mgr/param/getcombolist'
            ,combo: 1
            ,id: config.value
        }
        ,pageSize: 20
        ,width: 300
        ,editable: true
    });
    seoFilter.combo.Param.superclass.constructor.call(this,config);
};
Ext.extend(seoFilter.combo.Param, MODx.combo.ComboBox);
Ext.reg('seofilter-combo-param',seoFilter.combo.Param);