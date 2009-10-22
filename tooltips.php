<?php
  function format_tooltip($str){
    echo wordwrap($str,50,"<br/>",true);
  }
?>
// Create namespace for tooltips
YAHOO.namespace("containers");

// Tooltip for profiles
YAHOO.containers.profiles = new YAHOO.widget.Tooltip("tt1", { context:"profiles_title", text:"<?php format_tooltip("A <b>profile</b> is a collection of user provided information that is descriptive of the user, such as the user's name, gender, location, photo, and relationship status. Click to see the documentation.");?>" });

// Tooltip for connections
YAHOO.containers.connections = new YAHOO.widget.Tooltip("tt2", { context:"connections_title", text:"<?php format_tooltip("<b>Connections</b> are two-way relationships, signifying that both users have confirmed their desire to be mutually connected in order to share a potentially higher degree of information between each other. Click to see the documentation.");?>" });

// Tooltip for contacts
YAHOO.containers.contacts = new YAHOO.widget.Tooltip("tt3", { context:"contacts_title", text:"<?php format_tooltip("<b>Contacts</b> are entries in an owner's address book. Entries typically consiste of email address. Click to see the documentation.");?>" });

// Tooltip for status
YAHOO.containers.status = new YAHOO.widget.Tooltip("tt4", { context:"status_title", text:"<?php format_tooltip("The <b>status</b> is a user message of 140 characters or less that can be shared on Yahoo! and other applications. Click to see the documentation.");?>" });

// Tooltip for updates
YAHOO.containers.updates = new YAHOO.widget.Tooltip("tt5", { context:"updates_title", text:"<?php format_tooltip("<b>Updates</b> are a stream of recent events and activites that help users stay in touch with their connections (friends). Click to see the documentation.");?>" });

// Tooltip for GUID
YAHOO.containers.guid = new YAHOO.widget.Tooltip("tt6", { context:"guid", text:"<?php format_tooltip("A <b>GUID</b> identifies a person. In a URI, the GUID identifies the person who is associated with the data of the resource. Click to see the documentation.");?>" });

// Tooltip for URI 
YAHOO.containers.uri = new YAHOO.widget.Tooltip("tt7", { context:"uri", text:"<?php format_tooltip("You can also manually enter a URI as well. The single resource URIs require IDs such as the CID and FID. Click to see documentation about single and collection resources.");?>" });

// Tooltip for About tab
YAHOO.containers.about = new YAHOO.widget.Tooltip("tt8", { context:"about_tab", text:"<?php format_tooltip("<b>About $socdir_titles[$api]</b> describes the $api resource endpoint and reference info, such as the URI syntax, supported HTTP methods, the query/matrix parameters, filters, and scopes.");?>" });

// Tooltip for Singleton tab
YAHOO.containers.singleton = new YAHOO.widget.Tooltip("tt9", { context:"singleton_tab", text:"<?php format_tooltip("<b>Individual $socdir_titles[$api]</b> tab gives you a list of URIs for making calls for individual $api Click the tab to see the links to individual resource endpoints for $socdir_titles[$api]).");?>" });

