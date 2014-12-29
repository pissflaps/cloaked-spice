#!C:/Perl/bin/perl.exe -w
use strict;
#use CGI qw(:standard);

my $textfile = "Quotes.txt"; 
my $howmany = 1;

open (FILE,$textfile) || die $!; 
my(@lines)=<FILE>; 
close FILE; 

for (0..$howmany) { 
  $qoute $lines[int(rand()*scalar(@lines))]; 
} 

