<?php

  // Set memory limit to handle large responses for updates of connections
  ini_set('memory_limit', '100M');
  
  // Set error reporting only for fatal errors
  error_reporting(E_ERROR);

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
   session_start();
	 $session = YahooSession::requireSession($api_key, $shared_secret, $appid, "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'], null,
			$_GET['oauth_verifier']);
?>
   <html>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <head>
     <meta http-equiv="Content-type" content="text/html;charset=utf-8" />
     <title>Yahoo! Social API Explorer</title>
     <!-- Include stylesheets and JavaScript libraries from YUI -->
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
				<li><a href='?api=connections;start=0;count=5'>Connections: pagination</a>
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
    <?php
     // User has used form to make request
     if(!empty($_GET['uri_input'])){
       // User has manually entered a URI
       $uri = strstr($_GET['uri_input'],"http") ? $_GET['uri_input'] : 'http://' . $_GET["uri_input"];

       // Get API name for creating docs. 
       // If form was used to make request, get API name from URL.
       // If Singleton link was clicked, use query string for API name.
       if(!empty($_GET['api'])){
         $api = $_GET['api'];
       }else{
         $api = basename($uri);
       }
     }else if (!empty($_GET['api'])){ 
       // User has clicked on link, start making request to API
       // Parse matrix parameters for pagination, etc.
       if($count=strpos($_GET['api'],';')){
         $api = substr($_GET['api'],0,$count);
         $matrix_parms = strstr($_GET['api'],';');
       }
       else{
         // No matrix params, obtain the selected API and build URI
		     $api = $_GET['api'];
       } 
       if($api=='introspective_guid'){
         // Use /me/guid for GET call
         $uri= $INTROSPECTIVE_GUID;
       }else{
         // Form URL for GET call 
		     $uri = $BASE_URL . $socdir[$api]. $matrix_parms;
       }
    }

   // URI has been set. Be sure to parse query parameters for URIs 
   // that were manually typed in and are using the 'view' parameter.
   if(isset($uri)){
     // Save original URI to display in text box
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
<!-- Place URL in textbox for user to see. -->
<script type='text/javascript'>
  document.enter_uri.uri_input.value = "<? echo $original_endpoint; ?>";
</script>
<?
$response = $session->client->get($endpoint,$query_params);
$query_params['format']='xml';
$response_xml = $session->client->get($endpoint, $query_params);
unset($_GET);
?>
<!-- Create tabs for holding responses and docs -->
<div id='results' class='yui-navset'>
<ul class='yui-nav'>
<li class='selected'><a href="#xml"><em>XML</em></a></li>
<li><a href='#json'><em>JSON</em></a></li>
<li><a href='#request'><em>Request Header</em></a></li>
<li><a href='#response'><em>Response Header</em></a></li>
<?php if(file_exists("about_apis/$api.html")){
?>
<li id='about_tab'><a href='#about'><em>About <?php echo $socdir_titles[$api];?></em></a></li>
<?
}
  // Extract single resource URIs from collections for the Contacts, Updates, and Connections APIs
  if($api=='contacts' || $api=='updates' || $api=='connections'){
?>
  <li id='singleton_tab'><a href='#singleton'><em><?php echo "Individual " . $socdir_titles[$api];?></em></a></li>
<?
}
?>
</ul>
<div class='yui-content'>
<div id='xml'>
<?php
  echo "<pre>";
	echo wordwrap(htmlspecialchars(xmlpp($response_xml['responseBody'])),100,"\n",true);
?>
				</pre>
				</div>
				<div id='json'>
				<?php 
            echo "<pre>";
            echo wordwrap(htmlspecialchars(json_format($response['responseBody'])),100,"\n",true); ?>
				</pre>
				</div>
				<div id='request'>
				<?php
          echo "<pre>";
          // This section displays request header
					if($response_xml){
							print("HTTP Method: " . $response_xml['method'] . "\n\n");
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
				<?php
          echo "<pre>";
          // Display response header
					if($response_xml['responseHeaders']){
						foreach($response_xml['responseHeaders'] as $field => $value){
						echo "$field: " . wordwrap("$value\n\n",100,"\n",true);
					 }
					}
					else {
						display_error("No response header is available.","text");
					}
				?>
				</pre>
				</div>
				<?php 
           // If API has docs, include the docs in the 'about' tab
           if(file_exists("about_apis/$api.html")){
				?>
				<div id='about'>
				<?php include('about_apis/' . $api . ".html"); ?>
				</div>
        <?php
         }
        ?>
        <?php 
           // Certain APIs have singleton as well as collection endpoints. Create tab w/ singleton endpoints.
           if($api=='contacts' || $api=='updates' || $api=='connections'){
        ?>
        <div id='singleton'>
        <?php
            $ul_list = "<ul>";
            $li = "";
            $count = 5;
            $reader = new XMLReader();
  					if($reader->XML($response_xml['responseBody'])){
  					  while($reader->read() && $count){
                if($reader->nodeType == XMLREADER::ELEMENT && $reader->localName == 'contact' || $reader->localName == 'update' || $reader->localName=='connection') 
                {
                  if($singleton = $reader->getAttribute('yahoo:uri')){
                    $count--;
                    // URI in yahoo:uri for Updates is currently incorrect, but check in case this bug has been fixed.
                    if($api=='updates' && !strpos($singleton,"updates"))
                    { 
         										$stem = substr($singleton,0,63);
                            $singleton = $stem . "updates/" . substr($singleton,63,strlen($singleton));
                    }
                    $li .= "<li><a href='?uri_input=$singleton&api=$reader->localName'>" . $singleton . "</a></li>";
                  }
                }
              }
             if($li){
               include("about_apis/singleton_collection.html");
               $ul_list .= $li . "</ul>"; 
               echo "Try clicking on the following singleton resource URIs for the ". ucwords($api) . " API:<br/>";
               echo $ul_list . "</p>";
             }
          }
        ?>
        </div>
        <?
        }
        ?>
				</div>
				<?php
				}else{
				?>
        <!-- No API has been selected. Display an introduction page to the API Explorer -->
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
<!-- Include library for making tooltips and tabs -->
<script>
(function() {
    var tabView = new YAHOO.widget.TabView('results');
})();
</script>
<script type="text/javascript">
<?php require("tooltips.php"); ?>
</script>
</body>
</html>
