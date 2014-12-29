<div id="hotlinks">
	<!-- The Wiki search bar -->
<!-- Quick Links to other TAC Apps and ISI website links. -->

<span id="linkBlock">
<ul id="links1" style="float:left;clear:both;list-style:none;padding:0.5em;text-align:left;">
<h4><b>I'm looking to...</b></h4>
<li>  <a href="http://tac-alert01/CDRMS.php" target="_NEW" title="Navigate CDRMS Servers!">Navigate CDRMS</a></li> 
<li>  <a href="http://tac-alert01/tickedit.php" target="_NEW" title="Update tickets in Realtime!">Edit a Ticket</a></li> 
<li>  <a href="http://tac-alert01/tickadd.php" target="_NEW" title="Tac's Ticket Adder">Add a Ticket Back Into the Queue</a></li> 
<li>  <a href="http://tac-alert01/tbyc.php" target="_NEW" title="Ticket Creation Statistics">Find Statistics by Ticket Creator</a></li> 	
</ul>
<br><br>
<ul id="links2" style="float:right;clear:right;list-style:none;text-align:right;padding:0.5em;">
<h4><b>I want to search for...</b></h4>
<li><a href="http://tac-alert01/search.php" target="_NEW" title="Ticket Search">Tickets by Site</a></li> 
<!-- <li> <a href="http://tac-alert01/comsearch.php" target="_NEW" title="Ticket Search">Tickets by Comments</a></li> 
<li> <a href="http://tac-alert01/PRIsearch.php" target="_NEW" title="Ticket Search">Tickets by Priority</a></li> -->
<li><a href="http://tac-alert01/userstats.php" target="_NEW" title="User Statistics">User Statistics</a></li>  
</ul>
<span id="rotor" >
<!-- 
The Rotor.php page is simply a randomizer that picks an image URL and title, and inserts it into IMG tags to create a random banner.
The current rotation script uses artistic banners created in-house that show portions of famous paintings with "TAC's Alert System" written over them.
This can be changed in the future, or simply removed.
-->
<?php include( "rotor_tabs.php" ); ?>
</span>
<p style="clear:both; float:right; padding:0.25em;">
<img src="../icons/WebEx_icon.gif" /> <a href="http://isi-info.webex.com" class="external" title="Start a WebEx Support Session" target="_new">WebEx Support Center</a> &nbsp;&nbsp;
<img src="../icons/house.png" /> <a href="http://thesource.isi-info.com/service/default.aspx" class="external" title="The Source" target="_new">ISI: The Source</a> &nbsp;&nbsp;
<img src="../icons/isicon.gif" /> <a href="http://tac-wiki/wiki/index.php" title="The ISI Wikibase" class="external" target="_new">TAC:Wikibase</a>  &nbsp;&nbsp; 
<img src="../icons/comment.png" /> <a href="http://tac-wiki/wiki/index.php/Special:AWCforum/" title="The Wiki Forums" class="external" target="_NEW">Wiki Forums</a>
</p>
</span>
<script>
$(function() {
	$('#rotor img').addClass('round');
	$("button").button();
	});
</script>
</div> <!-- End #HotLinks -->
