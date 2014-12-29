<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<script type="text/javascript" src="jquery.form.js"></script> 
		<script src="http://jqueryui.com/ui/jquery.ui.core.js"></script>
  <link href="jquery-ui.button.css" rel="stylesheet" type="text/css"/>
 		<script type="text/javascript" src="thickbox.js"></script>
		<script>

$(document).ready(function(){
    $('.check:button').toggle(function(){
        $('input:checkbox.list').attr('checked','checked');
        $(this).val('uncheck all')
    },function(){
        $('input:checkbox.list').removeAttr('checked');
        $(this).val('check all');        
    });
});

</script>
<style type="text/css">
body{
	background: #eeeeee;
	font-family:"Segoe UI", Tahoma, Arial, Verdana, sans-serif;
	text-align: left;
	font: 14px/16px;
	overflow-x:hidden;
	overflow-y:hidden;
	behavior: url("csshover3.htc");
}



	#form {
	padding:5px;
	text-align: left;
	background:transparent;		/* #add8e6; */
	border: none;
	overflow: visible;
}


  		* html a:hover { background: transparent; }


.emails { 
	word-spacing:2px;
	letter-spacing:1px;
	background: transparent;
    border: none;
	display: marker; 
	font: 14px "Segoe UI";
	color: #000000;
	overflow:hidden;
} 

</style>
 
<script>
		$(document).ready(function() { 	
			   $("button").button();
			});
</script>			
 <script type="text/javascript">
    /* attach a submit handler to the form */
  $("#email").submit(function(event) {

    /* stop form from submitting normally */
    event.preventDefault(); 
        
    /* get some values from elements on the page: */
    var $form = $( this ),
        term = $form.find( 'input' ).val(),
        url = $form.attr( 'action' );

    /* Send the data using post */
    $.post( url, { s: term },

		function tb_removeIframe() {
		parent.$('#TB_window,#TB_overlay,#TB_HideSelect').trigger("unload").unbind().remove();
		}	);
		
});
</script> 
</head>
<body>

<table CELLPADDING=2 NOWRAP>
<TR><TH>
<font size="100%">E</font>mail Recipients
<br>
</TR></TH>
<br>
<TBODY> <TR> <TD>
<FORM METHOD="POST" id="email" NAME="Email" ACTION="/cgi-bin/EmailAddresses.cgi" >

<DIV class="emails">
    <INPUT TYPE="checkbox" class="list" NAME="Allen" VALUE="abaum@isi-info.com">Allen Baum<BR>
    <INPUT TYPE="checkbox" class="list" NAME="Andrew" VALUE="apark@isi-info.com">Andrew Park<BR>
    <INPUT TYPE="checkbox" class="list" NAME="Dan" VALUE="dschmitt@isi-info.com">Dan Schmitt<BR>
    <INPUT TYPE="checkbox" class="list" NAME="Dennis" VALUE="dgrondin@isi-info.com">Dennis Grondin<BR>
    <INPUT TYPE="checkbox" class="list" NAME="Dino" VALUE="dmanzella@isi-info.com">Dino Manzella<BR>
	<INPUT TYPE="hidden" class="list" NAME="Jim" VALUE="jmulhern@isi-info.com">
    <INPUT TYPE="checkbox" class="list" NAME="JimS" VALUE="jscholtens@isi-info.com">Jim Scholtens<BR>
    <INPUT TYPE="checkbox" class="list" NAME="Jon" VALUE="jdehlin@isi-info.com">Jon Dehlin<BR>
    <INPUT TYPE="checkbox" class="list" NAME="Matt" VALUE="mrsikes@isi-info.com">Matt Sikes<BR>
    <INPUT TYPE="checkbox" class="list" NAME="Mike" VALUE="mstratton@isi-info.com">Mike Stratton<BR>
    <INPUT TYPE="checkbox" class="list" NAME="Peter" VALUE="pmathewsian@isi-info.com">Peter Mathewsian<BR>
    <INPUT TYPE="checkbox" class="list" NAME="Ray" VALUE="rburquist@isi-info.com">Ray Burquist<BR>
	<INPUT TYPE="checkbox" class="list" NAME="Shannon" VALUE="ssmith@isi-info.com">Shannon Smith<BR>
    <INPUT TYPE="checkbox" class="list" NAME="Susan" VALUE="stylkowski@isi-info.com">Susan Tylkowski<BR>
    <INPUT TYPE="checkbox" class="list" NAME="Tom" VALUE="tgarza@isi-info.com">Tom Garza<BR>
    <INPUT TYPE="checkbox" class="list" NAME="Victor" VALUE="vvrba@isi-info.com">Victor Vrba<BR>
	<INPUT TYPE="checkbox" class="list" NAME="Yanitza" VALUE="ylopez@isi-info.com">Mary Wehmhoefer<BR>
</DIV>

<BR>
<Button TYPE="Submit" id="submit" class="negative3" NAME="Submit" VALUE="Let's make it happen!" ><img src="/icons/user_comment.png" alt=""/> Let's make it happen!</button>
<br/>
<input type='button' class='check' value='check all' />
</FORM>

<font face="Segoe UI" size=3 color="#1C4E63"><strong>Today's <a class="external" href="email.txt" Target="New">available techs!</a></strong></font>

	</TD>
		</TR>
		  </TABLE>
		</body>
 </html>
 
 
 
 
 
 
 
 