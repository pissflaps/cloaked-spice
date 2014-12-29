<?php
error_reporting(E_ALL ^ E_NOTICE); 
    require_once( "session.php"); 
    require_once( "database.php"); 
	if(! isset($_SESSION["myusername"])) {
	  $Remote_IP = $_SERVER["REMOTE_ADDR"];
      $login = $_COOKIE["LoggedInAs"];
      $UserLink = '<li name="LogIn" class="active"><a href="TACLogout.php" title="Log out of TAC Alert" class="success button expand"><i class="fi-torsos"></i> '. ucwords($_COOKIE["LoggedInAs"]) .' </a></li>';
	  
        if(!isset($_COOKIE["LoggedInAs"]) ){
          $login = $_SERVER["REMOTE_ADDR"];
          $_COOKIE["LoggedInAs"] = $_SERVER["REMOTE_ADDR"];
          $UserLink = '<li name="LogIn" class="alert" title="Log in to TAC Alert" ><a href="#" title="Log in to TAC Alert" data-reveal-id="TacLogin" data-reveal class="alert button expand"><i class="fi-torsos"></i> '. $_SERVER["REMOTE_ADDR"] .'</a></li>';
        }
    }
        else{
          $login = $_SESSION["myusername"];
          $UserLink = '<li name="LogIn" class="active" title="Log out of TAC Alert"><a href="TACLogout.php" title="Log out of TAC Alert" class="success button expand"><i class="fi-torsos"></i> '. ucwords($_COOKIE["LoggedInAs"]) .' </a></li>';
		}
?>		