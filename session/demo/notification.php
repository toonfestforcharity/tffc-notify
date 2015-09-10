<!DOCTYPE html>
<html>


  <!-- notification.php is designed to work with browser source plugins in Open Broadcaster Software -->


	<head>
		<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="animate.css"/>

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
			#container {
				left: 0;
				top: 0;
				width: 1280px;
				height: 720px;
				position: absolute;
				overflow: hidden;
			}
			h1, h2 {
				font-weight: normal;
			}
			body {
				font-family: 'Montserrat', Arial, sans-serif;
				font-size: 22px;
				-webkit-font-smoothing: antialiased;
				-moz-osx-font-smoothing: grayscale;
				color: #000;
			}
			strong {
				font-weight: normal;
			}

			div.donationAlert, div.recentMessage {
				display: block;
				min-height: 250px;
			}
			div.newDonation {
				margin-top: 440px;
				background-image: url('../../assets/doodle_anim.gif');
				background-repeat: no-repeat;
				display: block;
				min-height: 250px;
				opacity: 0;
			}
			h2.newDonationNotification {
				padding-top: 100px;
				padding-left: 250px;
				text-shadow: 0px 0px 1px #000, 0px 0px 2px #000, 0px 0px 3px #000,
				0px 0px 4px #000, 0px 0px 5px #000;
				opacity: 1;
				color: #fff;
				}
			p.newDonationText, p.newDonationMessage {
				padding-top: 100px;
				padding-left: 250px;
				text-shadow: 0px 0px 1px #000, 0px 0px 2px #000, 0px 0px 3px #000,
				0px 0px 4px #000, 0px 0px 5px #000;
				opacity: 0;
				}
			div#goal {
				top: 8px;
			}
			// div.recentDonations, div.donationAlert, div.recentMessage, div.thermo {
			//	border: 1px solid #fff;
			//	margin-top: 35px;
			//	margin-bottom: 35px;
			//	padding: 10px;
			//	width: 700px;
			//}
			div.recentDonations h2, div.donationAlert h2, div.recentMessage h2 {
			}
			div.note p, div.footer p {
				font-family: Helvetica, Arial, sans-serif;
			}
			div.note p {
				font-size: 20px;
			}
			p.donator {
				position: absolute;
				left: 250px;
				bottom: 150px;
				color: white;
				background-color: rgba(35, 193, 232, 0.5);
				opacity: 0;
			}
		</style>




		<!-- Refresh the page every fifty seconds to get data from Extra Life's website.
		-->
		<meta http-equiv="refresh" content="50">


		<title>TFFC's Extra Life Donation Tracker</title>
	</head>
	<body>


		<?php
//		echo "Hello, world!";
			// Use simple_html_dom.php
			require '../../assets/simple_html_dom.php';

//			echo "Got simple_html_dom.php! Thanks!";

			// Get html data from Extra Life's website
			$html = file_get_html('http://www.extra-life.org/index.cfm?fuseaction=donorDrive.participantDonations&participantID=143797');

//			echo "<br>Extra Life website loaded!";

			// Get html files from server (we will use these files later)
			$recentfile = file_get_html('recent.html');
			$recentmesfile = file_get_html('recentmessage.html');
//			echo "<br>Temporary HTML files loaded!";

//			 Get the fourth <h1>
//			$group = $html->find('h1', 3);
//			echo "<br>Got the fourth h1 from the website!";
// echo $group;
			// Get the third <strong>
			// This should be the most recent donation.
			$recent = $html->find('strong', 3);
//			echo "<br>I now know the most recent donation! Thanks!";

//			echo "<br>".$recent;
			// Get the fourth <strong>, and so on.
			$recent2 = $html->find('strong', 4);
			$recent3 = $html->find('strong', 5);
			$recent4 = $html->find('strong', 6);
			$recent5 = $html->find('strong', 7);
			$recent6 = $html->find('strong', 8);

			// Get the recent messages, using the same method as above.
			// Get the first <em> (the most recent message)
			$recentmessage = $html->find('em', 0);
			$recentmes2 = $html->find('em', 1);
//			echo "<br> This is recentmes2:".$recentmes2;
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
    				echo "Error: ";
				echo "Tracker file 'recentDonation' resetting...<br>";

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
    				echo "Error: ";
				echo "Tracker file 'messages'  resetting...";

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

			<!-- There are four different ways to check for a new donation. -->
			<?php

				// CASE 1
				// If the recent donation AND recent message (from the Extra Life website)
				// does not match what is stored in recent.html & recentmessage.html
				if (strcmp($recent, $recentstr) !== 0 && strcmp($recmesfile, $recentmessage) !== 0 && strlen( $recent ) !== 0 && strlen($recentmessage !== 0 ) ) {
		  		echo "<div class='container'><div class='newDonation'><audio autoplay src='../../assets/shortRace.webm'></audio>";
					echo "<h2 class='newDonationNotification'><ul class='texts'><li data-in-effect='rollIn' data-out-effect='rotateOut' data-out-sync='true'>NEW DONATION!</li><li data-in-effect='rollIn' data-out-effect='rotateOut' data-out-sync='true'>".$recent."</li>";
						echo "<li data-in-effect='rollIn'data-out-effect='rotateOut' data-out-sync='true'>".$recentmessage."</li>";

						echo "</ul></h2>";
						echo "<p class='donator'>".$recent."</p>";
   				$recentsto = fopen("recent.html", "w") or die("Unable to open file!");
   				fwrite($recentsto, $recent);
  				fclose($recentsto);
   				$recentmesto = fopen("recentmessage.html", "w") or die("Unable to open file!");
				fwrite($recentmesto, $recentmessage);
  				fclose($recentmesto);
				}

				// CASE 2
				// If the recent donation does not match what is stored in recent.html,
				// but the messages are both blank or identical.
				if (strcmp($recent, $recentstr) !== 0 && strcmp($recmesfile, $recentmessage) == 0 && strlen($recent) !== 0) {
	echo "<div class='container'><div class='newDonation'><audio autoplay src='../../assets/shortRace.webm'></audio>";
					echo "<h2 class='newDonationNotification'><ul class='texts'><li data-in-effect='rollIn' data-out-effect='rotateOut' data-out-sync='true'>NEW DONATION!</li><li data-in-effect='rollIn' data-out-effect='rotateOut' data-out-sync='true'>".$recent."</li>";
					//		There is no new message to be displayed.
					//		echo "<li data-in-effect='rollIn'data-out-effect='rotateOut' data-out-sync='true'>".$recentmessage."</li>";



						echo "</ul></h2>";
						echo "<p class='donator'>".$recent."</p>";
   				$recentsto = fopen("recent.html", "w") or die("Unable to open file!");
   				fwrite($recentsto, $recent);
  				fclose($recentsto);

				// There is no new message to be displayed.
   					// echo "<p class='newDonationMessage'>".$recentmessage."</div></div>";
   					 $recentmesto = fopen("recentmessage.html", "w") or die("Unable to open file!");
   					 fwrite($recentmesto, $recentmessage);
  					 fclose($recentmesto);
				}

				// CASE 3
				// If someone happens to donate the same amount, but leaves a different message,
				// the tracker should be able to detect it.
				if (strcmp($recent, $recentstr) == 0 && strcmp($recmesfile, $recentmessage) !== 0 && strlen($recent) !== 0 ) {
	echo "<div class='container'><div class='newDonation'><audio autoplay src='../../assets/shortRace.webm'></audio>";
					echo "<h2 class='newDonationNotification'><ul class='texts'><li data-in-effect='rollIn' data-out-effect='rotateOut' data-out-sync='true'>NEW DONATION!</li><li data-in-effect='rollIn' data-out-effect='rotateOut' data-out-sync='true'>".$recent."</li>";
						echo "<li data-in-effect='rollIn' data-out-effect='rotateOut' data-out-sync='true'>".$recentmessage."</li>";



						echo "</ul></h2>";
						echo "<p class='donator'>".$recent."</p>";

				// The donation alert would be the same.
    				// fclose($recentsto);
   					// $recentsto = fopen("recent.html", "w") or die("Unable to open file!");
   					// fwrite($recentsto, $recent);
  					// fclose($recentsto);

				// The donation message would be different.

   					$recentmesto = fopen("recentmessage.html", "w") or die("Unable to open file!");
   					fwrite($recentmesto, $recentmessage);
  					fclose($recentmesto);
				}

				// CASE 4
				// If there are any identical duplicates (name, amount, and message are
				// the same.) Then there is a new donation.
				// This is unlikely to happen, but it CAN happen.
				if (strcmp($recent, $recent2) == 0 && strcmp($recentmessage, $recentmes2) == 0 && strlen($recent) !== 0 ) {
	echo "<div class='container'><div class='newDonation'><audio autoplay src='../../assets/shortRace.webm'></audio>";
					echo "<h2 class='newDonationNotification'><ul class='texts'><li data-in-effect='rollIn' data-out-effect='rotateOut' data-out-sync='true'>NEW DONATION!</li><li data-in-effect='rollIn' data-out-effect='rotateOut' data-out-sync='true'>".$recent."</li>";
						echo "<li data-in-effect='rollIn'data-out-effect='rotateOut' data-out-sync='true'>".$recentmessage."</li>";



						echo "</ul></h2>";
						echo "<p class='donator'>".$recent."</p>";
				}

//				echo "If you see this, then the tracker is working! :)";
		?>
		</div>


<!-- Finale... ->
<!-- Now let's use JavaScript, jQuery, animate.css, lettering.jquery,js, and
      textillate.js to make the donation notfication look nice. -->

<!-- Let's get the length.. -->
      <script>
          var TextInsideH2 = document.getElementsByTagName('h2')[0].textContent;
          console.log(TextInsideH2.length);
      </script>



		<!-- Recent Donations and Most Recent Message-->
		<?php
			//echo "<div class='recentDonations'>";
			//echo "<h2>Recent donations:</h2>";
			//echo $recent;
			//echo "<br>".$recent2;
			//echo "<br>".$recent3;
			//echo "<br>".$recent4;
			//echo "<br>".$recent5;
			//echo "<br>".$recent6;
			//echo "</div>";
			//echo "<div class='recentMessage'>";
			//echo "<h2>Most recent message:</h2>".$recentmessage;
			//echo "</div>";
		?>
		<!-- Load jquery -->
		<script src="jquery-2.1.4.min.js"></script>
		<script src="jquery.lettering.js"></script>
		<script src="jquery.textillate.js"></script>
		<script>
			var main = function() {
				$('.newDonationNotification').textillate().delay(25000).fadeOut();
				$('div.newDonation').delay(100).animate({opacity: 1}, 500).delay(25000).fadeOut();
				$('p.donator').delay(10000).animate({opacity: 1, bottom: "+=10px"}, 300).delay(15000).animate({opacity: 0, bottom: "-=10px"}, 300).fadeOut();
			}
			$(document).ready(main);
		</script>

		<!-- <div class="footer">
			<p>TFFC's Extra Life Donation Tracker</p>
		</div> -->
	</body>
</html>
