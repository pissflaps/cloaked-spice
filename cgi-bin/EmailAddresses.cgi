#!C:\xampp\perl\bin\perl.exe
use CGI qw(:standard);

########################################
#Jorge A. Zepeda                       #
#Date: 09/27/09                        #
#ISI Telemanagement Solutions, INC.    #
# 				  					   #
#Edited by: Jim Mulhern                #
#Date: 3/23/11 - 2/10/14   	      	   #
########################################

$p= new CGI;

$database="C:/xampp/htdocs/Email.txt";
$Allen= $p->param('Allen');
$Andrew= $p->param('Andrew');
$Dan= $p->param('Dan');
$Dennis= $p->param('Dennis');
$Dino= $p->param('Dino');
$JimS= $p->param('JimS');
$Jon= $p->param('Jon');
$Matt= $p->param('Matt');
$Mike= $p->param('Mike');
$Peter= $p->param('Peter');
$Ray= $p->param('Ray');
$Sonia = $p->param('Sonia');
$Susan= $p->param('Susan');
$Tom= $p->param('Tom');
$Tom= $p->param('Terry');
$Victor= $p->param('Victor');
$Jim = $p->param('Jim');



$record=join ',',param(Andrew),param(Allen),param(Dino),
param(Dan),param(Dennis),param(JimS),param(Jon),param(Matt),param(Sonia),
param(Mike),param(Peter),param(Ray),param(Victor),param(Tom),param(Terry),
param(Susan),param(Jim);

&AddRecord($database,$record);

sub AddRecord {
  $database=$_[0];
  $record=$_[1];

  open (DB,">$database") || die("Could not open file!");
  print DB "$record\n";

  close(DB);
  
 
	print redirect('../complete.html');
	## return();

 }
  