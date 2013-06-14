<?php
/*
 * PHP library for Mixpanel data API -- http://www.mixpanel.com/
 * Requires PHP 5.2 with JSON
 */

class Mixpanel
{
    private $api_url = 'http://mixpanel.com/api';
    private $version = '2.0';
    private $api_key;
    private $api_secret;
    
    public function __construct($api_key, $api_secret) {
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
    }
    
    public function request($methods, $params, $format='json') {
        // $end_point is an API end point such as events, properties, funnels, etc.
        // $method is an API method such as general, unique, average, etc.
        // $params is an associative array of parameters.
        // See http://mixpanel.com/api/docs/guides/api/

        if (!isset($params['api_key']))
            $params['api_key'] = $this->api_key;
        
        $params['format'] = $format;
        
        if (!isset($params['expire'])) {
            $current_utc_time = time() - date('Z');
            $params['expire'] = $current_utc_time + 600; // Default 10 minutes
        }
        
        $param_query = '';
        foreach ($params as $param => &$value) {
            if (is_array($value))
                $value = json_encode($value);
            $param_query .= '&' . urlencode($param) . '=' . urlencode($value);
        }
        
        $sig = $this->signature($params);
        
        $uri = '/' . $this->version . '/' . join('/', $methods) . '/';
        $request_url = $uri . '?sig=' . $sig . $param_query;
        
        $curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $this->api_url . $request_url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl_handle);
        curl_close($curl_handle);
        
        return json_decode($data);
    }
    
    private function signature($params) {
        ksort($params);
        $param_string ='';
        foreach ($params as $param => $value) {
            $param_string .= $param . '=' . $value;
        }
        
        return md5($param_string . $this->api_secret);
    }
}


// Mixpanel authentication data
$api_key = '123314323b5452bqgfyeffgwedfcwdf6gfw';
$api_secret = 'q2sdffc314x4tedcseagf64fwfddw53gt3';

//Create Mixpanel Object
$mp = new Mixpanel($api_key, $api_secret);

// user to get information for
$user_email = 'user@mail.com' ;


// Get access by lesson
$endpoint = array('segmentation');
$parameters = array( 
    'event'     => 'Accessed lesson content'
  , 'from_date' => '2013-06-01'
  , 'to_date'   => '2013-06-30'
  , 'unit'      => 'week'
  , 'on'        => 'properties["lesson"]'
  , 'where'     => 'properties["Email"] == "'.$user_email.'" '
);
$access = $mp->request($endpoint,$parameters)->data->values;

// Get total access data
$endpoint = array('segmentation');
$parameters = array( 
    'event'     => 'Accessed lesson content'
  , 'from_date' => '2013-06-01'
  , 'to_date'   => '2013-06-30'
  , 'unit'      => 'month'
  , 'where'     => 'properties["Email"] == "'.$user_email.'"'
  , 'type'      => 'general'
);
$totalAccess = $mp->request($endpoint,$parameters)->data->values->{"Accessed lesson content"};
$totAsArray = (array)($totalAccess);

//Getting user info
$endpoint = array('engage');
$parameters = array(
  'where' => 'properties["$email"] == "'.$user_email.'" '
);
$u = $mp->request($endpoint,$parameters);
$u_email = $u->results[0]->{'$properties'}->{'$email'};
$u_name  = $u->results[0]->{'$properties'}->{'$name'};
$u_last  = $u->results[0]->{'$properties'}->{'$last_seen'};




$first = true;
$_first = true;
echo '<script type="text/javascript">';
echo 'var chart=[';

foreach($access as $lesson => $_access)  {
  if($_access){
    if(!$first) echo ",";
    echo '{label:"' . $lesson . '", data:[';
    $array_access = (array)$_access;
    ksort($array_access);

    foreach ($array_access as $date => $count) {
        $date = strtotime($date)*1000;
        if(!$_first) echo ",";
        echo '['.$date.','.$count.']';
        $_first = false;
    }
    $_first = true;
    echo ']';
  }
  echo '}';
  $first = false;
}
echo ']';
echo '</script>';

?>

