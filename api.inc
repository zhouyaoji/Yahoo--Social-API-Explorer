<?php
    $BASE_URL = "http://social.yahooapis.com/v1/user/{guid}";
    $socdir = array("profile"=>"/profile","tinyusercard"=>"/profile/tinyusercard",
                  "introspective_guid"=>"/me/guid",
                  "usercard"=>"/profile/usercard","idcard"=>"/profile/idcard",
                  "contactcard"=>"/profile/contactcard","work"=>"/profile/works",
                  "school"=>"/profile/schools","contacts"=>"/contacts", "contacts_tinyusercard"=>"/contacts?view=tinyusercard",
                  "contacts_bucket"=>'/contacts;bucket=0;maxbucketsize=2;minbucketcount=2?view=bucketinfo',
                  "categories"=>"/categories","status"=>"/profile/status",
                  "connections"=>"/connections", "updates"=>"/updates",
                  "schools"=>"/profile/schools", "works"=>"/profile/works",
                  "images"=>"/profile/image/16x16","updates_connections"=>"/updates/connections"
                    );
    $INTROSPECTIVE_GUID = "http://social.yahooapis.com/v1" . $socdir['introspective_guid'];
?>
