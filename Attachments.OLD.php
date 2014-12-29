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
  <style>
html, body{
font-family: 'Source Sans Pro', Arial, sans-serif;
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


  <div class="text-center">  
    <b id="Header"><u>TAC Uploads:</u></b>
    <h4 class="subheader">Click the hyperlink to download the attachment.</h4>
  </div>


<div class="row">
  <div class="small-12 large-12">
<?php
  $myDirectory =  __DIR__ . '\tmp\*';

foreach( glob($myDirectory, GLOB_MARK) as $entryName) {
	$dirArray[] = $entryName;
}

  $indexCount	= count($dirArray);

Print ("<h4> $indexCount files</h4> \n");

  sort($dirArray);

Print("<TABLE border=1 cellpadding=5 cellspacing=2 class='centered text-center large-11' role='grid'>\n");
Print("<THEAD><TR><TH>Filename</TH><th>Filetype</th><th>Filesize</th><th>Last_Modified</th><th>Remove File?</th></TR></THEAD>\n");
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
	        print("<TR><TD><h6><a href='$filePath' TARGET='_blank'>$fileName</a></h6></td>");
            print("<td class='filename'>");
		    print(filetype($dirArray[$index]));
		    print("</td>");
	    	print("<td class='filesize'>");
	    	print($fileSize);
	    	print("</td>");	    	
			print("<td class='filetime'>");
	    	print($last_mod);
	    	print("</td>");
	    	print("<td><a class='DELETEME tiny button alert expand' ID='".$fileName."' href='#' data-reveal-id='DeleteModal' title='Delete ". $fileName ."?'> Delete</a> </td>");
	    	print("</TR>\n");
	    }
    }
print("</TBODY></TABLE>\n");
?>
  </div>
</div>

<br>  

<div id="DeleteModal" class="tiny reveal-modal " data-reveal>
  <h1>Please confirm:</h1>
  <p id="lead" class="panel callout radius text-center"></p>
  
  <a class="close-reveal-modal">&#215;</a>
</div>


<!-- // Per the FOUNDATION docs, load all external libraries near the end of BODY in the DOM -->
<script type="text/javascript" src="Foundation/js/foundation.min.js"></script>
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
		beforeSend: function(){
		  $('#lead').fadeout(800).html("<img src='img/Spinner.gif' alt='Loading...' /><br><h1>Loading...</h1>").fadeIn(600);
		},
        success: function() {
            $('#lead').html('<h2>'+ id +' was deleted successfully. Click OK to reload the page.</h2> <br> <button class="medium button success" id="RELOAD">OK</button>');
			    $('#RELOAD').on('click',function(){
				  window.location.reload();
				});
        },
		error: function(){
		    $('#lead').html('<h2>Sorry, something did not work correctly here.</h2> <br> <button class="medium button alert" id="CLOSEOUT">OK</button>');
			$('#CLOSEOUT').on('click',function(){
				  window.location.reload();
				});
		},
    });	
}

$(document).ready(function() {	
    $('.DELETEME').on('click',function(){
	    $ID = $(this).attr('id');
		$buttonHTML = '<button class="tiny button primary" id="REMOVE">Do it!</button> <button class="tiny button alert" id="CANCEL">CANCEL</button>';
		$('#lead').html("<h3 class='subheader'>Delete <a href='http://tac-alert01/tmp/"+$ID+"' target='_NEW'> " +$ID+ "</a>?</h3> <BR>" +$buttonHTML);
		    $("#REMOVE").on('click',function() {
			    deleteFile($ID);
			});  $("#CANCEL").on('click',function(){
			      window.location.reload();
			    });
    });


});
</script>

</body>
</html>