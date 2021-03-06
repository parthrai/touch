<!DOCTYPE HTML>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Point Awarder</title>

	<!-- Scripts -->
	<script src="/points-assets/js/jquery-3.2.1.min.js"></script>
	<script src="/points-assets/js/functions.js"></script>
	<script src="/points-assets/js/jquery.cycle2.min.js"></script>

	<!-- Tyepkit -->
	<script src="https://use.typekit.net/oae8zyf.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>

	<!-- CSS -->
	<link rel="stylesheet" href="/points-assets/css/styles.css" />

</head>


<body>

<header>

</header>

<h1 class="welcome"> Hello {{ Auth::user()->email  }} </h1>
	<input type="hidden" id="user_id" value={{ Auth::user()->id  }} />
	
<div class="container clearfix">	

<!-- Carousel Container for all slides on video wall -->
<div id="pointGiver" data-cycle-fx="scrollHorz" data-cycle-manual-speed="400" data-cycle-slides="> div">


	<div id="chooseType" class="slide" data-cycle-timeout="0">

		<h2>Award points to:</h2>

		<a href="#" id="individualButton" class="primaryButton">Individual</a>

		<a href="#" id="teamButton" class="primaryButton">Team</a>

	</div><!-- End Person or team? -->


	<div id="choosePerson" class="slide" data-cycle-timeout="0">

		<h2>Enter the recipients full name:</h2>

		<input id="recipientName" type="text" name="recipientName" placeholder="Firstname Lastname">

		<a href="#" id="nextButton" class="primaryButton">Next</a>

	</div><!-- Person -->


	<div id="chooseATeam" class="slide" data-cycle-timeout="0">

		<h2>Choose a team</h2>

		<div id="teamBlue" class="teamRow rowAlt top" data-team="blue">
			<span class="rank"></span>
			<span class="icon"></span>
			<span class="teamName">Team Blue</span>
		</div>
		<div id="teamPurple" class="teamRow" data-team="purple">
			<span class="rank"></span>
			<span class="icon"></span>
			<span class="teamName">Team Purple</span>
		</div>
		<div id="teamGrey" class="teamRow rowAlt" data-team="grey">
			<span class="rank"></span>
			<span class="icon"></span>
			<span class="teamName">Team Grey</span>
		</div>
		<div id="teamRed" class="teamRow" data-team="red">
			<span class="rank"></span>
			<span class="icon"></span>
			<span class="teamName">Team Red</span>
		</div>
		<div id="teamTeal" class="teamRow rowAlt" data-team="teal">
			<span class="rank"></span>
			<span class="icon"></span>
			<span class="teamName">Team Teal</span>
		</div>

	</div><!-- End Choose A Team -->


	<div id="choosePoints" class="slide" data-cycle-timeout="0">

		<h2>Select a point denomination</h2>

		<div id="points200" class="pointRow rowAlt top" data-points=200>
			<span class="pointValue">200 Points</span>
		</div>
		<div id="points500" class="pointRow" data-points=500>
			<span class="pointValue">500 Points</span>
		</div>
		<div id="points1000" class="pointRow rowAlt" data-points=1000>
			<span class="pointValue">1000 Points</span>
		</div>
		<div id="points2500" class="pointRow" data-points=2500>
			<span class="pointValue">2500 Points</span>
		</div>
		<div id="points5000" class="pointRow rowAlt" data-points=5000>
			<span class="pointValue">5000 Points</span>
		</div>

	</div><!-- End Choose Points -->

</div>

<div class="buttonContainer">
	<!-- Reset Button -->
	<a href="#" id="resetButton" class="secondaryButton">Reset</a>
	
	<!-- Submit button -->
	<a href="#" id="awardPointsButton" class="primaryButton">Award Points</a>
</div>


</body>

</div>
</html>
