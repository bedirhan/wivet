/*!
 * Ext JS Library 3.0.3
 * Copyright(c) 2006-2009 Ext JS, LLC
 * licensing@extjs.com
 * http://www.extjs.com/license
 */
Ext.onReady(function(){

    //Ext.QuickTips.init();

    // turn on validation errors beside the field globally
    //Ext.form.Field.prototype.msgTarget = 'side';

    var bd = Ext.getBody();

    /*
     * ================  Simple form  =======================
     */

     
    bd.createChild({tag: 'h2', html: 'Form w/ EXT JS 3.0.3 Library'});


    var simple = new Ext.FormPanel({
        labelWidth: 100, // label settings here cascade unless overridden
        url:'../innerpages/'+'18_1a2f3.php',
        standardSubmit: true,
        frame:true,
        title: '',
        bodyStyle:'padding:5px 5px 0',
        width: 350,
        defaults: {width: 230},
        defaultType: 'textfield',

        items: [{
                fieldLabel: 'First Name',
                name: 'first'
            },{
                fieldLabel: 'Last Name',
                name: 'last'
            }
        ],

        buttons: [{
            text: 'Submit',
            handler: function() {
        	simple.getForm().getEl().dom.action = simple.url;
                simple.getForm().getEl().dom.method = 'POST';
                simple.getForm().submit();
            }
        },{
            text: 'Cancel'
        }]
    });

    simple.render(document.body);

    /*

    // simple array store
    var store = new Ext.data.ArrayStore({
        fields: ['abbr', 'state', 'nick'],
        data : Ext.exampledata.states // from states.js
    });
    
    var combo = new Ext.form.ComboBox({
        store: store,
        displayField:'state',
        typeAhead: true,
        mode: 'local',
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'Select a state...',
        selectOnFocus:true,
        applyTo: 'local-states'
    });
    */

});