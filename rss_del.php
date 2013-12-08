<html>
    <head>
        <title>Removal of a feed item</title>
		<charset = "utf-8">
    </head>
    <body>
	
	<?php 
	// Get the index of the entry to delete
	$itemtodel = $_POST['listBox'];
	
	$feed_url = "ee-tv.xml";
	
	// Remove the entry
	echo "Removing the selected item... ";
	$RSS_DOC = new DOMDocument;
	$RSS_DOC->load($feed_url);
	$entries = $RSS_DOC->getElementsByTagName("channel")->item(0);
	$entryToRemove=$entries->getElementsByTagName("item")->item($itemtodel);
	$entries->removeChild($entryToRemove);
    $RSS_DOC->save($feed_url);
	echo "OK";
	
	// Display the upadted feed content
	// Loop through each item in the RSS document
	$RSS_DOC = simpleXML_load_file($feed_url);
	echo nl2br("\n\n");
	echo "New feed content:";
	echo nl2br("\n");
	foreach($RSS_DOC->channel->item as $RSSitem)
	{
		$item_id = md5($RSSitem->title);
		$fetch_date = date("Y-m-j G:i:s");
		$item_title = $RSSitem->title;
		$item_date  = date("Y-m-j G:i:s", strtotime($RSSitem->pubDate));
		$item_url = $RSSitem->link;

		echo $item_title, " - ";
		echo $item_date;
		echo nl2br("\n");
	}
			
	?>
	
	</br></br>
	<a href="index.php">> Back</a>
	
    </body>
</html>

