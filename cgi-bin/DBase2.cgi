#!C:\Perl\bin\perl.exe -w
use CGI qw(:standard);
use CGI::carp(PrintFatalsToBroswer);
use warnings;
use strict;

########################################
#Jim Mulhern			       #
#Date: 03/01/11                        #
#ISI Telemanagement Solutions, INC.    #
########################################
	
# Set up a variable that keeps track of the time
# that the database was accessed.

my $p= new CGI;

my @date = localtime(time);
$date[4]++; $date[5] += 1900;
my $mon = "$date[3]";

if ($mon < 10) {
    $mon = "0$mon";
}

my $currDate = "$date[4]/$mon/$date[5]";
my $hour = "$date[2]";
my $endhour = ($hour + 3);
my $min = "$date[1]";
if ($min < 10) {
    $min = "0$min";
}

if ($hour < 10) {
    $hour = "0$hour";
}

my $StartTime = "$hour:$min";
my $EndTime = "$endhour:$min";

my $database="C:/Inetpub/wwwroot/DBase.htm";
my $ticket= $p->param('ticket');
my $priority= $p->param('priority');
my $siteID= $p->param('siteName');
my $comments= $p->param('comments');

my $record= join ' |  </TD><TD>', $ticket,$currDate,$StartTime,$EndTime,$priority,$siteID,$comments,' </TD></TR> <TR><TD> ';
 
&AddRecord($database,$record);
	sub AddRecord {
	  $database=$_[0];
	  $record=$_[1];
 
 open (DB,">>$database") or die "Error: $!\n";
	print DB "$record\n";
	chomp;
  close(DB);

 print redirect('http://tac-alert01/alert.html');
	sleep (1);
 return();
}


####	http://www.computing.net/answers/programming/perl-convert-csv-file-to-html-file/15051.html






















