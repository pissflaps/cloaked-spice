<?php
  function convertFromBytes($bytes)
	{
		$bytes /= 1024;
		if ($bytes > 1024) {
			return number_format($bytes/1024, 1) . ' MB';
		} else {
			return number_format($bytes, 1) . ' KB';
		}
	}
?>
<!DOCTYPE html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">  
<link rel="icon" href="http://tac-alert01/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="Foundation/js/vendor/modernizr.js"></script>
  <!-- // LOAD MODERNIZR FIRST for legacy browser interaction -->
<script type="text/javascript" src="jQuery/jquery-2.0.0.js"></script>  
    <title>Attachments in TAC Alert</title>
  <!-- // Style sheets loaded in succession for structure elements and button layout configuration --> 
  <link rel="stylesheet" type="text/css" href="css/production.css" class="theme">
  <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
  <style>
html, body{
font-family: 'Source Sans Pro', Arial, sans-serif;
font-size: 12pt;
	    min-height: 100%;
	    margin-bottom: 150px; 
}
  
ul>li {
display: inline;
list-style: none;
list-style-type: none;
}

#footer {
position: fixed;
top: 0px;
right: 0px;
}

#Header{
font-family: 'Arial Black', Charcoal, sans-serif;
font-size: 50pt;
font-weight: heavy;
text-decoration: bold;
color: #2c3e50;
}
.filesize, .filetime{
font-family: 'Lucida Console', monospace;
}
.linkText{
font-family: 'Source Sans Pro', Arial, sans-serif;
font-size: 14pt;
font-weight: 400;
}
#warning{
font-family: 'Arial Black', sans-serif;
font-weight: bold;
font-size: 18pt;
color: #ffffff;
}

.sticky {  
    position: fixed;  
    width: 100%;  
    top: 0;  
    z-index: 100;  
    border-top: 0;  
}
</style>
</head>
<body>


 <div class='icon-bar three-up'>
  <a href='Attach.php' class="item" target='_NEW'>
    <i class="fi-upload-cloud"></i> 
    <label>Attach a New File.</label> 
  </a>
  <a href='iGallery.php' class="item" target='_NEW'>
    <i class="fi-thumbnails"></i>
    <label>Check out the Image Gallery!</label> 
  </a>
  <a href='http://tac-alert01/' class="item" target='_NEW'>
    <i class="fi-social-windows"></i> 
	<label>Return to TAC Alert system.</label> 
  </a>
 </div>

<BR>

<div id="DeleteModal" class="small reveal-modal " data-reveal>
  <h1>Confirm delete:</h1>
  <p id="lead" class="text-center panel radius"></p>
    
  <a class="close-reveal-modal">&#215;</a>
</div>


  <div class="text-center">  
    <b id="Header"><u>TAC Uploads:</u></b>
    <h5 class="subheader">Click the hyperlink to download the attachment.</h5>
  </div>



<div class="large-offset-1 large-10">
<?php
  $myDirectory =  __DIR__ . '\tmp\*';

foreach( glob($myDirectory, GLOB_MARK) as $entryName) {
	$dirArray[] = $entryName;
}

  $indexCount	= count($dirArray);

  
  sort($dirArray);
  
Print("<TABLE id='attachments' border=1 cellpadding=2 cellspacing=2 class='text-center large-10 columns' role='grid'>\n");
Print("<THEAD id='nav'><TR><TH>Filename</TH><th>Filesize</th><th>Last_Modified</th><th>Remove File?</th></TR></THEAD>\n");
Print ("<TBODY>\n");

    for($index=0; $index < $indexCount; $index++) {
      $path = "http://tac-alert01/tmp/";
      $rel = substr_replace("$dirArray[$index]",$path,0, 20);
      $fileName = substr_replace("$dirArray[$index]",'',0, 20);
	  $rel = $path . urlencode($fileName);
	  $filePath = htmlspecialchars( $rel, ENT_QUOTES );
      $fileSize = convertFromBytes(filesize($dirArray[$index]) );
	  $filetime = filemtime($dirArray[$index]);
	   $last_mod = date ("m/d/Y H:i:s", $filetime);

        if (substr("$dirArray[$index]", 0, 1) != "."){ // don't list hidden files
	        print("<TR><TD class='linkText'><a href='$filePath' TARGET='_blank'>$fileName</a></td>");
//            print("<td class='filename'>");
//		    print(filetype($dirArray[$index]));
//		    print("</td>");
	    	print("<td class='filesize'>");
	    	print($fileSize);
	    	print("</td>");	    	
			print("<td class='filetime'>");
	    	print($last_mod);
	    	print("</td>");
	    	print("<td><a data-tooltip aria-haspopup='true' class='has-tip tip-left DELETEME tiny button alert expand' ID='".$fileName."' href='#' data-reveal-id='DeleteModal' title='Delete ". $fileName ."?'> Delete</a> </td>");
	    	print("</TR>\n");
	    }
    }
print("</TBODY></TABLE>\n");
print ("<h2 class='right'> $indexCount total attachments available.</h2> \n");
?>
  </div>


<!-- // Per the FOUNDATION docs, load all external libraries near the end of BODY in the DOM -->
<script type="text/javascript" src="Foundation/js/foundation.min.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.js"></script>
  <!-- // Foundation.min contains all modules in the event of expansion being needed into other library functions -->
<script type="text/javascript" src="Foundation/Tables/responsive-tables.js"></script>
  <!-- // Responsive Tables Plug-in provided by Foundation Framework // -->
  <!-- // jQuery and Foundation frameworks apply before DOM load -->
<script type="text/javascript" src="jQuery/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
<script type="text/javascript">
$(document).foundation();

function deleteFile(id){
    $.ajax({
        type: "POST",
        url: 'deletefile.php',
		data: 'fileid=' +id,
        success: function() {
            $('#lead').html('<h3>'+ id +' was deleted successfully.<BR> Click OK to reload the page.</h3> <br> <button class="large button success expand" id="RELOAD">OK</button>');
			    $('#RELOAD').on('click',function(){
				  window.location.reload();
				});
        },
		error: function(){
		    $('#lead').html('<h2>Sorry, something did not work correctly here.</h2> <br> <button class="large button alert expand" id="CLOSEOUT">OK</button>');
			$('#CLOSEOUT').on('click',function(){
				  window.location.reload();
				});
		},
    });	
}

$(document).ready(function() {
  
    $('.DELETEME').on('click',function(){
	    $ID = $(this).attr('id');
		console.log($ID);
		$buttonHTML = '<button class="medium button primary" id="REMOVE">Do it! </button> || <button class="medium button secondary" id="CANCEL">CANCEL </button>';
		$('#lead').html("<span id='warning' class='alert-box alert radius text-center'><i class='fi-alert'></i> Warning! This cannot be un-done.</span> <h4 class='subheader'>Delete <a href='http://tac-alert01/tmp/"+$ID+"' target='_NEW'> " +$ID+ "</a> from the Alert System?</h4>"
        +"<BR>"+$buttonHTML );
		    $("#REMOVE").on('click',function() {
			$('#lead').fadeOut(800, function() {
			    $(this).html("<img src='img/Spinner.gif' alt='Loading...' /><br><h1>Loading...</h1>");
				}).fadeIn(800, function (){
			          deleteFile($ID);
				    });
			});  $("#CANCEL").on('click',function(){
			      window.location.reload();
			    });
    });

  $('#attachments').dataTable({
    "lengthChange" : false,
	"pageLength": 20,
	"order": [ 2, 'desc' ],
	"dom" : 'firtp'
	});	

var stickyNavTop = $('#nav').offset().top;  
  
var stickyNav = function(){  
var scrollTop = $(window).scrollTop();  
       
if (scrollTop > stickyNavTop) {   
    $('#nav').addClass('sticky');  
} else {  
    $('#nav').removeClass('sticky');   
}  
};  
  
stickyNav();  
  
$(window).scroll(function() {  
    stickyNav();  
});  	
});
</script>

</body>
</html>