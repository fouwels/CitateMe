CitateMe - Twilio
=========

Generates full book citations from their title via google books,
Accessed via POST or over twilio SMS.

Twapi: __POST__ http://citate-me.eu01.aws.af.cm/twapi.php

Twilio: __+44 1274 451319__ sms with the title to look up and any relevant arguments - see below.
##Debug
- --echo : Echo the message AFTER it has passed through the filter [$bodyClean]
- --url : Return the url that was GETted to the gbooks api

##User
- --apa : APA citation format
- --mla : MLA citation format

##Example
![Screenshot](/meta/WPScreenshot.png)