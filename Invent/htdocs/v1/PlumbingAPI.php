<?php
/*
    Plumbing Supply House API -- PHP Plumbing inc.
    This script provides a RESTful API interface for a web application
 
    Input:
        $_GET['format'] = [ json | html | xml ]
        $_GET['method'] = []
 
    Output: A formatted HTTP response
 
    Author: Michael Stromer
*/
 
// ** Initialize variables and functions ** //
 
/**
 * Deliver HTTP Response
 * @param string $format The desired HTTP response content type: [json, html, xml]
 * @param string $api_response The desired HTTP response data
 * @return void
 **/
function deliver_response($format, $api_response){
 
    // Define HTTP responses //
    $http_response_code = array(
        200 => 'OK',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found'
    );
 
    // Set HTTP Response //
    header('HTTP/1.1 '.$api_response['status'].' '.$http_response_code[ $api_response['status'] ]);
 
    // Process different content types //
    if( strcasecmp($format,'json') == 0 ){
 
        // Set HTTP Response Content Type //
        header('Content-Type: application/json; charset=utf-8');
 
        // Format data into a JSON response //
        $json_response = json_encode($api_response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
 
        // Deliver formatted data //
        echo $json_response;
 
    }elseif( strcasecmp($format,'xml') == 0 ){
 
        // Set HTTP Response Content Type //
        header('Content-Type: application/xml; charset=utf-8');
        
        // initializing or creating array //
		$data = $api_response['data']; 

		// Format data into an XML response //
		$xml = '<?xml version="1.0" encoding="UTF-8" ?>' . "\n";
		arrayToXml($data, $xml);
		
		// Deliver formatted data //
		echo $xml;
 
    }else{
 
        // Set HTTP Response Content Type //
        header('Content-Type: text/html; charset=utf-8');
 
        // initializing ro creating array //
        $data = $api_response['data'];
        
        $payload = '';
        $html = '';
        if (is_array($data)) {
        	arrayToHTML($data, $html);
        	$payload = $html;
        }
        else {
    	 $payload = $data;
        }
        
        // Deliver formatted data //
        echo $payload;
    }
 
    // End script process //
    exit;
}

/**
 * Returns Copper Pipes and Fittings Inventory for the specified format.
 * @return Array of entire inventory.
 **/
function copper_pipes_and_fittings_inventory() {
	return array(
		'0' => array(
			'id' => 'CP12010',
			'name' => 'Adrian Brody',
			'image' => 'http://localhost:8888/assets/man1.png',
			'description' => 'Computer Science, Class of 2017'),
		'1' => array(
			'id' => 'CP12020',
			'name' => 'Alex Phoenix',
			'image' => 'http://localhost:8888/assets/man2.png',
			'description' => 'Philosophy, Class of 2015'),
		'2' => array(
			'id' => 'CP12030',
			'name' => 'Alexandra Locket',
			'image' => 'http://localhost:8888/assets/woman1.png',
			'description' => 'Social Work, Class of 2015'),
		'3' => array(
			'id' => 'CP12040',
			'name' => 'Brian Winter',
			'image' => 'http://localhost:8888/assets/man3.png',
			'description' => 'Law, Class of 2014'),
		'4' => array(
			'id' => 'CP13010',
			'name' => 'Cameron Wolf',
			'image' => 'http://localhost:8888/assets/man4.png',
			'description' => 'Sports Marketing, Class of 2016'),
		'5' => array(
			'id' => 'CP13020',
			'name' => 'Celine Guerro',
			'image' => 'http://localhost:8888/assets/woman2.png',
			'description' => 'Engineering, Class of 2015'),
		'6' => array(
			'id' => 'CP13030',
			'name' => 'Frank Fitzgerald',
			'image' => 'http://localhost:8888/assets/man5.png',
			'description' => 'Economics, Class of 2015'),
		'7' => array(
			'id' => 'CP13040',
			'name' => 'Josh Geisler',
			'image' => 'http://localhost:8888/assets/man6.png',
			'description' => 'Finance, Class of 2016'),
		'8' => array(
			'id' => 'CP14010',
			'name' => 'Jennifer Hare',
			'image' => 'http://localhost:8888/assets/woman3.png',
			'description' => 'Biology, Class of 2017'),
		'9' => array(
			'id' => 'CP14020',
			'name' => 'Kalman Victor',
			'image' => 'http://localhost:8888/assets/man7.png',
			'description' => 'Psychology, Class of 2016'),
		'10' => array(
			'id' => 'CP14030',
			'name' => 'Marlee Tavlin',
			'image' => 'woman5.png',
			'description' => 'Social Work, Class of 2015'),
		'11' => array(
			'id' => 'CP14040',
			'name' => 'Saul Ender',
			'image' => 'http://localhost:8888/assets/man8.png',
			'description' => 'Drama, Class of 2013'),	
    );
}

/**
 * Returns Plumbing Tools Inventory for the specified format.
 * @return Array of entire inventory.
 **/
function plumbing_tools_inventory() {
	return array(
		'0' => array(
			'id' => 'PT12010',
			'name' => 'Andrew Ash',
			'image' => 'http://localhost:8888/assets/man1.png',
			'description' => 'Psychology - Science of Happiness.'),
		'1' => array(
			'id' => 'PT12020',
			'name' => 'Brad Miller',
			'image' => 'http://localhost:8888/assets/man2.png',
			'description' => 'Computer Science - CSCI-UA 101'),
		'2' => array(
			'id' => 'PT12030',
			'name' => 'Christina Spector',
			'image' => 'http://localhost:8888/assets/woman1.png',
			'description' => 'Biology - Organic Chemistry'),
		'3' => array(
			'id' => 'PT12040',
			'name' => 'Damian Parsons',
			'image' => 'http://localhost:8888/assets/man3.png',
			'description' => 'Music - Guitar'),
		'4' => array(
			'id' => 'PT13010',
			'name' => 'Eddie Isaacs',
			'image' => 'http://localhost:8888/assets/man4.png',
			'description' => 'English - Literature'),
		'5' => array(
			'id' => 'PT13020',
			'name' => 'Freddy Flamingo',
			'image' => 'http://localhost:8888/assets/man8.png',
			'description' => 'Writing - Creative Writing'),
		'6' => array(
			'id' => 'PT13030',
			'name' => 'Gertrude Gordon',
			'image' => 'http://localhost:8888/assets/woman2.png',
			'description' => 'Journalism - Investigative Journalism'),
		'7' => array(
			'id' => 'PT13040',
			'name' => 'Hannah Harris',
			'image' => 'http://localhost:8888/assets/woman3.png',
			'description' => 'Art History - Intro to Art History'),
		'8' => array(
			'id' => 'PT14010',
			'name' => 'Iggy Waters',
			'image' => 'http://localhost:8888/assets/man2.png',
			'description' => 'Psychology - Perception'),
		'9' => array(
			'id' => 'PT14020',
			'name' => 'Reggie Keys',
			'image' => 'http://localhost:8888/assets/man4.png',
			'description' => 'Economics - Urban Economics'),
		'10' => array(
			'id' => 'PT14030',
			'name' => 'Sarah Catan',
			'image' => 'http://localhost:8888/assets/woman4.png',
			'description' => 'Drama - Film Studies'),
		'11' => array(
			'id' => 'PT14040',
			'name' => 'Tucker Shane',
			'image' => 'http://localhost:8888/assets/man5.png',
			'description' => 'Anatomy - Physiology')	
    );
}

/**
 * Returns Plumbing Tools Inventory without description.
 * @return Array of entire inventory without description.
 **/
function plumbing_tools_inventory_without_description() {

	// pull our entire inventory of plumbing tools //
	$inventory = plumbing_tools_inventory();
	
	// container where we rebuild our inventory of plumbing tools with omitted description //
	$inventory_without_details = array();
	
	// iterate through our inventory and duplicate all item attributes except for thier description //
	foreach ($inventory as $key=>$value) {
		if (is_array($value)) {
			$inventory_item = array();
			foreach ($value as $subkey=>$subvalue) {
				if ( strcasecmp($subkey,'description') != 0 )
					$inventory_item[$subkey] = $subvalue;
			}
			$inventory_without_details[$key] = $inventory_item;
		}
	}
	return $inventory_without_details;	
}

/**
 * Returns Plumbing Tools Inventory without description.
 * @return Array of entire inventory without description.
 **/
function copper_pipes_and_fittings_inventory_without_description() {

	// pull our entire inventory of copper pipes and fittings //
	$inventory = copper_pipes_and_fittings_inventory();
	
	// container where we duplicate our inventory of copper pipes and fittings with omitted description //
	$inventory_without_details = array();
	
	// iterate through our inventory and duplicate all item attributes except for their description //
	foreach ($inventory as $key=>$value) {
		if (is_array($value)) {
			$inventory_item = array();
			foreach ($value as $subkey=>$subvalue) {
				if ( strcasecmp($subkey,'description') != 0 )
					$inventory_item[$subkey] = $subvalue;
			}
			$inventory_without_details[$key] = $inventory_item;
		}
	}
	return $inventory_without_details;	
}

/**
 * Returns Plumbing Tool details.
 * @param $item_id The details for the desired item with id.
 * @return Array of item details. An empty array is returned if no item with the provided id is found.
 **/
function plumbing_tool_item_details($item_id) {

	// pull our entire inventory of plumbing tools //
	$inventory = plumbing_tools_inventory();
	
	// container for item matching the provided item_id //
	$inventory_item = array();
	
	// iterate through our inventory and find the requested item //
	foreach ($inventory as $key=>$value) {
		if (is_array($value) && strcasecmp($value['id'], $item_id) == 0) {
			foreach ($value as $subkey=>$subvalue) {
					$inventory_item[$subkey] = $subvalue;
			}
			break;
		}
	}
	return $inventory_item;
}

/**
 * Returns Copper pipe or fitting details.
 * @param $item_id The details for the desired item with id.
 * @return Array of item details. An empty array is returned if no item with the provided id is found.
 **/
function copper_pipe_or_fitting_item_details($item_id) {

	// pull our entire inventory of copper pipes and fittings //
	$inventory = copper_pipes_and_fittings_inventory();
	
	// container for item matching the provided item_id //
	$inventory_item = array();
	
	// iterate through our inventory and find the requested item //
	foreach ($inventory as $key=>$value) {
		if (is_array($value) && strcasecmp($value['id'], $item_id) == 0) {
			foreach ($value as $subkey=>$subvalue) {
					$inventory_item[$subkey] = $subvalue;
			}
			break;
		}
	}
	return $inventory_item;
}

/**
 * Function returns XML string for input associative array.
 * @param Array $array Input associative array
 * @param String $wrap Wrapping tag
 * @param Boolean $upper To set tags in uppercase
 *
 * Note: Function is an adaptation from -- http://www.redips.net/php/convert-array-to-xml/ 
 */
function arrayToXml($array, &$xml = '', $wrap='DATA', $upper=true) {

    // wrap XML with $wrap TAG //
    if ($wrap != null) {
        $xml .= "<$wrap>\n";
    }
    // main loop //
    foreach ($array as $key=>$value) {
    
    	if(is_array($value)) {
    		// recursive call //
    		arrayToXml($value, $xml,'ITEM');
    	} else {
    		// set tags in uppercase if needed //
        	if ($upper == true) {
            	$key = strtoupper($key);
        	}
        	// append to XML string //
        	$xml .= "<$key>" . htmlspecialchars(trim($value)) . "</$key>";
    	}
    }
    // close tag if needed //
    if ($wrap != null) {
        $xml .= "</$wrap>\n";
    }
}

/**
 * Function returns HTML string for input associative array.
 * @param Array $array Input associative array
 * @param String $tag Wrapping tag
 *
 * Note: Function is an adaptation from -- http://www.redips.net/php/convert-array-to-xml/ 
 */
function arrayToHTML($array, &$html, $tag) {

	// wrap html with $tag //
    if ($tag != null) {
        $html .= "<HTML>\n";
    }
    // main loop //
    foreach ($array as $key=>$value) {
    
    	if(is_array($value)) {
    		// recursive call //
    		arrayToHTML($value, $html,'h1');
    	} else {
    		// set tags in uppercase if needed //
        	if ($upper == true) {
            	$key = strtoupper($key);
        	}
        	// append to XML string //
        	$html .= "<$key>" . strtoupper($key) . ' : ' . htmlspecialchars(trim($value)) . "</$key><br>";
    	}
    }
    // close tag if needed //
    if ($tag != null) {
        $html .= "</HTML>\n";
    }
}	
 
// Define API response codes and their related HTTP response //
$api_response_code = array(
    0 => array('HTTP Response' => 400, 'Message' => 'Unknown Error'),
    1 => array('HTTP Response' => 200, 'Message' => 'Success'),
    2 => array('HTTP Response' => 403, 'Message' => 'HTTPS Required'),
    3 => array('HTTP Response' => 401, 'Message' => 'Authentication Required'),
    4 => array('HTTP Response' => 401, 'Message' => 'Authentication Failed'),
    5 => array('HTTP Response' => 404, 'Message' => 'Invalid Request'),
    6 => array('HTTP Response' => 400, 'Message' => 'Invalid Response Format')
);
 
// Set default HTTP response of 'resource not found' //
$response['code'] = 0;
$response['status'] = 404;
$response['data'] = NULL;
 
// ** Process Request ** //
 
// Copper Pipes and Fittings API //
if( strcasecmp($_GET['method'],'copper_pipes_and_fittings') == 0){

	// build payload //
    $response['code'] = 1;
    $response['api_version'] = '1.0.0';
    $response['status'] = $api_response_code[ $response['code'] ]['HTTP Response'];
    
    // if an 'item_id' was provided then return details for that item //
    if ( $_GET['item_id'] ) {
    	$response['item_id'] = strtoupper($_GET['item_id']);
    	$response['data'] = copper_pipe_or_fitting_item_details(strtoupper($_GET['item_id']));
    }
    // else return our entire inventory of copper pipes and fittings //
    else {
    	$response['data'] = copper_pipes_and_fittings_inventory_without_description();
    }
}
// Plumbing Tools API //
else if( strcasecmp($_GET['method'],'plumbing_tools') == 0){

	// build payload
    $response['code'] = 1;
    $response['api_version'] = '1.0.0';
    $response['status'] = $api_response_code[ $response['code'] ]['HTTP Response'];
    
    // if an 'item_id' was provided then return details for that item //
    if ( $_GET['item_id'] ) {
    	$response['item_id'] = strtoupper($_GET['item_id']);
    	$response['data'] = plumbing_tool_item_details(strtoupper($_GET['item_id']));
    }
    // else return our entire inventory of plumbing tools //
    else {
    	$response['data'] = plumbing_tools_inventory_without_description();
    }
}
 
// ** Deliver Response ** //
 
// Return Response to browser //
deliver_response($_GET['format'], $response);
 
?>
