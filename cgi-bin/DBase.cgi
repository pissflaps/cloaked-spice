#!C:/Perl/bin/perl.exe
use CGI qw(:standard);

########################################
#Jorge A. Zepeda                       #
#Date: 09/27/09                        #
#ISI Telemanagement Solutions, INC.    #
########################################

# Set up a variable that keeps track of the time
# that the database was accessed.

$p= new CGI;

@date = localtime(time);
$date[4]++; $date[5] += 1900;
$mon = "$date[3]";

if ($mon < 10) {
    $mon = "0$mon";
}

$currDate = "$date[4]/$mon/$date[5]";
$hour = "$date[2]";
$endhour = ($hour + 3);
$min = "$date[1]";
if ($min < 10) {
    $min = "0$min";
}

if ($hour < 10) {
    $hour = "0$hour";
}

$StartTime = "$hour:$min";
$EndTime = "$endhour:$min";

$database="C:/xampp/htdocs/DBase.txt";
$ticket= $p->param('ticket');
$priority= $p->param('priority');
$siteID= $p->param('siteName');
$comments= $p->param('comments');

$record= join '   |   ',param(ticket),$currDate,$StartTime,$EndTime,param(priority),param(siteName),param(comments);

&AddRecord($database,$record);

sub AddRecord {
  $database=$_[0];
  $record=$_[1];

  open (DB,">>$database") or die "Error: $!\n";
  print DB "$record\n";

  close(DB);
	sleep (1);
 print redirect('../main.html');
	
 return;
}