function add_js(texto)
	{var ini = 0;
	 while (ini!=-1)
		{ini = texto.indexOf('<script', ini);
		 if (ini >=0)
			{ini = texto.indexOf('>', ini) + 1;
			 var fim = texto.indexOf('</script>', ini);
			 eval(texto.substring(ini,fim)); }}}

function geraxmlhttp()
		  {try {/*firefox, opera 8+, safari, IE7*/ xmlhttp = new XMLHttpRequest();}
		   catch(erro1){try {xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");}
						catch(erro2){try {/*IE7-*/ xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");}
									 catch(errofinal) {xmlhttp = false; alert('Baixe a nova versão do seu navegador para utilizar corretamente este site.');}}}
			return(xmlhttp);};	
		   
function ajax(url,iddoelemento,hash='')
		  {window.history.replaceState(null, document.title, (hash?("?pg="+hash):"?"));
		   if (document.body.style.cursor!='wait')
			  {document.body.style.cursor='wait';
			   objxmlhttp = geraxmlhttp();
			   objxmlhttp.open("GET",url,true); 
			   objxmlhttp.onreadystatechange=function() 
				  {if (objxmlhttp.readyState==4)
						 {document.getElementById(iddoelemento).innerHTML=objxmlhttp.responseText; 
						  add_js(objxmlhttp.responseText);
						  document.body.style.cursor='default';}}
			   objxmlhttp.send(null);}
		   else {setTimeout("ajax('"+url+"','"+iddoelemento+"');",500);}	   
		   };	
		   
function form_ajax(url, iddoelemento, iddoform,hash='')
		  {window.history.replaceState(null, document.title, (hash?("?pg="+hash):""));
		   formulario=document.getElementById(iddoform);
		   document.body.style.cursor='wait';
		   objxmlhttp = geraxmlhttp();
		   objxmlhttp.open("POST",url,true);
		   objxmlhttp.onreadystatechange=function() 
			  {if (objxmlhttp.readyState==4)
					 {document.getElementById(iddoelemento).innerHTML=objxmlhttp.responseText;
					  add_js(objxmlhttp.responseText);
					  document.body.style.cursor='default';}}
		   objxmlhttp.open(formulario.method, url, true);
		   objxmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
		   objxmlhttp.send(new FormData(formulario));
		   };	

function add_lines(that)
		{qtd_inputs=that.parentElement.children.length;
		 var input = document.createElement('input');
		 input.type = 'text';
		 input.required = false;
		 input.name = 'telefone' + qtd_inputs;
		 input.addEventListener('blur', function() {if (input.value.trim() === '') {input.parentElement.removeChild(input);}});
		 that.parentElement.insertBefore(input, that);
		 setTimeout(function() {input.focus();}, 0);}
		 
function toggleSenhaVisibility(that)
		{var senhaInput = that.previousElementSibling;
		 senhaInput.type=(senhaInput.type === "password")?"text":"password";}
		   