#!C:/Perl/bin/perl.exe
use CGI qw(:standard);

@date = localtime(time);
$date[4]++; $date[5] += 1900;
$currDate = "$date[4]/$date[3]/$date[5]";
$hour = "$date[2]";
$min = "$date[1]";
$currmin = "$date[1]";

if ($currmin < 10) {
    $currmin = "0$currmin";
}  else {
    $currmin = $min;
  }


if ($hour < 10) {
    $hour = "0$hour";
}

$TimeNow = "$hour:$currmin";

if ($min < 15) {
    $hour = $hour - 1;
    $min = $min - 15 + 60;
}

if ($min > 15) {
    $min = $min - 15;
}

if ($min < 10) {
    $min = "0$min";
}

$SLAhour = $hour;
$SLAmin = $min;
#$SLATime = "$hour:$min";

$database = "C:/Inetpub/wwwroot/Alert/DBase.htm";
$i= 1;

open(IN,$database) || die "Error: $!\n";
    my @arr = <IN>;
close (IN);


ticketsDue();

sub ticketsDue {

  while ($i <= $#arr) {
    $line= "@arr[$i]";
    ($STime,$ETime,$ticket,$Pri,$SiteID,$Comments,$DateAdded) = split(/\<TD>|/,$line);
    ($Ehour, $Emin) = split(/\:/,$ETime);
#    ($SLAhour, SLAmin) = split(/\:/,$SLATime);

 #   $ETime = trim($ETime);
    if ($Ehour >= $SLAhour && $Emin >= $SLAmin && $Ehour <= $hour && $Emin <= $currmin && $DateAdded == $currDate) {
  print $Ehour;
        #@currArray = ($ticket);
        #push(@newarr, @currArray);

    }
        $i= $i+1;
  }

}

    $newETime = trim($ETime);

#  print $Ehour;
  print $Emin;
  print $newETime;
#  print "@currArray \n";
  print @newarr;

sub trim($string)
{
	my $string = shift;
	$string =~ s/^\s+//;
	$string =~ s/\s+$//;
        #$string =~ s/ /_/g;
	return $string;
}
