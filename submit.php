<?PHP
if (isset($_GET["selectmenu1"]) && isset($_GET["selectmenu2"]) && isset($_GET["textinput1"]) && isset($_GET["textinput2"]) && isset($_GET["textinput3"])){
	//create the csv file
	$fp = fopen('tmp/participant.csv', 'w');

	//work out valid from and until.
	$start = date("Y-m-d",$_GET["selectmenu1"]) . " 12:00";
	$end = date("Y-m-d",$_GET["selectmenu1"] + 518400) . " 18:00";
	
	//set up the header line
	fputcsv($fp, array("firstname","lastname","email","validfrom","validuntil"," attribute_1 <Service Date>"," attribute_2 <Worship Leader>"));
	fputcsv($fp, array($_GET["textinput1"],$_GET["textinput2"],$_GET["textinput3"],$start,$end,date("D jS M Y",$_GET["selectmenu1"]),$_GET["selectmenu2"]));
	fclose($fp);
	
	
	require_once 'class.phpmailer.php';

	$mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch

	try {
	  
	  $mail->AddAddress('mail@johnnysheppard.com', 'Johnny Sheppard');
	  $mail->SetFrom('noreply@johnnysheppard.com', 'SJ Worship Feedback');
	  $mail->AddReplyTo('noreply@johnnysheppard.com', 'SJ Worship Feedback');
	  $mail->Subject = 'New St John\'s Worship Feedback Participant';
	  $mail->AltBody = 'Hi Johnny,\n Here is a new participant.'; // optional - MsgHTML will create an alternate automatically
	  $mail->MsgHTML('Hi Johnny,<br> Here is a new participant.');
	  $mail->AddAttachment('tmp/participant.csv');      // attachment
	  $mail->Send();
	} catch (phpmailerException $e) {
	  echo $e->errorMessage(); //Pretty error messages from PHPMailer
	} catch (Exception $e) {
	  echo $e->getMessage(); //Boring error messages from anything else!
	}
	unlink('tmp/participant.csv');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>
        </title>
        <link rel="stylesheet" href="css/jquery.mobile-1.1.1.min.css" />
        <link rel="stylesheet" href="css/my.css" />
        <style>
            /* App custom styles */
        </style>
        <script src="js/jquery.js">
        </script>
        <script src="js/jquery.mobile-1.1.1.min.js">
        </script>
        <script src="js/my.js">
        </script>
    </head>
    <body>
        <!-- Home -->
        <div data-role="page" id="page2">
            <div data-theme="b" data-role="header">
                <h3>
                    SJ Worship FB
                </h3>
            </div>
            <div data-role="content" style="padding: 15px">
				<h2>
					Thanks...
				</h2>
					Thanks for filling this in. An Invite to the feedback site will be sent to you shortly.
					<a data-role="button" data-direction="reverse" data-rel="back" data-transition="fade"
					href="#" data-icon="arrow-l" data-iconpos="left">
						Add Another
					</a>
            </div>
        </div>
        <script>
            //App custom javascript
        </script>
    </body>
</html>