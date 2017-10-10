<?php

/**
 * Configuration files that holds the image settings for each project
 * SD = Screendoor
 * Get data from Screendoor API:
 * http://dobtco.github.io/screendoor-api-docs/
 * Sample config:
 * 	'2916' =>  array ( 																					// Project Identifier (if Screendoor is used, then use SD project id)
		'project' 				=> '#Africa4Her 2016',										// project name
		'prefix'					=> 'yali_africa2016_',										// prefix to append to the saved image
		'src_path'				=> '/images/yali_africa4her_bkgrd.png',		// image src path
		'save_path'				=> '/generated-images/',									// folder to save image in
		'font'	  				=> 'Lato-Regular.ttf',										// default proj font family of dynamic text (file saved in fonts dir)
		'font_size'				=> 40,								    								// default font size of dynamic text
		'color'						=> '#333333',															// default font color of dynamic text
		'align'						=> 'center',						    							// default text align of dynamic text
		'line_max_chars' 	=> 31,																		// max number of characters per line before text wraps
		'line_height' 		=> 62,																		// height of text line (sapce between lines)
		'text'						=> array (																// text content
			array (
				'content' 		=> 'FIELD', 															// use 'FIELD' string for runtime content & provide SD field_id
				'field_id' 		=> 35173, 																// SD field ID
				'x'		  			=> 428,																		// x position of text
				'y'		  			=> 250,																		// y position of text
				'color'				=> '#218b43'															// overide default color
			),
			array (
				'content' 		=> 'My name is',
				'x'		  			=> 40,
				'y'		  			=> 75,
				'color'				=> '#314071'
			),
			array (
				'content' 		=> 'FIELD',
				'field_id' 		=> 35164,
				'x'		  			=> 428,
				'y'		  			=> 385,
				'color'				=> '#218b43'
			),
			array (
				'content' 		=> 'FIELD',
				'field_id' 		=> 35170,
				'x'		  			=> 428,
				'y'		  			=> 426 ,
				'color'				=> '#bf202a',
				'font'				=> 'AvenirNext-Bold.ttf',
				'font_size' 	=> 24
			)
		)
	)
 */

return array(
	'ytili_certificate' 	=>  array (   					// Form that is sending certificate -- MUST match form key
		'prefix'					=> 'ytili_certificate_',
		'src_path'				=> 'images/ytili_certificate_bkgrd.jpg',
		'save_path'				=> '../../../uploads/sites/1/badges/ytili_certs/',
		'font'	  				=> 'fonts/RobotoCondensed-Regular.ttf',
		'font_size'				=> 65,
		'color'						=> '#085573',
		'align'						=> 'center',
		'line_max_chars' 	=> 40,
		'line_height' 		=> 42,
		'text'						=> array (
			array (
				'content' 		=> 'FIELD',
				'field_id'		=> 'course_name', 			// course name (formidable field key) -- MUST match
				'x'		  			=> 550,
				'y'		  			=> 300
			),
			array (
				'content' 		=> 'FIELD',
				'field_id'		=> 'full_name_course', 	// Name to appear on certificate (formidable field key)  -- MUST match
				'x'		  			=> 550,
				'y'		  			=> 520
			),
			array (
				'content' 		=> date("F j, Y"),      // Date, static field
				'x'		  			=> 300,
				'y'		  			=> 670,
				'font_size' 	=> 15
			)
		)
	)
);
