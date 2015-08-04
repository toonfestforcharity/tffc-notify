<!doctype html>
<html>
	<head>		
		<!-- Load jquery -->	
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	
	
		<!-- Get the stylesheet from Extra Life's website for the thermometer -->
		<link rel="stylesheet" href="http://www.extra-life.org/resources/css/widgets/300x250thermo/widget_300x250thermo.css?v=42150.6842014" type="text/css" />
		<!--[if IE 6]>
		<link rel="stylesheet" href="http://www.extra-life.org/resources/css/widgets/300x250thermo/widget_300x250thermo_ie6.css?v=42150.6842014" type="text/css" />
		<![endif]-->

		<!--[if IE 7]>
		<link rel="stylesheet" href="http://www.extra-life.org/resources/css/widgets/300x250thermo/widget_300x250thermo_ie7.css?v=42150.6842014" type="text/css" />
		<![endif]-->

		<!--[if IE 8]>
		<link rel="stylesheet" href="http://www.extra-life.org/resources/css/widgets/300x250thermo/widget_300x250thermo_ie8.css?v=42150.6842014" type="text/css" />
		<![endif]-->
		<link rel="stylesheet" href="http://www.extra-life.org/themes/extralife2014/css/widgets.min.css?v=42150.6842014" type="text/css" />
		
		
		<!-- Internal stylesheet -->
			<style>
				h1, h2 {
					font-weight: normal;
				}
				body {
					font-family: Arial, sans-serif;
					font-size: 22px;
					background: #000;
					color: #fff;
					-webkit-font-smoothing: antialiased;
					-moz-osx-font-smoothing: grayscale;
				}
				strong {
					font-weight: normal;
				}
				div.donationAlert {
					background: #00ff00;
				}
				div.donationAlert, div.recentMessage {
					display: block;
   					min-height: 250px;
				}
				div.newDonation {	
					background-image: url('../../assets/doodle_anim.gif');
    					background-repeat: no-repeat;
    					display: block;
   					min-height: 250px;
				}
				h2.newDonationText {
    					padding-top: 60px;
    					padding-left: 250px;
					text-shadow: 0px 0px 1px #000, 0px 0px 2px #000, 0px 0px 3px #000, 
					0px 0px 4px #000, 0px 0px 5px #000;
   				}
    				p.newDonationText, p.newDonationMessage {
    					padding-left: 250px;
					text-shadow: 0px 0px 1px #000, 0px 0px 2px #000, 0px 0px 3px #000, 
					0px 0px 4px #000, 0px 0px 5px #000;
    				}
    				div#goal {
    					top: 8px;
				}
				div.recentDonations, div.donationAlert, div.recentMessage, div.thermo {
					border: 1px solid #fff;
					margin-top: 35px;
					margin-bottom: 35px;
					padding: 10px;
					width: 700px;
				}
				div.recentDonations h2, div.donationAlert h2, div.recentMessage h2 {
					margin-top: -2px;
				}
				div.note p, div.footer p {
					font-family: Helvetica, Arial, sans-serif;
				}
				div.note p {
					font-size: 20px;
				}
			</style>
			
			
		<!-- Have the donation alert fade out -->
		<script>
			var main = function() {
  				$('div.newDonation').delay(15000).fadeOut()
			}
			$(document).ready(main);
		</script>
		
		
		<!-- Refresh the page every thirty seconds to get data from Extra Life's website. 
		-->
		<meta http-equiv="refresh" content="30">
			
				
		<title>TFFC's Extra Life Donation Tracker</title>
	</head>
	<body>
		<div class="controlpanel">
			<p><a href="template.php">Template</a> <a href="messages.php">Recent Messages</a>
			</p>
		</div>
		
		
		<?php
			// Use simple_html_dom.php
			require '../../assets/simple_html_dom.php';
			
			// Get html data from Extra Life's website
			$html = file_get_html('http://www.extra-life.org/index.cfm?fuseaction=widgets.300x250thermo&participantID=######');
			$html3 = file_get_html('http://www.extra-life.org/index.cfm?fuseaction=widgets.300x250thermo&participantID=######');
			$html2 = file_get_html('http://www.extra-life.org/index.cfm?fuseaction=donorDrive.participantDonations&participantID=######');
			
			// Get html files from server (we will use these files later)
			$recentfile = file_get_html('recent.html');
			$recentmesfile = file_get_html('recentmessage.html');
			
			// Find the first "em" tag from $html
			$raised = $html->find('em', 0);
			
			// Find the second "em tag from $html
			$goal = $html->find('em', 1);
			
			// Place $raised here
			echo "<h1>Raised: ".$raised."</h1>";
			
			// If $goal says "<em>Goal!</em>", then the goal has been reached. 
			// Instead of saying "Goal" again, say "Reached!"
			if (strcmp($goal, "<em>Goal!</em>") == 0) {
				echo "<h1>Goal: Reached!</h1>";
			}
			
			// Otherwise, just show our $goal
			else {
				echo "<h1>Goal: ".$goal."</h1>";
			}
				
			// Now let's get the thermometer from the website, by looking for the fourth 
			// <div>. We will use it later.
			$thermo = $html3->find('div', 4);
			
			// Show the thermometer here
			echo "<div class='thermo'>".$thermo."</div>";
			
			// Get the fourth <h1>
			$group = $html2->find('h1', 4);
			
			// Get the third <strong>
			$recent = $html2->find('strong', 3);
			// Get the fourth <strong>, and so on.
			$recent2 = $html2->find('strong', 4);
			$recent3 = $html2->find('strong', 5);
			$recent4 = $html2->find('strong', 6);
			$recent5 = $html2->find('strong', 7);
			$recent6 = $html2->find('strong', 8);
			
			// Get the first <em> (the most recent messsage)
			$recentmessage = $html2->find('em', 0);
			
			// I don't know why this is here.
			$recentmes2 = $html2->find('em', 1);
			
			// Prepare the paths to these html files. 
			// We will need these to check for changes on Extra Life's website.
			$file_pathto_recent = "recent.html";
			$file_pathto_recentmessage = "recentmessage.html";
			
			
		// The web page will not show anything, if those two html files above are empty.
		// If they are empty, then let's write something into those two files. 
		// These tracker must have permission for editing those files.
			
			// In this case, recent.html has a filesize of 0. It is empty.
			if ( 0 == filesize( $file_pathto_recent ) ) {
				
				// Since the web page is open, notify the user to refresh the page. No donation information will show. 
				// The web page should refresh by itself anyway.
    			echo "Error: <br>";
				echo "Please refresh the page to reset the tracker.<br>";
				
				// Open recent.html for writing. If unable to open recent.html, notify the user.
   				$recentstor = fopen("recent.html", "w") or die("The tracker does not have permission to open recent.html");
   				
   				// Write that there are no donations into recent.html.
   				fwrite($recentstor, "There are no donations.");
   				
   				// Close recent.html
  				fclose($recentstor);
			}
			
			// In this case, the filesize of recentmessage.html is 0. It is empty.
			if ( 0 == filesize( $file_pathto_recentmessage ) ) {
				
				// Since the web page is open, notify the user to refresh the page. No donation information will show. 
				// The web page should refresh by itself anyway.
    			echo "Error: <br>";
				echo "Please refresh the page to reset the tracker.";
   			
   				// Open recentmessage.html for writing. If unable to open recentmessage.html, notify the user.
   				$recentstorm = fopen("recentmessage.html", "w") or die("The tracker does not have permission to open recentmessage.html");
   				
   				// Write that there are no messages into recentmessages.html.
   				fwrite($recentstorm, "There are no recent messages.");
   				
   				// Close recentmessages.html
  				fclose($recentstorm);
			}
			
		// Get the first (the only) <em> from our recentmessage.html file
		$recmesfile = $recentmesfile->find('em', 0);
		
		// Get the first (the only) <strong> from our recent.html file
    	$recentstr = $recentfile->find('strong', 0);
		?>
		
		<!-- For styling and organization purposes, this is the donation alert section -->
		<div class='donationAlert'>


			<!-- There are three different ways to check for a new donation. -->
			<?php
				
				// CASE 1
				// If the recent donation AND recent message (from the Extra Life website)
				// does not match what is stored in recent.html & recentmessage.html 
				if (strcmp($recent, $recentstr) !== 0 && strcmp($recmesfile, $recentmessage) !== 0) {
		  		echo "<div class='container'><div class='newDonation'><h2 class='newDonationText'>NEW DONATION!</h1><audio autoplay src='../../assets/ding.mp3'></audio>";
				echo "<p class='newDonationText'>".$recent."</p>";
    			fclose($recentsto);
   				$recentsto = fopen("recent.html", "w") or die("Unable to open file!");
   				fwrite($recentsto, $recent);
  				fclose($recentsto);
   				echo "<p class='newDonationMessage'>".$recentmessage."</div></div>";
   				$recentmesto = fopen("recentmessage.html", "w") or die("Unable to open file!");
   				fwrite($recentmesto, $recentmessage);
  				fclose($recentmesto);
				}
				
				// CASE 2
				// If the recent donation does not match what is stored in recent.html,
				// but the messages are both blank or identical.
				if (strcmp($recent, $recentstr) !== 0 && strcmp($recmesfile, $recentmessage) == 0) {
		 	 	echo "<div class='container'><div class='newDonation'><h2 class='newDonationText'>NEW DONATION!</h1><audio autoplay src='../../assets/ding.mp3'></audio>";
				echo "<p class='newDonationText'>".$recent."</p>";
    			fclose($recentsto);
   				$recentsto = fopen("recent.html", "w") or die("Unable to open file!");
   				fwrite($recentsto, $recent);
  				fclose($recentsto);
				
				// There is no new message to be displayed.
   					// echo "<p class='newDonationMessage'>".$recentmessage."</div></div>";
   					// $recentmesto = fopen("recentmessage.html", "w") or die("Unable to open file!");
   					// fwrite($recentmesto, $recentmessage);
  					// fclose($recentmesto);
				}
				
				// CASE 3
				// If someone happens to donate the same amount, but leaves a different message,
				// the tracker should be able to detect it.
				if (strcmp($recent, $recentstr) == 0 && strcmp($recmesfile, $recentmessage) !== 0) {
		  		echo "<div class='container'><div class='newDonation'><h2 class='newDonationText'>NEW DONATION!</h1><audio autoplay src='../../assets/ding.mp3'></audio>";
				echo "<p class='newDonationText'>".$recent."</p>";

				// The donation alert would be the same.
    				// fclose($recentsto);
   					// $recentsto = fopen("recent.html", "w") or die("Unable to open file!");
   					// fwrite($recentsto, $recent);
  					// fclose($recentsto);

				// The donation message would be different.
				
   					echo "<p class='newDonationMessage'>".$recentmessage."</div></div>";
   					$recentmesto = fopen("recentmessage.html", "w") or die("Unable to open file!");
   					fwrite($recentmesto, $recentmessage);
  					fclose($recentmesto);
				}
		?>
		</div>	
		
		<!-- Recent Donations -->
		<?php
			echo "<div class='recentDonations'>";
			echo "<h2>Recent donations:</h2>";
			echo $recent;
			echo "<br>".$recent2;
			echo "<br>".$recent3;
			echo "<br>".$recent4;
			echo "<br>".$recent5;
			echo "<br>".$recent6;
			echo "</div>";
			echo "<div class='recentMessage'>";
			echo "<h2>Most recent message:</h2>".$recentmessage;
			echo "</div>";
		?>
		<div class="footer">
			<p>TFFC's Extra Life Donation Tracker</p>
		</div>
	</body>
</html>
