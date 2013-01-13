<?PHP

$survey_now = 0;
$service_leader = "N";
$token = null;

if (isset($_GET["selectmenu1"]) && isset($_GET["selectmenu2"]) && isset($_GET["textinput1"]) && isset($_GET["textinput2"]) && isset($_GET["textinput3"])){
	if (isset($_GET["checkbox1"])){
		$survey_now = 1;
	}
	if (isset($_GET["checkbox2"])){
		$service_leader = "Y";
	}
	
	require_once 'include/jsonRPCClient.php';
	require_once 'include/survey_details.php';

	// instanciate a new client 
	$myJSONRPCClient = new jsonRPCClient( LS_BASEURL.'/index.php/admin/remotecontrol' );

	// receive session key
	$sessionKey= $myJSONRPCClient->get_session_key( LS_USER, LS_PASSWORD );


	//add recipient 2013-01-12 18:52
	if ($survey_now == 1){ //when adding participant, force limesurvey to think the invite has already been sent so it doesn't send it at a later date. (ie. when the send all pending invites is pressed)
		$recipient = $myJSONRPCClient->add_participants($sessionKey, $survey_id ,array(array("firstname"=>$_GET["textinput1"],"lastname"=>$_GET["textinput2"],"email"=>$_GET["textinput3"],"attribute_1"=>date("D jS M Y",$_GET["selectmenu1"]),"attribute_2"=>$_GET["selectmenu2"],"attribute_3"=>$service_leader,"emailstatus"=>"OK","sent"=>date("Y-m-d H:i"))),true);
	}
	else{
		$recipient = $myJSONRPCClient->add_participants($sessionKey, $survey_id ,array(array("firstname"=>$_GET["textinput1"],"lastname"=>$_GET["textinput2"],"email"=>$_GET["textinput3"],"attribute_1"=>date("D jS M Y",$_GET["selectmenu1"]),"attribute_2"=>$_GET["selectmenu2"],"attribute_3"=>$service_leader,"emailstatus"=>"OK")),true);
	}

	/*echo "<pre>";
	print_r($recipient);
	echo "</pre>";
	*/

	//Retrieve Token
	if (isset($recipient[0]["token"])){
		$token = $recipient[0]["token"];
		//echo "<br>$token<br>";
	}


	//send invite
	if ($survey_now == 0){
		$invite = $myJSONRPCClient->invite_participants($sessionKey, $survey_id);
	}	

	/*echo "<pre>";
	print_r($invite);
	echo "</pre>";*/

	// release the session key
	$myJSONRPCClient->release_session_key( $sessionKey );
	
	
	
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
					Thanks for filling this in.
				<?php
				if (isset($token) && ($survey_now == 1)){
					echo "Please <a href=\"" . LS_BASEURL . "/index.php/survey/index/sid/" . $survey_id . "/token/" . $token . "\" rel=\"external\">click here</a> to continue.";
				}
				else 
					echo '
					An Invite to the feedback site will be sent to you shortly.
					<a data-role="button" data-direction="reverse" data-rel="back" data-transition="fade"
					href="#" data-icon="arrow-l" data-iconpos="left">
						Add Another
					</a>';
				?>
            </div>
        </div>
        <script>
            //App custom javascript
        </script>
    </body>
</html>