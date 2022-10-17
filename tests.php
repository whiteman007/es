
<?php
$url=$_SERVER["PHP_SELF"];
$param="t";
$base_url = strtok($url, '?');              // Get the base url
    $parsed_url = parse_url($url);              // Parse it 
    $query = $parsed_url['query'];              // Get the query string
    parse_str( $query, $parameters );           // Convert Parameters into array
    unset( $parameters[$param] );               // Delete the one you want
    $new_query = http_build_query($parameters); // Rebuilt query string
	$last=$base_url.'?'.$new_query;            // Finally url is ready
	//echo $last;
	//header('Location: '.$last);
  //exit;
  echo $base_url;
?>