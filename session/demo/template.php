<!doctype html>
<html>
	<head>	
		<link rel="stylesheet" href="http://www.extra-life.org/resources/css/widgets/300x250thermo/widget_300x250thermo.css?v=42150.6842014" type="text/css" />
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="jquery.storage.js"></script>
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
		<style>

			@font-face {
    			font-family: "Impress-BT";
    			src: url(http://104.236.2.249/assets/impress-bt.ttf);
			}
			h1, h2 {
				font-weight: normal;
			}
			body {
				font-family: "Impress-BT", Arial, sans-serif;
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
				display: block;
    			min-height: 250px;
				background: #00ff00;
			}
			div.newDonation {
				background-image: url('doodle_anim.gif');
    			background-repeat: no-repeat;
    			display: block;
    			min-height: 250px;
			
			}
			h2.newDonationText {
    			padding-top: 70px;
    			padding-left: 250px;
					text-shadow:  0px 0px 1px #000, 0px 0px 2px #000, 0px 0px 3px #000, 0px 0px 4px #000, 0px 0px 5px #000;
    		}
    		p.newDonationText, p.newDonationMessage {
    			padding-left: 250px;
					text-shadow:  0px 0px 1px #000, 0px 0px 2px #000, 0px 0px 3px #000, 0px 0px 4px #000, 0px 0px 5px #000;
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
		<script>
			var main = function() {
  				$('div.newDonation').delay(15000).fadeOut()
			}

			$(document).ready(main);
		</script>
		<meta http-equiv="refresh" content="30">
		<title>TFFC's Extra Life Donation Tracker Template for Overlays</title>
	</head>
	<body>
		<div class="controlpanel">
			<p><a href="index.php">Return to tracker</a> <a href="messages.php">Recent Messages</a></p>
		</div>
		<?php
			require '../../assets/simple_html_dom.php';
			$html = file_get_html('http://www.extra-life.org/index.cfm?fuseaction=widgets.300x250thermo&participantID=147687');
			$html3 = file_get_html('http://www.extra-life.org/index.cfm?fuseaction=widgets.300x250thermo&participantID=147687');
			$html2 = file_get_html('http://www.extra-life.org/index.cfm?fuseaction=donorDrive.participantDonations&participantID=147687');
			$raised = $html->find('em', 0);
			$goal = $html->find('em', 1);
			echo "<h1>Raised: ".$raised."</h1>";
			if (strcmp($goal, "<em>Goal!</em>") == 0) {
				echo "<h1>Goal: Reached!</h1>";
			}
			else {
				echo "<h1>Goal: ".$goal."</h1>";
			}
			$thermo = $html3->find('div', 4);
			echo "<div class='thermo'>".$thermo."</div>";
			$group = $html2->find('h1', 4);
			$recent = $html2->find('strong', 3);
			$recent2 = $html2->find('strong', 4);
			$recent3 = $html2->find('strong', 5);
			$recent4 = $html2->find('strong', 6);
			$recent5 = $html2->find('strong', 7);
			$recent6 = $html2->find('strong', 8);
			$recentmessage = $html2->find('em', 0);
			$recentfile = file_get_html('recent1.html');
			$recentmesfile = file_get_html('recentmessage1.html');
			$recmesfromfile = $recentmesfile->find('em', 0);
    		$recentstr = $recentfile->find('strong', 0);
    		echo "<div class='donationAlert'>";
    		echo "<div class='container'><div class='newDonation'><h2 class='newDonationText'>NEW DONATION!</h1><audio autoplay src='../../assets/snippet2.mp3'></audio>";
			echo "<p class='newDonationText'>".$recent."</p>";
   			echo "<p class='newDonationMessage'>".$recentmessage."</div></div>";

  			echo "</div>";
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
		<div class="note">
			<p>Test examples are taken from 
				<a href="http://www.extra-life.org/index.cfm?fuseaction=donorDrive.participant&participantID=147687">Benjamin Dominguez's Extra Life donations page.</a>
				<br>This updates every thirty seconds to grab data from Extra Life's website.
			</p>
		</div>
		<div class="footer">
			<p>1FYME LABS</p>
			<p>TFFC's Extra Life Donation Tracker version: 0.4</p>
		</div>
	</body>
</html>
