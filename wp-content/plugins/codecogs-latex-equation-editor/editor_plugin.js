
var popupEqnwin = null; 
(function() {
	
	tinymce.create('tinymce.plugins.equation', {
		init: function(ed, url) {
			ed.addCommand('equationCommand', function(a, latex)	{
																					
	  		//open a popup window when the button is clicked
				if (popupEqnwin==null || popupEqnwin.closed || !popupEqnwin.location) 
				{
					var url='http://latex.codecogs.com/editor_json3.php?type=url&editor=TinyMCE';
			
					//if(language!='') url+='&lang='+language;
					if(latex!==undefined) 
					{	
						latex=unescape(latex);
						latex=latex.replace(/\+/g,'&plus;');
						url+='&latex='+escape(latex);
					}
					
					popupEqnwin=window.open('','LaTexEditor','width=700,height=450,status=1,scrollbars=yes,resizable=1');
					if (!popupEqnwin.opener) popupEqnwin.opener = self;
					popupEqnwin.document.open();
					popupEqnwin.document.write('<!DOCTYPE html><head><script src="'+url+'" type="text/javascript"></script></head><body></body></html>');
					popupEqnwin.document.close();
				}
				else if (window.focus) 
				{ 
					popupEqnwin.focus()
					if(latex!==undefined)
					{
						latex=unescape(latex);
						latex = latex.replace(/\\/g,'\\\\');
						latex = latex.replace(/\'/g,'\\\'');
						latex = latex.replace(/\"/g,'\\"');
						latex = latex.replace(/\0/g,'\\0');

						eval("var old = popupEqnwin.document.getElementById('JSONload')");
						if (old != null) {
							old.parentNode.removeChild(old);
							delete old;
						}
						
						var head = popupEqnwin.document.getElementsByTagName("head")[0];
						var script = document.createElement("script"); 
						script.type = "text/javascript";  
						script.id = 'JSONload';
						script.innerHTML = 'EqEditor.load(\''+(latex)+'\');';
						head.appendChild(script);
					
          }
				}
																																									

			});
					
		  ed.addButton('equation', {
				title: 'CodeCogs equation Editor',
				image: url + '/img/equation.gif',
				cmd: 'equationCommand' });
			
			ed.onDblClick.add(function(ed, e) {
				if (e.target.nodeName.toLowerCase() == "img") {
					var sName = e.target.src.match( /http:\/\/(latex.codecogs.com)\/(gif|svg)\.latex\?(.*)/ );
				
	      	if(sName[1]=='latex.codecogs.com')
		        tinymce.execCommand('equationCommand', false, sName[3]);
				}
			});
			
	  }, 
	
	  createControl : function(n, cm) { return null; } 
  });

  tinymce.PluginManager.add('equation', tinymce.plugins.equation);
})();


// Add a new placeholder at the actual selection.
TinyMCE_Add = function( name )
{
	var sName = name.match( /(gif|svg)\.latex\?(.*)/ );
	var latex= unescape(sName[2]);
	latex = latex.replace(/@plus;/g,'+');
	latex = latex.replace(/&plus;/g,'+');
	latex = latex.replace(/&space;/g,' ');
	
	tinyMCE.activeEditor.execCommand('mceInsertContent', false, '<img src="'+name+'" alt="'+latex+'" align="absmiddle" />');
	tinyMCE.execCommand('mceFocus', false, tinymce.activeEditor.editorId);
}