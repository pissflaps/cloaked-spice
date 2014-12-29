#!C:/Perl/bin/perl.exe
use CGI qw(:standard);
use CGI::Carp qw(fatalsToBrowser);
use Net::SMTP;
use Data::Dumper::Simple;
no warnings;
use diagnostics;
	
########################################
#Jorge A. Zepeda                       #
#Date: 09/27/09                        #
#ISI Telemanagement Solutions, INC.    #
########################################
#Edited by Jim Mulhern	               #
# 03/14/11                             #
#ISI Telemanagement Solutions, INC.    #
########################################
	my @date = localtime(time);
$date[4]++; $date[5] += 1900;
	my $currDate = "$date[4]/$date[3]/$date[5]";
	my $hour = "$date[2]";
	my $min = "$date[1]";
	my $currmin = "$date[1]";

if ($currmin < 10) {
    $currmin = "0$currmin";
} 
else {
    $currmin = $min;
}

if ($hour < 10) {
    $hour = "0$hour";
}

	my $TimeNow = "$hour:$currmin";

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

	my $SLAhour = $hour;
	my $SLAmin = $min;
				
open(IN,"C:/Inetpub/wwwroot/Email.txt") || die "Error: $!\n";

    my @addresses= <IN>;

close (IN);
 
	my $email= "@addresses";
		
open(DB, '<', "C:/Inetpub/wwwroot/DBase.htm") || die "Error: $!\n";
			
	while ($line = <DB>) {
	chomp ($line);
	push @stack, $line; 
	}
	splice (@stack, 0, 14); 	#removes the opening HTML markup
	
		foreach $line(@stack){
				 $line =~ s/\|//g;
				 $line =~ s/<\/TD><\/TR><TR><TD>/\n/g;
				 $line =~ s/<\/TD><TD>/\|/g;
				 $line =~ s/\s//g;
				 $line =~ s/<\/TD><\/TR>//g;
				 $line =~ s/<TR><TD>//g;
				 chomp($line);
		 }
	
	my (@lines,$ticket,$DateAdded,$STime,$ETime,$Pri,$SiteName,$Comments);

	foreach $line (@stack) { 
		@items = split /\n/, $line; 
			foreach $item (@items) { 
	($ticket,$DateAdded,$STime,$ETime,$Pri,$SiteName,$Comments)
						= split(/(\|)/,$item);	
			} 
		
		push @lines, $line;
		}
						
close (DB);
	my(@tickets, @dates, @stimes, @etimes, @priors, @sites, @comms);
				
					$i=0;
						for $i(0 .. $#lines){
						($ticket,$DateAdded,$STime,$ETime,$Pri,$SiteName,$Comments) = split(/\|/, $lines[$i], 7);
						push @tickets, $ticket;
						push @dates, $DateAdded;
						push @stimes, $STime;
						push @etimes, $ETime;
						push @priors, $Pri;
						push @sites, $SiteName;
						push @comms, $Comments;
						$i++;
						}	
		#	print "@tickets \n \t", 
		#	"@dates \n \t", 
		#	"@stimes \n \t", 
		#	"@etimes \n \t ",
		#	"@priors \n \t",
		#	"@sites \n \t",
		#	"@comms \n \t";
						
				for $i(0..$#sites) {
				if ( $etimes[$i] gt $TimeNow) && ($dates[$i] lt $currDate) {
			email_setup();
						# print "$sites[$i] is approaching the 2.5hr callback time with a priority of $priors[$i].\n",
						#		"Please review Ticket#$tickets[$i] and remove it from the Alert System.\n" ;
					}
						else{
				print "No tickets have reached the 2.5hr callback time yet! \n";
						}
					$i++;
				}					
	sub email_setup{				
			   my $howmany = 1;

      open (FILE,"C:/Inetpub/wwwroot/cgi-bin/Quotes.txt") || die "Error: $!\n"; 
        my(@quotes)=<FILE>; 
      close FILE; 

      for (0..$howmany) { 
        $quote= $quotes[int(rand()*scalar(@quotes))]; 
		} 
			$body .= "Ticket number $tickets[$i] priority $priors[$i] is approaching the 2.7 hour callback time.\n";
			$body .= "If there are available techs please contact the customer and remove the ticket(s) from the Alert System:\n\n";
			$body .= "http://tac-alert01/alert.html\n\n";
			$body .= "Thank you,\n\n";
			$body .= "TAC\n\n";
			$body .= $quote;
		 send_email($body);
	}

	sub send_email {
  my @emailList= split(/,/, $email);
  my $body = shift;
  my $subject = "Ticket Alert System: $sites[$i], Ticket $tickets[$i] Priority $priors[$i]";
  my $from = "AlertSystem\@isi-info.com";
  my $server = "smtp.isi-info.com";
   
  my $smtp = Net::SMTP->new($server);
  $smtp->mail($ENV{USER});
  $smtp->to($emailList[0]);
  $smtp->to($emailList[1]);
  $smtp->to($emailList[2]);
  $smtp->to($emailList[3]);
  $smtp->to($emailList[4]);
  $smtp->to($emailList[5]);
  $smtp->to($emailList[6]);
  $smtp->to($emailList[7]);
  $smtp->to($emailList[8]);
  $smtp->to($emailList[9]);
  $smtp->to($emailList[10]);
  $smtp->to($emailList[11]);
  $smtp->to($emailList[12]);
  $smtp->to($emailList[13]);
  $smtp->to($emailList[14]);
  $smtp->to($emailList[15]);
  $smtp->to($emailList[16]);
  $smtp->to($emailList[17]);
  $smtp->to($emailList[18]);
  $smtp->to($emailList[19]);
  $smtp->to($emailList[20]);
  $smtp->to($emailList[21]);
  $smtp->data();
  $smtp->datasend("Subject: $subject\n");
  $smtp->datasend("From: $from\n");
  $smtp->datasend("To: $emailList[0],$emailList[1],$emailList[2],$emailList[3],$emailList[4],$emailList[5],$emailList[6],$emailList[7],$emailList[8],$emailList[9],$emailList[10],$emailList[11],$emailList[12],$emailList[13],$emailList[14],$emailList[15],$emailList[16],$emailList[17],$emailList[18],$emailList[19],$emailList[20],$emailList[21]\n");
  $smtp->datasend("\n");
  $smtp->datasend("$body\n");
  $smtp->dataend();
  $smtp->quit;

}
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					