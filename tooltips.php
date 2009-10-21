// Create namespace for tooltips
YAHOO.namespace("containers");


// Tooltip for profiles
YAHOO.containers.profiles = new YAHOO.widget.Tooltip("tt1", { context:"profiles_title", text:"A profile is a collection of user provided information that is <br/>descriptive of the user, such as the user's name, gender, location, photo, <br/>and relationship status. Click to see the documentation." });

// Tooltip for connections
YAHOO.containers.connections = new YAHOO.widget.Tooltip("tt2", { context:"connections_title", text:"Connections are two-way relationships, signifying that both users have <br/>confirmed their desire to be mutually connected in order to <br/>share a potentially higher degree of information between each other. <br/>Click to see the documentation." });

// Tooltip for contacts
YAHOO.containers.contacts = new YAHOO.widget.Tooltip("tt3", { context:"contacts_title", text:"Contacts are entries in an owner's address book. <br/>Entries typically consiste of email address. <br/>Click to see the documentation." });

// Tooltip for status
YAHOO.containers.status = new YAHOO.widget.Tooltip("tt4", { context:"status_title", text:"The status is a user message of 140 characters or <br/>less that can be shared on Yahoo! and other applications. <br/>Click to see the documentation." });

// Tooltip for updates
YAHOO.containers.updates = new YAHOO.widget.Tooltip("tt5", { context:"updates_title", text:"Updates are a stream of recent events and activites that <br/>help users stay in touch with their connections (friends). <br/>Click to see the documentation." });

// Tooltip for GUID
YAHOO.containers.guid = new YAHOO.widget.Tooltip("tt6", { context:"guid", text:"A GUID identifies a person. In a URI, the GUID identifies the <br/>person who is associated with the data of the resource. <br/>Click to see the documentation." });

// Tooltip for URI 
YAHOO.containers.uri = new YAHOO.widget.Tooltip("tt7", { context:"uri", text:"You can also manually enter a URI as well. The single resource <br/>URIs require IDs such as the CID and FID. <br/>Click to see documentation about single and collection resources." });

// Tooltip for About tab
YAHOO.containers.about = new YAHOO.widget.Tooltip("tt8", { context:"about_tab", text:"<b>About <?php print($socdir_titles[$api]); ?></b> describes the <br/> <?php print($api); ?> resource endpoint and reference info, such as the URI syntax, supported HTTP methods, the<br/>query/matrix parameters, filters, and scopes." });

// Tooltip for Singleton tab
YAHOO.containers.singleton = new YAHOO.widget.Tooltip("tt9", { context:"singleton_tab", text:"The Individual <?php print($socdir_titles[$api]); ?> tab gives you a list of URIs<br/>for making calls for individual <?php print($api); ?><br/> Click the tab to see the links to individual resource endpoints for <?php print($socdir_titles[$api]);?>." });

