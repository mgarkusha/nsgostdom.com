/**
 * $Id: editor_plugin_src.js 126 2006-10-22 16:19:55Z spocke $
 *
 * @author Moxiecode
 * @copyright Copyright © 2004-2006, Moxiecode Systems AB, All rights reserved.
 */

/* Import plugin specific language pack */
tinyMCE.importPluginLanguagePack('module');

var TinyMCE_ModulePlugin = {
	getInfo : function() {
		return {
			longname : 'Module',
			author : 'R70',
			authorurl : 'http://r70.ru',
			infourl : 'http://r70.ru',
			version : '1.0'
		};
	},
	
	getControlHTML : function(cn) {
		switch (cn) {
			case "insertmodule":
				return tinyMCE.getButtonHTML(cn, 'lang_module_title', '{$pluginurl}/images/module.gif', 'mceInsertModule', true);
		}

		return "";
	},
		
	initInstance : function(inst) {
		tinyMCE.importCSS(inst.getDoc(), tinyMCE.baseURL + "/plugins/module/css/content.css");
	},

	execCommand : function(editor_id, element, command, user_interface, value) {
		// Handle commands
		switch (command) {
			case "mceInsertModule":
				var template = new Array();
				var inst = tinyMCE.getInstanceById(editor_id);
				var focusElm = inst.getFocusElement();

				template['file'] = '../../plugins/module/module.php'; // Relative to theme
				template['width'] = 400;
				template['height'] = 400;
		
				// Is selection a image
				var width=100;
				var height=40;
				var parametr='';
				var modulename='';

				if (focusElm != null && focusElm.nodeName.toLowerCase() == "img") {
					name = tinyMCE.getAttrib(focusElm, 'class');

					if (name.indexOf('mceItemModule') == -1) // Not a Flash
						return true;

					// Get rest of Flash items
					swffile = tinyMCE.getAttrib(focusElm, 'title');

					width = tinyMCE.getAttrib(focusElm, 'width');
					height = tinyMCE.getAttrib(focusElm, 'height');
					parametr = tinyMCE.getAttrib(focusElm, 'parametr');
					modulename = tinyMCE.getAttrib(focusElm, 'modulename');
				}

				tinyMCE.openWindow(template, {editor_id : editor_id, inline : "yes", width:width, height:height, parametr:parametr, modulename:modulename});

				return true;
		}
		//return false;
	},
	
	cleanup : function(type, content) {
		switch (type) {
			case "insert_to_editor":
				var startPos = 0;
				var embedList = new Array();

				// Fix the embed and object elements
				content = content.replace(new RegExp('<[ ]*emcms','gi'),'<emcms');
				content = content.replace(new RegExp('<[ ]*/emcms[ ]*>','gi'),'</emcms>');
				content = content.replace(new RegExp('<[ ]*objcms','gi'),'<objcms');
				content = content.replace(new RegExp('<[ ]*/objcms[ ]*>','gi'),'</objcms>');

				// Parse all embed tags
				while ((startPos = content.indexOf('<emcms', startPos+1)) != -1) {
					var endPos = content.indexOf('>', startPos);
					var attribs = TinyMCE_ModulePlugin._parseAttributes(content.substring(startPos + 6, endPos));
					embedList[embedList.length] = attribs;
				}

				// Parse all object tags and replace them with images from the embed data
				var index = 0;
				while ((startPos = content.indexOf('<objcms', startPos)) != -1) {
					if (index >= embedList.length)
						break;

					var attribs = embedList[index];

					// Find end of object
					endPos = content.indexOf('</objcms>', startPos);
					endPos += 9;

					// paramstr
					var prs='';
					prs += "width:'"+attribs["width"]+"',";
					if(attribs["parametr"]!='')	prs += "parametr:'"+attribs["parametr"]+"',";
					prs += "modulename:'"+attribs["modulename"]+"',";
					prs += "height:'"+attribs["height"]+"'";

					// Insert image
					var contentAfter = content.substring(endPos);
					content = content.substring(0, startPos);
					content += '<img width="' + attribs["width"] + '" height="' + attribs["height"] + '"';
					content += ' src="http://mirima10.r70.ru/htdocs/images/empty.gif"';
					content += ' title="' + prs + '" class="mceItemModule" />' + content.substring(endPos);
					content += contentAfter;
					//alert(content);
					index++;

					startPos++;
				}

				// Parse all embed tags and replace them with images from the embed data
				var index = 0;
				while ((startPos = content.indexOf('<emcms', startPos)) != -1) {
					if (index >= embedList.length)
						break;

					var attribs = embedList[index];

					// Find end of embed
					endPos = content.indexOf('>', startPos);
					endPos += 9;

					var prs='';
					prs += "width:'"+attribs["width"]+"',";
					if(attribs["parametr"]!='')	prs += "parametr:'"+attribs["parametr"]+"',";
					prs += "modulename:'"+attribs["modulename"]+"',";
					prs += "height:'"+attribs["height"]+"'";
					
					// Insert image
					var contentAfter = content.substring(endPos);
					content = content.substring(0, startPos);
					content += '<img width="' + attribs["width"] + '" height="' + attribs["height"] + '"';
					content += ' src="http://mirima10.r70.ru/htdocs/images/empty.gif" title="' + prs + '"';
					content += ' class="mceItemModule" />' + content.substring(endPos);
					content += contentAfter;
					index++;

					startPos++;
				}
				
				//alert(content);

			break;

			case "get_from_editor":
				// Parse all img tags and replace them with object+embed
				var startPos = -1;

				while ((startPos = content.indexOf('<img', startPos+1)) != -1) {
					var endPos = content.indexOf('/>', startPos);
					var attribs = TinyMCE_ModulePlugin._parseAttributes(content.substring(startPos + 4, endPos));

					// Is not flash, skip it
					
					if (attribs['class'] != "mceItemModule")
						continue;

					endPos += 2;
						
					at = attribs['title'];
					if (at) {
						at = at.replace(/&#39;/g, "'");
						at = at.replace(/&#quot;/g, '"');
						try {
							pl = eval('x={' + at + '};');
						} catch (ex) {
							pl = {};
						}
					}						

					var embedHTML = '';
					/*var wmode = tinyMCE.getParam("flash_wmode", "");
					var quality = tinyMCE.getParam("flash_quality", "high");
					var menu = tinyMCE.getParam("flash_menu", "false");*/

					// Insert object + embed
					embedHTML += '<objcms classid="R-Module"';
					embedHTML += ' width="' + pl.width + '" height="' + pl.height + '">';
					//embedHTML += '<param name="movie" value="' + attribs["title"] + '" />';
					//alert(p1.parametr);
					if(!pl.parametr) pl.parametr ='';
					embedHTML += '<emcms type="Module" width="' + pl.width + '" height="' + pl.height + '" parametr="'+pl.parametr+'" modulename="'+pl.modulename+'"></emcms></objcms>';

					// Insert embed/object chunk
					chunkBefore = content.substring(0, startPos);
					chunkAfter = content.substring(endPos);
					content = chunkBefore + embedHTML + chunkAfter;
				}
			break;
		}

		// Pass through to next handler in chain
		return content;
	},
	
	_parseAttributes : function(attribute_string) {
		var attributeName = "";
		var attributeValue = "";
		var withInName;
		var withInValue;
		var attributes = new Array();
		var whiteSpaceRegExp = new RegExp('^[ \n\r\t]+', 'g');

		if (attribute_string == null || attribute_string.length < 2)
			return null;

		withInName = withInValue = false;

		for (var i=0; i<attribute_string.length; i++) {
			var chr = attribute_string.charAt(i);

			if ((chr == '"' || chr == "'") && !withInValue)
				withInValue = true;
			else if ((chr == '"' || chr == "'") && withInValue) {
				withInValue = false;

				var pos = attributeName.lastIndexOf(' ');
				if (pos != -1)
					attributeName = attributeName.substring(pos+1);

				attributes[attributeName.toLowerCase()] = attributeValue.substring(1);

				attributeName = "";
				attributeValue = "";
			} else if (!whiteSpaceRegExp.test(chr) && !withInName && !withInValue)
				withInName = true;

			if (chr == '=' && withInName)
				withInName = false;

			if (withInName)
				attributeName += chr;

			if (withInValue)
				attributeValue += chr;
		}

		return attributes;
	}
	
};

tinyMCE.addPlugin("module", TinyMCE_ModulePlugin);
