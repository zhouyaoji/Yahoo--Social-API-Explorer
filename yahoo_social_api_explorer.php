<?php

  // Set memory limit to handle large responses for updates of connections
  ini_set('memory_limit', '100M');
  
  // Set error reporting only for fatal errors
  error_reporting(E_ERROR);

  // Get the Yahoo! Social SDK for PHP: http://github.com/yahoo/yos-social-php
  // Include PHP SDK for authorization and making requests to API endpoints
  require('../yos-social-php/lib/Yahoo.inc');

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
  
  $yahoo_user = $session->getSessionedUser(); 
  $profile = $yahoo_user->getProfile();
  $nickname = $profile->nickname;

  // User has requested to log out
  if($_GET['logout']=='true'){
    unset($_SESSION);
    session_destroy(); 
    $alert = "You have signed out from " . basename($_SERVER['SCRIPT_NAME']) . " and are being redirected to " . $_SERVER['SERVER_NAME']. ".";
  ?>
    <script type="text/javascript">
    <!--
    alert("<?php echo $alert; ?>");
    window.location = "<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>";
    //-->
    </script>
  <?php
  }
  ?>

   <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
   <head>
     <meta http-equiv="Content-type" content="text/html;charset=utf-8" />
     <title>Yahoo! Social API Explorer</title>
     <!-- Include stylesheets and JavaScript libraries from YUI -->
     <!-- Skin CSS file -->
     <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/assets/skins/sam/resize.css">
     <!-- Style sheets for setting bases for fonts and making look consistent across browsers. -->
     <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/reset/reset-min.css"/> 
     <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/base/base-min.css"/> 
     <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/fonts/fonts-min.css" />
     <!-- CSS for containers and tabs. -->
     <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/container/assets/skins/sam/container.css" />
	   <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/tabview/assets/skins/sam/tabview.css"/> 

     <!-- Utility Dependencies -->
    <script type="text/javascript" src="http://yui.yahooapis.com/2.8.0r4/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
    <script type="text/javascript" src="http://yui.yahooapis.com/2.8.0r4/build/dragdrop/dragdrop-min.js"></script> 
    <script type="text/javascript" src="http://yui.yahooapis.com/2.8.0r4/build/element/element-min.js"></script> 
    <!-- Optional Animation -->
    <script type="text/javascript" src="http://yui.yahooapis.com/2.8.0r4/build/animation/animation-min.js"></script> 
    <!-- Source file for the Resize Utility -->
    <script src="http://yui.yahooapis.com/2.8.0r4/build/resize/resize-min.js"></script>

    <script type="text/javascript" language='JavaScript' src="http://yui.yahooapis.com/2.8.0r4/build/yahoo-dom-event/yahoo-dom-event.js"></script>
    <script type="text/javascript" language='JavaScript' src="http://yui.yahooapis.com/2.8.0r4/build/container/container-min.js"></script>
    <script type="text/javascript" language='JavaScript' src="http://yui.yahooapis.com/2.8.0r4/build/element/element-min.js"></script> 
	  <script type="text/javascript" language='JavaScript' src="http://yui.yahooapis.com/2.8.0r4/build/connection/connection-min.js"></script> 
    <script type="text/javascript" language='JavaScript' src="http://yui.yahooapis.com/2.8.0r4/build/tabview/tabview-min.js"></script>

    <!-- DOM manipulation libraries -->
    <script src="http://yui.yahooapis.com/2.8.0r4/build/yahoo/yahoo-min.js"></script>  
    <script src="http://yui.yahooapis.com/2.8.0r4/build/dom/dom-min.js"></script> 
    <?php include("style.css"); ?> 
   </head>
   <body id='explorer_body' class="yui-skin-sam">
  	<div id='main'>
			<h2 class='explorer_heading'>Yahoo! Social API Explorer</h2>
      <p class='explorer_heading' align='right'><?php print(strtolower($nickname)); ?> | <a href='?logout=true'>Sign Out</a></p>
      <div id="topDropMaxCont">
        <div id="topDropContainer">
          <div id="topDropIntCont">
            <div id="breadcrumbs">
              <span class="bcString"><a href="http://developer.yahoo.com" target='_blank'>YDN</a></span>
              <span class="bcSep"></span>
              <span class="bcString"><a href="http://developer.yahoo.com/social/" target='_blank'>Yahoo! Social APIs</a></span>
						  <span class="bcSep"></span>
              <span class="bcString"><a href="http://developer.yahoo.com/social/rest_api_guide" target='_blank'>Documentation</a></span>
              <span class="bcSep"></span>
              <span class="bcString"><a class="bcOn">API Explorer</a></span>        
            </div>
          </div>
        </div>
      </div> 
      <div id='api_container'>
        <!-- Links for Profiles API in first column 'profiles'. -->
			  <div id='profiles'>
				  <h4 id='profiles_title'><a href='http://developer.yahoo.com/social/rest_api_guide/social_dir_api.html#social_dir_intro-profiles' target='_blank'>
          Profiles API</a></h4>
				  <ul>
            <li><a href='?api=introspective_guid'>Introspective GUID</a></li>
				    <li><a href='?api=tinyusercard'>Tinyusercard</a></li>
				    <li><a href='?api=idcard'>IDCard</a></li>
				    <li><a href='?api=usercard'>Usercard</a></li>
				    <li><a href='?api=profile'>Profile</a></li>
				    <li><a href='?api=schools'>Schools</a></li>
				    <li><a href='?api=works'>Works</a></li>
				    <li><a href='?api=images'>Images</a></li>
				  </ul>
				</div>
 
        <!-- Links for Connections API in 2nd column 'connections'. -->
				<div id='connections'>
				<h4><a id='connections_title' href='http://developer.yahoo.com/social/rest_api_guide/social_dir_api.html#social_dir_intro-connections' target='_blank'>Connections API</a></h4>
				<ul>
				<li><a href='?api=connections'>Connections</a></li>
				<li><a href='?api=connections;start=0;count=5'>Connections: pagination</a></li>
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
    </div>
        <!-- Section for including information about the user and API being called. 
             * GUID
             * URI
       -->
       <!-- Text box for manually entering a YSP API URI. -->
       <div id='enter_api'>
       <b id='guid'><a href="http://developer.yahoo.com/social/rest_api_guide/web-services-guids.html" target="_blank">GUID:</a></b> <?php echo " $session->guid"; ?>
       <form name='enter_uri' action='#' method='get'>
       <b id='uri'><a href='http://developer.yahoo.com/social/rest_api_guide/uri-general.html#singleton-collection-resources' target='_blank'>URI:</a>&nbsp;&nbsp;</b>
       <input name='uri_input' type='text' size='100'/>
       <p>
       <input class='submit_button' type='submit' value='Make Request' name='request' />
       <?php if(!empty($_GET['api']) || !empty($_GET['uri_input'])){ 
       ?>
        <p class='about_explorer' align='right'>
        <a class='link' href='?' style='color:#1671AA;'>About the API Explorer</a></p>
      <?php
       }
      ?>
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
        // Scan URL used for request for API name to create doc tab
            foreach($socdir_titles as $key=>$value){
               $search_str = "/$key/";
              if(strpos($uri,$search_str)){
                $api = $key;
                break;
             }
           }
           $api = $api ? $api : basename($uri);
       }
     }else if(!empty($_GET['api'])){ 
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
    unset($_GET);
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
<script type='text/javascript' language='JavaScript'>
  document.enter_uri.uri_input.value = "<? echo $original_endpoint; ?>";
</script>
<?
$response = $session->client->get($endpoint,$query_params);
$query_params['format']='xml';
$response_xml = $session->client->get($endpoint, $query_params);
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
  if(($api=='contacts' || $api=='updates' || $api=='connections') && $response_xml['code']==200){
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
          $status_code = $response_xml['code']; 
          echo "<pre>";
				  print("HTTP Status Code: " . $status_code . "\n\n");
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
           if(($api=='contacts' || $api=='updates' || $api=='connections') && $status_code==200){
            echo "<div id='singleton'>";     
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
</div>
</div>
<script type='text/javascript' language='JavaScript'>
(function() {
    var tabView = new YAHOO.widget.TabView('results');
})();
</script>
<script type="text/javascript" language='JavaScript'>
<?php require("tooltips.php"); ?>
var resize_main = new YAHOO.util.Resize('main');
YAHOO.util.Dom.get("explorer_body").style.width = YAHOO.util.Dom.getViewportWidth(); 
if(YAHOO.util.Dom.get("xml")){
  var body_height = YAHOO.util.Dom.get("xml").clientHeight + 500;
  var body= YAHOO.util.Dom.get('explorer_body');
  body.style.height=body_height;
}
</script>
</body>
</html>
