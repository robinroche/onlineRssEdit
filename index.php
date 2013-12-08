<html>
    <head>
        <title>Online RSS feed editor</title>
		<charset = "utf-8">
    </head>
    <body>
        <h2>Online RSS feed editor</h2>
		
		<?php
		$feed_url = "feed.xml";

		// Load the RSS feed
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
		?>
		
		Current feed content:</br></br>
		<?php	
		
		// Display the feed content
		// Loop through each item in the RSS document
		foreach($RSS_DOC->channel->item as $RSSitem)
		{
			$item_id = md5($RSSitem->title);
			$fetch_date = date("Y-m-j G:i:s");
			$item_title = $RSSitem->title;
			$item_date  = date("Y-m-j G:i:s", strtotime($RSSitem->pubDate));
			$item_url = $RSSitem->link;

			// You can add other attributes
			echo $item_title, " - ";
			echo $item_date;
			echo nl2br("\n");
		}
		?>
		
		
		</br></br>
		<form action="rss_add.php" method="POST" />
        Add a new item to the feed:</br>
		<!-- Note: you can add other fields here for other attributes -->
		<textarea name="entrytext" cols="50" rows="5"></textarea>
		</br>
		<input type="submit" name="addButton" id="submitButton" value="Add item" />
        </form>
            <?php
			if (isset($_POST["addButton"])) {
                echo "Adding new item...";
            }
            ?>
		
		
        <form action="rss_del.php" method="POST" />
        </br>Remove a feed item:</br></br>
		<select name="listBox" id="listBox" style="width:300px;height=200px;"> 
		<?php 
			// Loop through each item in the RSS document to extract titles
			$i=0;
			foreach($RSS_DOC->channel->item as $RSSitem)
			{
				$item_title = $RSSitem->title;
				$item_date  = date("Y-m-j G:i:s", strtotime($RSSitem->pubDate));
		?>
				<option value="<?php echo $i; ?>" selected="selected"> 
					<?php echo $item_title; ?>
				</option> 
				
		<?php $i++; 
		} echo "\n\n" ?>
		</select>
		</br></br>
		<input type="submit" name="deleteButton" id="submitButton" value="Remove item" />
        </form>
            <?php
			if (isset($_POST["deleteButton"])) {
                echo "Deleting item #" . $i . "...";
            }
            ?>
    </body>
</html>




