#!/usr/bin/perl
use strict;

print "Content-Type: text/html\n\n<html><body>";

getinput();
if ($form{message eq ''}) {
    print "Sorry, but you did not type anything!<br>\n";
    exit 0;
}
if ($form{email}) {
    my $dest = $form{$email};
    if ($dest =~ /^\S+\@/\S+\.\w+$) {
	open(MAIL, "|/usr/sbin/sendmail") || die;
	print MAIL <<EOF;
From: HuPI Comment Form <webmaster@hupi.org>
$form{message}
EOF
        close MAIL;
    }
}

print <<EOF;
<h1>Thanks for your comments...</h1>

</body></html>
EOF

#
#  Return an assoc array containing the input from stdin,
#  (method = post from a web form) such that for each input
#  from the form named 'x' there is a value in the array. For example,
#  if an input field is named "email" then $FORM{email} will contain
#  the value of the field. 
#
#  Fields containing multiple values (as in checkbox fields)
#  will have the returned values separated by a VERTICAL TAB
#
#  Make sure that the field names contain only letters, underscores,
#  and numbers. In particular, hyphens  ( - ) are not allowed.
#
sub getinput {
    my ($buffer) = '';
    my ($length) = $ENV{'CONTENT_LENGTH'};
    my ($name, $value);	
    my ($pair, @pairs);
    my (%FORM);
    my ($oref) = shift;

    read(STDIN, $buffer, $length);

    if ($ENV{"QUERY_STRING"}) {
    # Save the environment and input to a file.
	my ($file) = $ENV{"QUERY_STRING"};
	delete($ENV{"QUERY_STRING"}); # DON'T save this!
	$file =~ s/[^\w]+//g; # Remove non-text characters for security
	open(HFILE, ">/tmp/$file");

	print HFILE "my_cgi=\$1\n\n";
	while (($k,$v) = each(%ENV)) {
	    print HFILE "$k=\"$v\"; export $k\n";
	}
	print HFILE "\n\$my_cgi <<EOF\n", $buffer, "\nEOF\n";
	close HFILE;
    }

   # Split the name-value pairs
    @pairs = split(/&/, $buffer);

    foreach $pair (@pairs) {
	($name, $value) = split(/=/, $pair);
	next unless $name;

	$value =~ tr/+/ /;
	$value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack('C', hex($1))/eg;

	$value =~ s/\r\n/\n/g;  # CRLF => LF   for those dos people
	$value =~ s/\r/\n/g;    # CR => LF     for those mac people

	# strip out any characters that are not in this list
    	$value =~ s/[^\w@#\$%\^\*()_\-\+=\{\}\[\]\\|;:\'\"<,>\.?\/~ &]//g;
       # In some cases there can be several variables with one name
       # The values are concatenated together, with a VT as a delimiter.

	if (defined($FORM{$name})) {
	    $FORM{$name} .= "\013" . $value;
	} else {
	    push(@$oref, $name) if $oref;
	    $FORM{$name} = $value;
	}
    }
    return %FORM;
}

sub header {
    my ($title, $header) = @_;

    print <<EOH
Content-type: text/html

<HTML><HEAD>
<TITLE>$title</TITLE>
</HEAD>
<BODY $main::BODY>
EOH
;
    $header = "<h1>$title</h1>\n" unless $header;
    print $header;
}

sub footer {
    my ($footer) = shift;

    print "$footer<p>\n" if $footer;
    print "</BODY>\n</HTML>\n";
}

#
# Die in a nice webful way.
#
sub die {
    header();
    print @_;
    footer();
    exit;
}

1;
