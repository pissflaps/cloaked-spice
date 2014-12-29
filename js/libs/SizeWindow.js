
/*
	Add this script file to the head or body section of the page needing window sizing by using the tag:
	<script type="text/javascript" src="SizeWindow.js"></script>
*/

var newWin;

function SizeWindow(dWidth, dHeight){
	// Center browser window on available screen and size it to desired.

	var h = screen.availHeight - dHeight;
	var w = screen.availWidth - dWidth;

	if (h<0) h=0;
	if (w<0) w=0;
	
	try{
		moveTo((w)/2, (h)/2);
	}catch (e){;}
	try{
		resizeTo(dWidth, dHeight);
	}catch (e){;}
}

function EditWindow(dWidth, dHeight, fHeight){
	// Place window to accomodate it's full height (fHeight) but size it
	// for the desired height (dHeight) only.  Used for editor framesets.

	var h = screen.availHeight - fHeight;	//calculate per full window height
	var w = screen.availWidth - dWidth;

	if (h<0) h=0;
	if (w<0) w=0;
	
	try{
		moveTo((w)/2, (h)/2);
	}catch (e){;}
	try{
		resizeTo(dWidth, dHeight);
	}catch (e){;}
}

function OpenChildWindow(URL){
	// Write editor request to new window.
	var h = (screen.availHeight - 50)/2;
	var w = (screen.availWidth - 50)/2;

	if (navigator.appName == "Netscape"){
		newWin  = window.open(URL,"cTree","WIDTH=50,HEIGHT=50,screenX="+w+",screenY="+h+",resizable");
	}else{
		newWin  = window.open(URL,"cTree","WIDTH=50,HEIGHT=50,left="+w+",top="+h+",resizable");
	}
}
			
function CloseChildWindow(){
	try{
		newWin.close();
	}catch (e){;}
}

function OpenHelpWindow(URL){
	// Called to display a help window.
	// Incident ID: 8957 - NAS 1/4/07
	var sHeight = screen.availHeight-50;
	var sWidth  = screen.availWidth-10;
	
	try{
	    if (navigator.appName == "Netscape"){
	        // Netscape fills the screen as desired when using fullscreen=yes.
	        newWin  = window.open("","Report",
		        "fullscreen=yes,resizable,status,scrollbars");
	    }else{
	        // Using fullscreen=yes in IE causes the titlebar to be hidden so
	        // we create the window and moveTo(0,0) to avoid this problem.
	        newWin  = window.open("","Help",
		        "width="+sWidth+",height="+sHeight+
		        ",top=0,left=0,resizable,status,scrollbars");
	    }
    }catch (e){
        alert(e + "\nOpening browser help window.");
        return;
    }

	if (newWin == null) {
		alert("Unable to create help browser window.");
	}else{
		// Assign opener property if none exists and
		// point to this window as the opener.
		if (!newWin.opener) newWin.opener = window;
	}

	// Set location to help file URL.
	try{
	    newWin.location = URL;
    }catch (e){
        alert(e + "\nAssigning help page " + URL + " to help window.");
    }
}