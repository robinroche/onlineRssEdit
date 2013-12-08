<html>
    <head>
        <title>Item addition in feed</title>
		<charset = "utf-8">
    </head>
    <body>
	
	<?php 
	// Get the entry to add from the form
	$newentrytext = $_POST['entrytext'];
	$fetch_date = date("Y-m-j G:i:s");
	
	$feed_url = "ee-tv.xml";

	// Load the current feed content
	try
	{
		libxml_use_internal_errors(true);
		$RSS_DOC = simpleXML_load_file($feed_url);
		if (!$RSS_DOC) {
				echo "Failed loading XML file\n";
				foreach(libxml_get_errors() as $error) {
						echo "\t", $error->message;
				}
		}	
	} catch (Exception $e)
	{
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}

	// Add the entry - customize here
	echo "Adding the new item... ";
	$galleries = $RSS_DOC->channel;
	$gallery = $galleries->addChild('item');
	$gallery->addChild('title', $newentrytext);
	$gallery->addChild('description', '...');
	$gallery->addChild('link', 'http://www....');
	$gallery->addChild('pubDate', $fetch_date);
	$RSS_DOC->asXML($feed_url);
	echo "OK";
	
	// Display the feed content with the new entry
	$RSS_DOC = simpleXML_load_file($feed_url);
	echo nl2br("\n\n");
	echo "New content of the feed:";
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

