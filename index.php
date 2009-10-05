<?php
  ini_set('memory_limit', '100M');
  // Include PHP SDK for authorization and making requests to API endpoints
  require('../yosdk/lib/Yahoo.inc');
  // Library for formatting XML and JSON Responses
  include("prettify.inc");
  // Includes the API URIs
  include("api.inc");
  // Contains Consumer Key, Consumer Secret, and AppID
  include("keys.inc");
  // Create a session w/ keys, callback URL and cookie session store 
  $session = YahooSession::requireSession($api_key, $shared_secret, $appid, "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'], new CookieSessionStore(),
			$_GET['oauth_verifier']);
?>
    <head>
    <?php include("style.css"); ?> 
    </head>
    <body style='margin-left: 20%;'>
  		<div id='main'>

				<h2 style='margin-left: 22%;'>Yahoo! Social API Explorer</h3>

        <!-- Links for Profiles API in first column 'profiles'. -->
				<div id='profiles'>
				<h4>Profiles API</h4>
				<ul>
				<li><a href='?api=profile'>Profiles</a></li>
				<li><a href='?api=tinyusercard'>Tinyusercard</a></li>
				<li><a href='?api=usercard'>Usercard</a></li>
				<li><a href='?api=contactcard'>Contactcard</a></li>
        <li><a href='?api=introspective_guid'>Introspective GUID</a></li>
				<li><a href='?api=idcard'>IDCard</a></li>
				<li><a href='?api=schools'>Schools</a></li>
				<li><a href='?api=works'>Works</a></li>
				<li><a href='?api=images'>Images</a></li>
				</ul>
				</div>
 
        <!-- Links for Connections API in 2nd column 'connections'. -->
				<div id='connections'>
				<h4>Connections API</h4>
				<ul>
				<li><a href='?api=connections'>Connections</a>
				</ul>
				</div>

        <!-- Links for Contacts API in 3rd column 'contacts'. -->
				<div id='contacts'>
				<h4>Contacts API</h4>
				<ul>
				<li><a href='?api=contacts'>Contacts</a></li>
				<li><a href='?api=contacts_tinyusercard'>Contacts Tinyusercard</a></li>
        <li><a href='?api=contacts_bucket'>ContactBuckets</a></li>
				<li><a href='?api=categories'>Categories</a></li>
				</ul>
				</div>

        <!-- Links for Status API in 4th column 'status'. -->
				<div id='status'>
				<h4>Status API</h4>
				<ul>
				<li><a href='?api=status'>Status</a></li>
				</ul>
				</div>
       
        <!-- Links for Updates API in 5th column 'updates' -->
				<div id='updates'>
				<h4>Updates API</h4>
				<ul>
				<li><a href='?api=updates'>Updates</a></li>
				<li><a href='?api=updates_connections'>Updates for Connections</a></li>
				</ul>
				</div>

        <!-- Text box for manually entering a YSP API URI. -->
				<div id='enter_api' style='margin-top: 285px;'>
				<form name='enter_uri' href='api_tester.php' method='GET'>
				Enter URI:
				<input name='enter_uri' type='text' size='50'/>
				<p>
				<input type='submit' value='Make Request' name='request' />
				</p>
				<p>
				</form>
				</div>

        <!-- Section for including information about the user and API being called. 
             * GUID
             * URI
             * ??--other information?
       -->
				<div id='api_info'>
				</div>
				</div>
<?php
    // User has clicked on link, start making request to API
  	if(!empty($_GET['api'])){
       // Obtain the selected API and build URI
		   $api = $_GET['api'];
       if($_GET['api']=='introspective_guid'){
         $uri= $INTROSPECTIVE_GUID;
       }else{
		     $uri = $BASE_URL . $socdir[$api];
       }
   }else if(!empty($_GET['enter_uri'])){
     // User has manually entered a URI
     $uri = strstr($_GET['enter_uri'],"http") ? $_GET['enter_uri'] : 'http://' . $_GET["enter_uri"];
  }
  // URI has been set. Be sure to parse query parameters for URIs 
  // that were manually typed in and are using the 'view' parameter.
  if(isset($uri)){
     $original_uri = $uri;
     list($uri,$query)=explode("?",$uri);
     $query_params = array();
     if(!empty($query)){
      if(strpos($query,"&")){
        $nv_pairs = explode('&',$query);
        while(list($key,$value)=each(explode("=",$nv_pairs))){
          $query_params[$key]=$value;
        };
      }else{
        list($key,$value)=explode('=',$query);
        $query_params[$key]=$value;
     }
    }
			
        $tokens = array('{guid}');
        $values = array($session->guid, '{cid}', '{fid}');
        $endpoint = str_replace('{guid}', $session->guid, $uri);
        $original_endpoint = str_replace('{guid}', $session->guid, $original_uri);
?>
  <script>
    document.getElementById('api_info').innerHTML += "<b>GUID:</b> " + <?php echo '"' . $session->guid . '";'; ?>
    document.getElementById('api_info').innerHTML +="<br/><b>URI:</b> " + <?php echo '"' . $original_endpoint . '";'; ?>
  </script>
<?
$response = $session->client->get($endpoint,$query_params);
$query_params['format']='xml';
$response_xml = $session->client->get($endpoint, $query_params);
unset($_GET);
?>
<div id='results' style='margin-top: 10px; padding: 5px;'>
<hr />
<div id='xml_response'>
<h3>XML Response</h3>
<textarea id='xml_resp' style='border: 1px groove black; width: 650px; height: 200px; overflow: auto;' cols='80' rows='20'>
<?= xmlpp($response_xml['responseBody']);?></textarea>
</div>
<div id='json_response' style='display: block;'>
<h3>JSON Response</h3>
<textarea id='json_resp' style='border: 1px groove black; width: 650px; height: 200px; overflow: auto;' cols='80' rows='20'>
<?php echo json_format($response['responseBody']); ?>
<?php // echo "<pre>" . print_r($response['responseBody']) . "</pre>"; ?>
</textarea>
</div>
</div>
<script>
				function format_toggle()
				{
          if(document.getElementById('format_button').value == "JSON")
					{
						document.getElementById('json_response').style.display = 'inline';
						document.getElementById('xml_response').style.display = 'none';
 			      document.getElementById('format_button').value = " XML";
 			      document.getElementById('format_button').innerHTML = "See XML";
					}else { 
 			      document.getElementById('format_button').innerHTML = "See JSON";
 			      document.getElementById('format_button').value = "JSON";
						document.getElementById('xml_response').style.display = 'inline';
						document.getElementById('json_response').style.display = 'none';
				 }
				}
	  //document.getElementById('format_button').addEventListener('click',format_toggle(),false);
</script>
</body>
<?php
}
?>
