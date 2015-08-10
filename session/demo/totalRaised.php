<!doctype html>
<html>


  <!-- totalRaised.php is designed to work with tffc-layout -->


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
			p.raised em {
				font-style: normal;
			}
		</style>




		<!-- Refresh the page every two minutes to get data from Extra Life's website.
		-->
		<meta http-equiv="refresh" content="120">

	</head>
	<body>



		<!-- Recent Donations and Most Recent Message-->
    <?php
			// Use simple_html_dom.php
			require '../../assets/simple_html_dom.php';

			// Get html data from Extra Life's website
			$html = file_get_html('http://www.extra-life.org/index.cfm?fuseaction=widgets.300x250thermo&participantID=148534');

			// Find the first "em" tag from $html
			$raised = $html->find('em', 0);

			// Place $raised here
			echo "<p class='raised'>".$raised."</p>";
	?>


		<!-- <div class="footer">
			<p>TFFC's Extra Life Donation Tracker</p>
		</div> -->
	</body>
</html>
