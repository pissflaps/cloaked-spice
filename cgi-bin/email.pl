#!C:/Perl/bin/perl.exe
use CGI qw(:standard);
use Net::SMTP;

open(IN,"C:/inetpub/wwwroot/Email.txt") || die "Error: $!\n";
    my @addresses= <IN>;

close (IN);

$email= "@addresses";
@emailList = split(/,/, $email); 

      $body .= "Ticket# is approaching the 3 hour callback time.\n";
      $body .= "Please contact the customer if there are any available techs and remove the ticket from the Alert System.\n\n";
      $body .= "Thank you,\n\n";
      $body .= "TAC";
      send_email($body);

sub send_email {
#  my $to = shift;
  my $body = shift;
  my $subject = "Ticket Alert System";
  my $from = "TAC_Alert\@isi-info.com";
  my $server = "smtp.isi-info.com";

  my $smtp = Net::SMTP->new($server);
  $smtp->mail($ENV{USERS});
#  $smtp->to($to);
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
  $smtp->datasend("To: TACAlertList\@isi-info.com\n");
  $smtp->datasend("\n");
  $smtp->datasend("$body\n");
  $smtp->dataend();
  $smtp->quit;

}