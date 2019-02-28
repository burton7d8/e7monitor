# e7monitor
Monitors PON &amp; ONT Eth Port traffic on E7's

Edit index.php and edit this line "$e7s = array('node-name-1','node-name-2','node-name-3');" to include the dns hostname or ip addres of your e7 nodes ( this is what the snmpget will use to connect to the e7 )

Edit query.php and edit this line "$pw = "public";" and update to the snmp read community string of your e7's

The files must be run on a webserver that supports php, and has network access to snmp query your e7-2 nodes.

Once you load the index file, it will prompt your for the node, shelf, slot, pon, and optionally an ont id and ont ethernet port. It then will start making queries every 5 seconds and will update the graphs live for you to monitor.

It is recommended to test in your lab envirnonments first before using it in production.  I am not able to test every ONT and every scenario.  

Please feel free to make changes and additions to this code, and submit them to "dev" to be reviewed and applied to master for everyone to use!  Thanks!
