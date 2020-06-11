<?php

// Define Slack application identifiers
// Even better is to put these in environment variables so you don't risk exposing
// them to the outer world (e.g. by committing to version control)
define( 'SLACK_CLIENT_ID', 'xx' );
define( 'SLACK_CLIENT_SECRET', 'xx' );
//$api_root = 'https://slack.com/api/oauth.access';
//$api_root = "https://slack.com/oauth/v2/authorize";
$api_root = "https://slack.com/api/oauth.v2.access";

function get_client_id() {
    // First, check if client ID is defined in a constant
    if ( defined( 'SLACK_CLIENT_ID' ) ) {
        return SLACK_CLIENT_ID;
    }
 
    // If no constant found, look for environment variable
    if ( getenv( 'SLACK_CLIENT_ID' ) ) {
        return getenv( 'SLACK_CLIENT_ID' );
    }
     
    // Not configured, return empty string
    return '';
}
 
/**
 * Returns the Slack client secret.
 * 
 * @return string   The client secret or empty string if not configured
 */
function get_client_secret() {
    // First, check if client secret is defined in a constant
    if ( defined( 'SLACK_CLIENT_SECRET' ) ) {
        return SLACK_CLIENT_SECRET;
    }
 
    // If no constant found, look for environment variable
    if ( getenv( 'SLACK_CLIENT_SECRET' ) ) {
        return getenv( 'SLACK_CLIENT_SECRET' );
    }
 
    // Not configured, return empty string
    return '';
}



$code = $_GET['code'];

function httpPost($url, $source)
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json'));
    //curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_POSTFIELDS,  array(
        'code' => $source,
        'client_id' => get_client_id(),
        'client_secret' => get_client_secret(),
        'redirect_uri' => "https://coinmarketrank.io/auth.php"
        ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

$response = json_decode(httpPost( $api_root ,$code ));
if ($response->ok) header('Location: https://app.slack.com/client/');
else echo $response." END";
         



?>