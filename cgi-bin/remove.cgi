#!C:/Perl/bin/perl.exe
use CGI qw(:standard);

########################################
#Jorge A. Zepeda                       #
#Date: 09/27/09                        #
#ISI Telemanagement Solutions, INC.    #
########################################

$filename= "C:/Inetpub/wwwroot/DBase.htm";

# open for reading
open(IN, "$filename") || die("Unable to open $filename: $!\n");

  my @data = <IN>;

  # $firstLine = <IN>;
  # $secondLine = <IN>;
  # @theRest = <IN>;
close(IN);

  #chomp($firstLine);
  #chomp($secondLine);

  delete $data[1];
  
open(OUT, ">$filename") || die "can't open the file $!\n";
foreach my $item (@data) {
   printf OUT "$item" if (defined $item);
}
close (OUT);


my $URL = "C:/Inetpub/wwwroot/index.html";

print "$URL\n";
