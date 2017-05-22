function init()
{
	tinyMCEPopup.resizeToInnerSize ();
	
	var formObj	= document.forms [0];
	var inst	= tinyMCE.getInstanceById (tinyMCE.getWindowArg ('editor_id'));
	var elm		= tinyMCE.getInstanceById (tinyMCE.getWindowArg ('editor_id')).getFocusElement();
	
	var at		= tinyMCE.getAttrib (elm, 'title');
	if (at)
	{
		at = at.replace (/&#39;/g, "'");
		at = at.replace (/&#quot;/g, '"');

		eval ('params = {' + at + '};');
		
		
		if(params.parametr) formObj.parametr.value		= params.parametr;
		formObj.modulename.value	= params.modulename;
	}
	else
	{
		formObj.parametr.value		= '';
		formObj.modulename.value	= '';
	}
	
	formObj.width.value  = tinyMCE.getWindowArg('width');
	formObj.height.value   = tinyMCE.getWindowArg('height');
}

function insertModule ()
{
	var formObj		= document.forms[0];
	
	var width		= formObj.width.value;
	var height		= formObj.height.value;
	var parametr	= formObj.parametr.value;
	var modulename	= formObj.modulename.value;
	
	h = '<img src="http://mirima10.r70.ru/htdocs/images/empty.gif" class="mceItemModule" title="';
	if(width!='' && width!=0) h+= 'width:\''+width;
	if(height!='' && height!=0) h+='\',height:\''+height;
	if(parametr!='' && parametr!=0) h+='\',parametr:\''+parametr;
	if(modulename!='' && modulename!=0) h+='\',modulename:\''+modulename+'\'" ';
	if(width!='' && width!=0) h+=' width="'+width+'" ';
	if(height!='' && height!=0) h+=' height="'+height+'" ';
	h+= ' />';
	tinyMCE.selectedInstance.execCommand('mceInsertContent', false, h);
	tinyMCEPopup.close();
}