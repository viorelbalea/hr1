<!--

function showInfo(url, div_id) {
    
    var xmlhttpRequestObj;
	
    if (xmlhttpRequestObj = create_xmlhttpRequestObj()) {
	xmlhttpRequestObj.onreadystatechange = processRequestChange;
	xmlhttpRequestObj.open("GET", url, true);
	xmlhttpRequestObj.send(null);
    } else {
	//alert('Nu pot crea xmlhttpRequestObj');
    }
	
    function processRequestChange() {
	if (xmlhttpRequestObj.readyState == 4) {
	    if (xmlhttpRequestObj.status == 200) {
		var string             = xmlhttpRequestObj.responseText;
		var responsecont       = document.createElement('div');
		responsecont.innerHTML = string;
		var mstrresponse       = responsecont.innerHTML;
		var homecont           = document.getElementById(div_id);
		homecont.innerHTML     = mstrresponse;
	    } else {
		//alert('Nu e ok');
	    }
	}
    }
	
    function create_xmlhttpRequestObj() {
	if (window.ActiveXObject) {
	    return new ActiveXObject("Microsoft.XMLHTTP");
	} else if (window.XMLHttpRequest) {
	    return new XMLHttpRequest();
	}
	return null;
    }
	
}

function updateInfo(url) {
    
    var xmlhttpRequestObj;
	
    if (xmlhttpRequestObj = create_xmlhttpRequestObj()) {
	xmlhttpRequestObj.open("GET", url, true);
	xmlhttpRequestObj.send(null);
    } else {
	//alert('Nu pot crea xmlhttpRequestObj');
    }
    
    function create_xmlhttpRequestObj() {
	if (window.ActiveXObject) {
	    return new ActiveXObject("Microsoft.XMLHTTP");
	} else if (window.XMLHttpRequest) {
	    return new XMLHttpRequest();
	}
	return null;
    }        
}

function is_empty(str) {
    return str.search('^[ \t\r\n]*$')>-1 ? true : false;
}

function is_uint(str) {
    if (is_empty(str)) {
	return false;
    }
    return str.search('^[.0-9]*$')>-1 ? true : false;
}

function validTextField(field, msg) {
    if (field == undefined)
	return true;
    if (is_empty(field.value)) {
        alert(msg);
        return false;
    }
    return true;
}

function is_email(str, msg) {
    if (str.search("^([a-zA-Z0-9_]|\\-|\\.)+@(([a-zA-Z0-9_]|\\-)+\\.)+[a-zA-Z]{2,4}\$") > -1) {
	return true;
    }
    if (msg != "") alert(msg);
    return false;
}

function check_cnp(cnp) {
    var txt = new Array()
    for (i=0;i<cnp.length;i++){
			txt[i]=cnp.substr(i,1);
    }
    if (txt.length==13){
			s = txt[0]*2+txt[1]*7+txt[2]*9+txt[3]*1+txt[4]*4+txt[5]*6+txt[6]*3+txt[7]*5+txt[8]*8+txt[9]*2+txt[10]*7+txt[11]*9;   
			rest = s%11;
      if ((rest < 10 && rest == txt[12]) || (rest == 10 && txt[12] == 1)){
      		//alert('CNP-ul '+ cnp +' este corect');
        	return true;
      } else{
         	alert('CNP-ul '+ cnp +' este INCORECT');
      }
    } else {
			alert('CNP-ul '+ cnp +' INCORECT < 13');
    }
    return false;
}

function getKeyUnicode(e){
	return e.keyCode? e.keyCode : e.charCode;
}

//--------------------------------------------------------------------------
//-------------------------------- custom popup ----------------------------
//--------------------------------------------------------------------------

function popUp(url,name,w,h) {
	var newPopUpLeft	=100;
	newPopUpLeft=Math.floor((screen.width-w)/2);
	var newPopUpTop		=100;
	newPopUpTop=Math.floor((screen.height-h)/2);
	var newPopUp		=window.open(url,name,'width='+w+',height='+h+',left='+newPopUpLeft+',top='+newPopUpTop+',menubar=no,location=no,resizable=1,status=no,scrollbars=1');
	if (window.focus) newPopUp.focus();
}
//-->
function autocomplete_products(input, suggestions){
   
    
jQuery(input).autocomplete({
      minLength: 0,
      source: jQuery.parseJSON(atob(suggestions)),
      focus: function( event, ui ) {
        jQuery( input ).val( ui.item.label );
        return false;
      },
      select: function( event, ui ) {
        jQuery( input ).val( ui.item.label );
        jQuery( "#ProductID_0" ).val( ui.item.value );
        jQuery( "#MaxDiscount_0" ).val( ui.item.maxdiscount );
		jQuery( "#Price_0" ).val(ui.item.price);
      
 
        return false;
      }
    })
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
      return jQuery( "<li>" )
        .append( "<img src=\"" + item.icon + "\" style= \" float:left; width:64px \"/><div style= \"position:relative; float:left;\">" 
		+ "<a style= \"vertical-align: middle; \">" + 
            "<span style= \"font-size: 15px; \">" + item.label + "</span><br />" + item.desc + "</a></div><div style= \"position:relative; float:right;\">Pret: " 
			+ item.price + "EUR</div><div style= \"clear:both\" />" )
        .appendTo( ul );
    };
  }