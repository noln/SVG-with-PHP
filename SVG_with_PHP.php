<?php

	/**
	 * A PHP SVG-generating example: drawing a circle in SVG
	 * @package BlogExamples
	 * @author Matt Ashrafi
	 * @link : http://blog.matthewashrafi.com/2012/11/03/generating-svg-with-php/
	 * @version 1.01
	 */

	/* This whole script will draw a series of shapes within a single SVG structure. The 
	result (i.e. the whole file ending .php) can be treated as an image and inserted 
	into an HTML page as you would a PNG or JPG file:

		<img src="svg-with-php.php" alt="Some circles!"/>

	*/

	// To kick off the SVG document, we need to declare the page doctype, here it is.
	echo <<< HEREDOC
<svg xmlns="http://www.w3.org/2000/svg" version="1.1">
HEREDOC;

	/* Create an array to hold the values that we'll use to draw the shape.
	These will be passed to the drawing function as a parameter, hence the "_arr" as a
	reminder. */
	$circ_param_arr = Array();

	/* As I was writing this, the length of the variable started to annoy me, so here's a 
	finger-saver: */
	$cpa = $circl_param_arr;

	/* Here we're adding a couple of integers to the array, which will denote the centre-
	point of the circle we're going to draw. */
	$cpa["centre_x"] = 100;
	$cpa["centre_y"] = 75;
	/* I've made the Y value different to aid debug if the circle 
	doesn't end up where we expect it to be! Which shouldn't happen, but you know, neither
	should bugs. That's why they're bugs! */

	$cpa["radius"] = 100;	// ..of the circle, DWISOTT.

	$cpa["stroke"] = "black";
	/* This is the colour of the outline of the circle. This could be an RGB value if you 
	prefer, but it'll need to be in Hex, as rather than CSS-style rgb(..). */

	$cpa["stroke_width"] = 2; // DWISOTT

	$cpa["fill_colour"] = "red";
	/* This is the colour of the infilled part of the circle. */

	$circ_param_arr = $cpa;
	/* That reversed the finger-saver hack, to make the rest of the code more readable. 
	This might seem unnecessary, and if you're starting out in coding you'll probably 
	ignore this advice (as I did when I started out...) but whatever time you save now by 
	not making your variables short but intuitive, you'll lose when you come back to 
	maintain the code. This applies even more so if you're contributing to a team project;
	I've lost count of the number of times I've cursed the original developer, when 
	discovering a line like: if (exists($fpa)||(($dtbrg==13)%1)) ex_prfbr_rtn($dtbrg*9)

	Help your future self. Write readable code! </rant> */

	function drawCircleFromArr($circ_param_arr){

		$cx = 			$circ_param_arr["centre_x"];
		$cy = 			$circ_param_arr["centre_y"];
		$r = 			$circ_param_arr["radius"];
		$stroke = 		$circ_param_arr["stroke"];
		$stroke_width = $circ_param_arr["stroke_width"];
		$fill = 		$circ_param_arr["fill_colour"];

		$svg_circle = <<< HEREDOC
  <circle cx="$cx" cy="$cy" r="$r" stroke="$stroke"
  stroke-width="$stroke_width" fill="$fill" />
HEREDOC;

		echo $svg_circle;

	}

	/* Draw a circle with the $cpa array values we used earlier, as they'll still be 
	floating around the server's RAM somewhere. */
	drawCircleFromArr($cpa);

	/* That's all well and good if we want to draw a circle from values in an array, but 
	what if you just want to pass those variables into the function as individual values?
	We'll need another function, but as the hard work is already done, we can make use of 
	the first function when we do: */
	function drawCircleVars($cx, $cy, $r, $stroke, $stroke_width, $fill){
		$circle_param_arr = Array(
									"centre_x" => $cx,
									"centre_y" => $cy,
									"radius" => $r,
									"stroke" => $stroke,
									"stroke_width" => $stroke_width,
									"fill_colour" => $fill
								);

		drawCircleFromArr($circle_param_arr);
	}

	/* Now to tidy this operation up, it'd be good to have a catch-all function for if we 
	just want to draw a circle, and tweak the dimensions, colour and positioning later on.
	*/
	function drawSVGCircle($cx = 100, $cy = 80, $r = 40, $stroke = "black", 
		$stroke_width = 2, $fill = "yellow"){
		drawCircleVars($cx, $cy, $r, $stroke, $stroke_width, $fill);
	}

	// Draw a circle with all of the defaults.
	drawSVGCircle();

	/* Draw a circle to the right of that one, by just setting the $cx value. */
	drawSVGCircle(300);

	// Output the document close tag.
	echo "</svg>";

?>