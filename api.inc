<?php
    $BASE_URL = "http://social.yahooapis.com/v1/user/{guid}";
    $socdir = array("profile"=>"/profile","tinyusercard"=>"/profile/tinyusercard",
                  "introspective_guid"=>"/me/guid",
                  "usercard"=>"/profile/usercard","idcard"=>"/profile/idcard",
                  "contacts"=>"/contacts", "contacts_tinyusercard"=>"/contacts?view=tinyusercard",
                  "contacts_bucket"=>'/contacts;bucket=0;maxbucketsize=2;minbucketcount=2?view=bucketinfo',
                  "categories"=>"/categories","status"=>"/profile/status",
                  "connections"=>"/connections", "updates"=>"/updates",
                  "schools"=>"/profile/schools", "works"=>"/profile/works",
                  "images"=>"/profile/image/16x16","updates_connections"=>"/updates/connections"
                    );
    $INTROSPECTIVE_GUID = "http://social.yahooapis.com/v1" . $socdir['introspective_guid'];
    $socdir_titles = array("profile"=>"Profile", "tinyusercard"=>"Tinyusercard", "introspective_guid"=>"Introspective GUID",
                       "usercard"=>"Usercard", "idcard"=>"IDCard","works"=>"Work Profile","schools"=>"School Profile","contacts_tinyusercard"=>"Contacts: Tinyusercard",
                       "contacts_bucket"=>"ContactBuckets","categories"=>"Categories","status"=>"Status","contacts"=>"Contacts",
                       "connections"=>"Connections","updates"=>"Updates","images"=>"Images","updates_connections"=>"Updates for Connections",
                       "contact"=>"Individual Contact", "update"=>"Individual Update", "connection"=>"Individual Connection");
?>
