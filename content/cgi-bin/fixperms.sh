#!/bin/sh
#
# Called from fixperms.cgi to fix permissions on HuPI files
#
cd /srv || exit 1

echo "Fixing directories..."
for i in `find . -path ./wiki -prune -o -path ./DarkerIRC -prune -o -type d -print`; do
  echo $i
#  chgrp hupi $i
#  chmod 2775 $i
done

echo ""
echo "Fixing files..."
for i in `find . -path ./wiki -prune -o -path ./DarkerIRC -prune -o -type f -print`; do
  echo $i
#  chgrp hupi $i
#  chmod 664 $i
done

echo "Permissions should be correct now."

exit 0
