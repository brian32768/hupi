#!/bin/sh
#
echo "Content-Type: text/plain"
echo ""

echo "Fixing permissions..."

sudo /srv/cgi-bin/fixperms.sh

echo "All done. Thank you for waiting."
exit 0


