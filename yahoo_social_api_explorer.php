<?php

  // Set memory limit to handle large responses for updates of connections
  ini_set('memory_limit', '100M');
  // Get the Yahoo! Social SDK for PHP: http://github.com/yahoo/yos-social-php
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
    <title>Yahoo! Social API Explorer</title>
   <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/reset/reset-min.css"> 
   <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/base/base-min.css"> 
   <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/fonts/fonts-min.css" />
   <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/container/assets/skins/sam/container.css" />
	 <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/tabview/assets/skins/sam/tabview.css"> 
   <script type="text/javascript" src="http://yui.yahooapis.com/2.8.0r4/build/yahoo-dom-event/yahoo-dom-event.js"></script>
   <script type="text/javascript" src="http://yui.yahooapis.com/2.8.0r4/build/container/container-min.js"></script>
   <script type="text/javascript" src="http://yui.yahooapis.com/2.8.0r4/build/element/element-min.js"></script> 
	 <script type="text/javascript" src="http://yui.yahooapis.com/2.8.0r4/build/connection/connection-min.js"></script> 
   <script type="text/javascript" src="http://yui.yahooapis.com/2.8.0r4/build/tabview/tabview-min.js"></script>
    <?php include("style.css"); ?> 
    </head>
    <body class="yui-skin-sam">
  		<div id='main'>

				<h2 id='explorer_heading'>Yahoo! Social API Explorer</h3>

        <!-- Links for Profiles API in first column 'profiles'. -->
				<div id='profiles'>
				<h4 id='profiles_title'><a href='http://developer.yahoo.com/social/rest_api_guide/social_dir_api.html#social_dir_intro-profiles' target='_blank'>
        Profiles API</a></h4>
				<ul>
				<li><a href='?api=profile'>Profile</a></li>
				<li><a href='?api=tinyusercard'>Tinyusercard</a></li>
				<li><a href='?api=usercard'>Usercard</a></li>
        <li><a href='?api=introspective_guid'>Introspective GUID</a></li>
				<li><a href='?api=idcard'>IDCard</a></li>
				<li><a href='?api=schools'>Schools</a></li>
				<li><a href='?api=works'>Works</a></li>
				<li><a href='?api=images'>Images</a></li>
				</ul>
				</div>
 
        <!-- Links for Connections API in 2nd column 'connections'. -->
				<div id='connections'>
				<h4><a id='connections_title' href='http://developer.yahoo.com/social/rest_api_guide/social_dir_api.html#social_dir_intro-connections'>Connections API</a></h4>
				<ul>
				<li><a href='?api=connections'>Connections</a>
				</ul>
				</div>

        <!-- Links for Contacts API in 3rd column 'contacts'. -->
				<div id='contacts'>
				<h4 id='contacts_title'><a href="http://developer.yahoo.com/social/rest_api_guide/contacts-resource.html" target='blank'>Contacts API</a></h4>
				<ul>
				<li><a href='?api=contacts'>Contacts</a></li>
				<li><a href='?api=contacts_tinyusercard'>Contacts: Tinyusercard</a></li>
        <li><a href='?api=contacts_bucket'>ContactBuckets</a></li>
				<li><a href='?api=categories'>Categories</a></li>
				</ul>
				</div>

        <!-- Links for Status API in 4th column 'status'. -->
				<div id='status'>
				<h4 id='status_title'><a href="http://developer.yahoo.com/social/rest_api_guide/status_api.html" target='_blank'>Status API</a></h4>
				<ul>
				<li><a href='?api=status'>Status</a></li>
				</ul>
				</div>
       
        <!-- Links for Updates API in 5th column 'updates' -->
				<div id='updates'>
				<h4 id='updates_title'><a href="http://developer.yahoo.com/social/rest_api_guide/updates_api.html" target='_blank'>Updates API</a></h4>
				<ul>
				<li><a href='?api=updates'>Updates</a></li>
				<li><a href='?api=updates_connections'>Updates for Connections</a></li>
				</ul>
				</div>

        <!-- Section for including information about the user and API being called. 
             * GUID
             * URI
             * ??--other information?
       -->
				<div id='api_info'>
				</div>
				</div>
        <!-- Text box for manually entering a YSP API URI. -->
        <div id='enter_api'>
        <b id='guid'><a href="http://developer.yahoo.com/social/rest_api_guide/web-services-guids.html" target="_blank">GUID:</a></b> <?php echo " $session->guid"; ?>
        <form name='enter_uri' href='api_tester.php' method='GET'>
        <b id='uri'><a href='http://developer.yahoo.com/social/rest_api_guide/uri-general.html#singleton-collection-resources' target='_blank'>URI:</a>&nbsp;&nbsp;</b>
        <input name='uri_input' type='text' size='100'/> 
        <p>
        <input class='submit_button' type='submit' value='Make Request' name='request' />
        </p>
        <p>
        </form>
        </div>
    <script type="text/javascript" src="tooltips.js"></script>
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
    }else if(!empty($_GET['uri_input'])){
     // User has manually entered a URI
     $uri = strstr($_GET['uri_input'],"http") ? $_GET['uri_input'] : 'http://' . $_GET["uri_input"];
     $api = basename($uri);
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
<script type='text/javascript'>
  document.enter_uri.uri_input.value = "<? echo $original_endpoint; ?>";
</script>
<?
$response = $session->client->get($endpoint,$query_params);
$query_params['format']='xml';
$response_xml = $session->client->get($endpoint, $query_params);
unset($_GET);
?>
<div id='results' class='yui-navset'>
<ul class='yui-nav'>
<li class='selected'><a href="#xml"><em>XML</em></a></li>
<li><a href='#json'><em>JSON</em></a></li>
<li><a href='#request'><em>Request Header</em></a></li>
<li><a href='#response'><em>Response Header</em></a></li>
<?php if(file_exists("about_apis/$api.html")){
?>
<li><a href='#about'><em>About <?php echo $socdir_titles[$api];?></em></a></li>
<?
}
?>
</ul>
<div class='yui-content'>
<div id='xml'>
<pre>
<?php
     echo wordwrap(htmlspecialchars(xmlpp($response_xml['responseBody'])),100,"\n",true);
?>
</pre>
</div>
<div id='json'>
<pre>
<?php echo htmlspecialchars(json_format($response['responseBody'])); ?>
</pre>
</div>
<div id='request'>
<pre>
<?php
  if($response_xml){
      echo "HTTP Method: " . $response_xml['method'] . "\n\n";
      echo "HTTP Status Code: " . $response_xml['code'] . "\n\n";
  }else{
     display_error("No request header is available.","text");
  }
  if($response_xml['requestHeaders']){
     if($response_xml['requestHeaders']){
       foreach($response_xml['requestHeaders'] as $field){
          if(strpos($field,",")!=false){
            $fields = explode(',',$field);
            foreach($fields as $line){
              echo wordwrap("$line\n",100,"\n",true) . "\n";
           }
         }else {
          echo wordwrap("$field\n",100,"\n",true) . "\n";
       }
     }
    }
  }
?>
</pre>
</div>
<div id='response'>
<pre>
<?php
  if($response_xml['responseHeaders']){
    foreach($response_xml['responseHeaders'] as $field => $value){
    echo "$field: $value\n\n";
   }
  }
  else {
    display_error("No response header is available.","text");
  }
?>
</pre>
</div>
<?php if(file_exists("about_apis/$api.html")){
?>
<div id='about'>
<?php include('about_apis/' . $api . ".html"); ?>
</div>
</div>
<?
}
?>
<?php
}else{
?>
<div id='results' class='yui-navset'>
<ul class='yui-nav'>
<li class='selected'><a href='#about'><em>About the Yahoo! Social API Explorer</em></a></li>
</ul>
<div class='yui-content'>
<div id='about'>
  <p>
  This API explorer lets you make HTTP GET calls to the Yahoo! Social APIs by clicking on links. You can then view
  the request and response headers and the returned responses in XML or JSON.
 </p>
  <p>
   Use the Yahoo! Social API Explorer to learn the following:
   <ul>
     <li>Find out about the various APIs by mousing over the API names, GUID, and URI to 
       view tooltips that give you a quick summary. Click on the hotspots to see the documentation.</li>
     <li>URI Syntax: when you click on a link to an API, the URI syntax is shown in the URI text field.</li>
     <li>To get detailed information about an API, click on the "About" tab. For example, after you have made
       a call to the Profiles API, the tab "About Profiles" will appear. Click the tab to learn more about Profiles.</li>
   </ul>
 </div>
</div>
<?
}
?>
<script>
(function() {
    var tabView = new YAHOO.widget.TabView('results');
})();
</script>
