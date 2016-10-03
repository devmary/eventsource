/**
 * Created with Adam Bui.
 * User: Adam Bui
 * Date: 1/20/15
 * Time: 2:35 PM
 * To change this template use File | Settings | File Templates.
 */
(function() {
	//Insert Button Shortcode
    tinymce.create('tinymce.plugins.create_pricing_button', {
        init : function(ed, url) {
            ed.addButton('create_pricing_button', {
                title : 'Pricing Shortcodes',
                image : url + '/../img/shortcode-admin1.png',
                onclick : function() {
                    //ed.selection.setContent('[create_custom_button]' + ed.selection.getContent() + '[/create_custom_button]');
                    ed.selection.setContent('[blockpricing title_blockpricing="Pricing Starts at $1500" title_url="Download more info" url="" target_url="_blank"]');
				}
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('create_pricing_button', tinymce.plugins.create_pricing_button);
})();