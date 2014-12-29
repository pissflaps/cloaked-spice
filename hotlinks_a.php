
<div id="hotlinks">
	<!-- The Wiki search bar -->
<span align="left">
<form action='http://tac-wiki/wiki/index.php/Special:SphinxSearch' method='GET' TARGET="_new">
			&nbsp;<input type='hidden' name='title' value='Special:SphinxSearch'>
				<input type="search" id="search" name='sphinxsearch' maxlength='100' TABINDEX="4" placeholder="Search the Wiki" onfocus="if(this.value==this.defaultValue) this.value='';" onblur="if(this.value=='') this.value=this.defaultValue;" style="padding:2px;">
				&nbsp; <button type='submit' name='fulltext' value='Search' ><img src="/icons/magnifier.png" border="0" alt=""/> Search</button>
						</form>
</span>				
<!-- Quick Links to other TAC Apps and ISI website links. -->

<span align="left" id="tab2" >
<ul name="links1" style="float:left;clear:right;list-style-type:none;">
<h4><b>I'm looking to...</b></h4>
<li>&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://tac-alert01/tickedit.php" target="_NEW" title="Update tickets in Realtime!">Edit a Ticket</a></li> 
<li>&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://tac-alert01/tickadd.php" target="_NEW" title="Tacs Ticket Adder">Add a Ticket Back Into the Open Queue</a></li> 
<li>&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://tac-alert01/tickstats.php" target="_NEW" title="Generate Ticket Statistics">Look Up Statistics by Date</a></li> 
</ul>
<br><br>
<ul style="float:left;clear:both;list-style-type:none;padding:5px;">
<h4><b>I want to search for...</b></h4>
<li>&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://tac-alert01/search.php" target="_NEW" title="Ticket Search">Tickets by Site</a></li> 
<li>&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://tac-alert01/comsearch.php" target="_NEW" title="Ticket Search">Tickets by Comments</a></li> 
<li>&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://tac-alert01/PRIsearch.php" target="_NEW" title="Ticket Search">Tickets by Priority</a></li> 
<li>&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://tac-alert01/userstats.php" target="_NEW" title="User Statistics">User Statistics</a></li>  
</ul>
<p style="clear:both; float:left; padding-top:5px;">
<img src="../icons/chart_organisation.png" /> <a href="http://thesource.isi-info.com/service/default.aspx" class="external" title="The Source" target="_new">ISI: The Source</a> &nbsp;&nbsp;
<img src="../icons/isicon.gif" /> <a href="http://tac-wiki/wiki/index.php" title="The ISI Wikibase" class="external" target="_new">TAC: Wikibase</a> 
</p>
</span>


<span id="rotor" style='float:right;'>
<!-- 
The Rotor.php page is simply a randomizer that picks an image URL and title, and inserts it into IMG tags to create a random banner.
The current rotation script uses artistic banners created in-house that show portions of famous paintings with "TAC's Alert System" written over them.
This can be changed in the future, or simply removed.
-->
<?php include( "rotor.php" ); ?>
</span>
<script>
$(document).ready(function() {
		$(function() {
			$("button").button();
		});
			$('img').addClass('round');
				$('#hotlinks h4 b').css({'border-bottom': '1px dashed #bbbbbb'});
});
</script>

</div> <!-- End #HotLinks -->