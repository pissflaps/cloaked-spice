#!C:/Perl/bin/perl.exe
use CGI qw(:standard);
use Net::SMTP;

########################################
#Jorge A. Zepeda                       #
#Date: 09/27/09                        #
#ISI Telemanagement Solutions, INC.    #
########################################

$cgi = new CGI;

#print $cgi->header;


@date = localtime(time);
$date[4]++; $date[5] += 1900;
$currDate = "$date[4]/$date[3]/$date[5]";
$hour = "$date[2]";
$endhour = ($hour + 3);
$min = "$date[1]";

if ($min < 15) {
    $min = $min - 15 + 60;
}


if ($min > 15) {
    $min = $min - 15;
}

$TimeNow = "$hour:$min";

print $TimeNow;