$(document).ready(go );

function go()
{		
	$(".top-level.section").html('<form id="password-form"><input id="password-box" maxlength="30" type="password" /></form><p id="faq" class="fadey-bits"><a href="#" id="policy" class="open-wide">Password Policy Requirements</a> &middot; <a href="http://www.microsoft.com/protect/fraud/passwords/create.aspx" Target="New">Tips on choosing A Secure Password</a></p><div id="open"></div>');
	$("#open").hide();
	$("#password-box").focus();
	$("form#password-form").after('<div class="password-strength"></div>');
	$("#password-box").keydown(function(e)
	{
		if (e.keyCode == 13 || e.charCode == 13)
		{
			return false;
		}
	});
	$("#password-box").keyup(function(e){passwordCheck(this, e);});
	$("#password-box").click(function(){$("#open").slideUp();$("a.open-wide").removeClass('current-clicked');});
	
	$(".open-wide").click(function(){clicky(this);return false;});

}

function clicky(that)
{
	var string = '';
	
	$("a.open-wide").removeClass('current-clicked');
	$(that).addClass('current-clicked');
	
	switch($(that).attr('id'))
	{
		case 'policy':
		{
			string = '<p>ISI requires that: <ul><li>All passwords be changed at least once every 6 months, or immediately if a breach of a password is suspected</li><li>Passwords not be inserted into email messages or other forms of electronic communication</li><li>Personal Computers and other portable devices such as Laptops and PDAs which may contain sensitive information must be password protected, and when possible, encrypt the sensitive information</li><li>Default vendor passwords be changed immediately upon installation of hardware or software</li></ul><p>Users must select strong passwords which must be at least 8 characters long and contain at least three of the following four character groups:<br><ul><li> English uppercase characters (A through Z)</li><li> English lowercase characters (a through z)</li><li> Numerals (0 through 9)</li><li> Non-alphabetic characters (!, $, #, %, etc.)</ul> <a class="more" href="http://thesource.isi-info.com/Security_Policies/117%20Password%20Management/117%20-%20Password%20Management.pdf">(more)</a></p>';
			break;
		}
	
	}
	$('div#open').html(string).slideDown();
}

function passwordCheck(that, e)
{
	if (e.keyCode == 27 || e.charCode == 27)
	{
		$(that).val("");
	}
	
	var password = $(that).val();
	
	if (password != "")
	{		
		$(".fadey-bits").hide();
		
		var strength = $.chronoStrength(password);
		
		if (strength == 'One of the 500 most common passwords')
		{
			$("div.password-strength").html('<p class="top-message">Your password is</p><p class="password-strength">' + strength + '</p><p class="bottom-message">It would be cracked almost instantly</p>').fadeIn(500);
		}
		else
		{
			$("div.password-strength").html('<p class="top-message">It would take ' + strength + ' for a desktop PC to crack your password</p>').fadeIn(500);
		}
	}
	else
	{
		$("div.password-strength").hide();
		$(".fadey-bits").fadeIn(500);
	}
}