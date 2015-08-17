<!DOCTYPE html>
<html>


  <!-- recentDonations.php is designed to work with tffc-layout -->


	<head>
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
				font-family: Montserrat, Arial, sans-serif;
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
		$html = file_get_html('http://www.extra-life.org/index.cfm?fuseaction=donorDrive.participantDonations&participantID=148534');

//			echo "<br>Extra Life website loaded!";


			// Get the fourth <h1>
			$group = $html->find('h1', 4);
//			echo "<br>Got the fourth h1 from the website!";
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
?>

		<!-- Recent Donations and Most Recent Message-->
		<?php
//			echo "Hello, world!";
			echo "<div class='recentDonations'>";
//			echo "<h2>Recent donations:</h2>";
			echo $recent;
			echo "<br>".$recent2;
			echo "<br>".$recent3;
			echo "<br>".$recent4;
			echo "<br>".$recent5;
			echo "<br>".$recent6;
			echo "</div>";
		?>
		<!-- Load jquery -->
		<script src="jquery-2.1.4.min.js"></script>
		<script src="jquery.lettering.js"></script>
		<script src="jquery.textillate.js"></script>

		<!-- <div class="footer">
			<p>TFFC's Extra Life Donation Tracker</p>
		</div> -->
	</body>
</html>
