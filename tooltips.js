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
