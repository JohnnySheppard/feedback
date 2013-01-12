<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="default" />
		<!--link rel="apple-touch-icon" href="images/icon.png" /-->
		<!--link rel="apple-touch-startup-image" href="images/load.png" /-->
		<link rel="stylesheet" href="css/add2home.css">
		<script type="application/javascript" src="js/add2home.js"></script>
        <title>
			St John's Worship Feedback
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
        <div data-role="page" id="page1">
            <div data-theme="b" data-role="header">
                <h3>
                    SJ Worship FB
                </h3>
            </div>
            <div data-role="content" style="padding: 15px">
			<form action="submit.php" method="get">
                <div data-role="fieldcontain">
                    <label for="selectmenu1">
                        Service Date:
                    </label>
                    <select name="selectmenu1" id="selectmenu1">
                        <option value=""></option>
                        <?php
							$todays_date = time();
							//get the sunday of this week
							$todays_date = $todays_date - (date("w",$todays_date) * 86400);
							$last_week = $todays_date - 604800;
							$next_week = $todays_date + 604800;
							echo "						<option value=\"" . $last_week . "\">" . date("D jS M Y",$last_week) . "</option>\n";
							echo "						<option value=\"" . $todays_date . "\" selected>" . date("D jS M Y",$todays_date) . "</option>\n";
							echo "						<option value=\"" . $next_week . "\">" . date("D jS M Y",$next_week) . "</option>\n";
						?>
                    </select>
                </div>
                <div data-role="fieldcontain">
                    <label for="selectmenu2">
                        Worship Leader:
                    </label>
                    <select name="selectmenu2" id="selectmenu2">
                        <option value="">
                            
                        </option>
						<option value="Ben Baggett">
                           Ben Baggett
                        </option>
						<option value="James Hammerstein">
                            James Hammerstein
                        </option>
						<option value="Johnny Sheppard">
                            Johnny Sheppard
                        </option>
						<option value="Malcolm Bateman">
                            Malcolm Bateman
                        </option>
						<option value="Nicki Sudworth">
                            Nicki Sudworth
                        </option>
						<option value="Philippa Stuart">
                            Philippa Stuart
                        </option>
						<option value="Richard Jack">
                            Richard Jack
                        </option>
						<option value="Tim Sudworth">
                            Tim Sudworth
                        </option>
                    </select>
                </div>
				<div data-role="fieldcontain">
                    <fieldset data-role="controlgroup">
                        <input type="checkbox" name="checkbox2" id="checkbox2" class="custom" />
						<label for="checkbox2">Service Leader?</label>
						</fieldset>
                </div>
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup">
                        <label for="textinput1">
							Firstname:
                        </label>
                        <input id="textinput1" name="textinput1" placeholder="Firstname" value="" type="text" />
                    </fieldset>
                </div>
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup">
                        <label for="textinput2">
							Surname:
                        </label>
                        <input id="textinput2" name="textinput2" placeholder="Surname" value="" type="text" />
                    </fieldset>
                </div>
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup">
                        <label for="textinput3">
							Email Address:
                        </label>
                        <input id="textinput3" name="textinput3" placeholder="Email Address" value="" type="email" />
                    </fieldset>
                </div>
				<div data-role="fieldcontain">
                    <fieldset data-role="controlgroup">
                        <input type="checkbox" name="checkbox1" id="checkbox1" class="custom" />
						<label for="checkbox1">Fill Survey in Now</label>
						</fieldset>
                </div>
                <input type="submit" data-icon="check" data-iconpos="right" value="Invite"/>
			</form>
            </div>
        </div>
        <script>
            //App custom javascript
        </script>
    </body>
</html>