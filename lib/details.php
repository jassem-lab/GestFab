<!DOCTYPE html>
<html>
<head>
<style>
body {
    font-family: Arial;
}

.list-form-container {
    background: #F0F0F0;
    border: #e0dfdf 1px solid;
    padding: 20px;
    border-radius: 2px;
}

.column {
    float: left;
    padding: 10px 0px;
}

table {
    width: 100%;    
    background: #FFF;
}

td, th {
    border-bottom: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    width: auto;
}

.content-div {
    position:relative;
}

.content-div span.column {
    width: 90%;
}

.date {
    position: absolute;
    right: 8px;
    padding: 10px 0px;
}
</style>
<title>Gmail Email Inbox using PHP with IMAP</title>
</head>

<body>
    <h1>Gmail Email Inbox using PHP with IMAP</h1>
    <?php
    if (! function_exists('imap_open')) {
        echo "IMAP is not configured.";
        exit();
    } else {
        ?>
    <div id="listData" class="list-form-container">
<?php
$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'deltawebit20@gmail.com';
$password = 'Deltawebit@20';
 
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to server: ' . imap_last_error());
 
$emails = imap_search($inbox,'ALL');
 
if($emails) {
    $output = '';
    rsort($emails);
 
    $email_number = $_GET['idmail'];
 
        $overview = imap_fetch_overview($inbox,$email_number,1);
        $structure = imap_fetchstructure($inbox, $email_number,FT_UID);
		
		
 
        if(isset($structure->parts) && is_array($structure->parts) && isset($structure->parts[1])) {
            $part = $structure->parts[1];
            $message = imap_fetchbody($inbox,$email_number,2,FT_UID);
			
			$header     = imap_headerinfo($inbox, $email_number, 0);
			$mail       = $header->from[0]->mailbox . '@' . $header->from[0]->host;			
			//$mail       = $header->ccaddress[0]->mailbox . '@' . $header->ccaddress[0]->host;	
			//$mail       = $header->ccaddress;
	
	
	
            if($part->encoding == 3) {
                $message = imap_base64($message);
            } else if($part->encoding == 1) {
                $message = imap_8bit($message);
            } else {
                $message = imap_qprint($message);
            }
			
				$attachments = array();			
                $attachments[1] = array(
                    'is_attachment' => false,
                    'filename' => '',
                    'name' => '',
                    'attachment' => ''
                );
 
                if($structure->parts[1]->ifdparameters) 
                {
                    foreach($structure->parts[1]->dparameters as $object) 
                    {
                        if(strtolower($object->attribute) == 'filename') 
                        {
                            $attachments[1]['is_attachment'] = true;
                            $attachments[1]['filename'] = $object->value;
                        }
                    }
                }
 
                if($structure->parts[1]->ifparameters) 
                {
                    foreach($structure->parts[1]->parameters as $object) 
                    {
                        if(strtolower($object->attribute) == 'name') 
                        {
                            $attachments[1]['is_attachment'] = true;
                            $attachments[1]['name'] = $object->value;
                        }
                    }
                }
 
                if($attachments[1]['is_attachment']) 
                {
                    $attachments[1]['attachment'] = imap_fetchbody($inbox, $email_number, 1);
 
                    /* 3 = BASE64 encoding */
                    if($structure->parts[1]->encoding == 3) 
                    { 
                        $attachments[1]['attachment'] = base64_decode($attachments[1]['attachment']);
                    }
                    /* 4 = QUOTED-PRINTABLE encoding */
                    elseif($structure->parts[1]->encoding == 4) 
                    { 
                        $attachments[1]['attachment'] = quoted_printable_decode($attachments[1]['attachment']);
                    }
                }	

				foreach($attachments as $attachment)
				{
					if($attachment['is_attachment'] == 1)
					{
						$filename = $attachment['name'];
						if(empty($filename)) $filename = $attachment['filename'];
		 
						if(empty($filename)) $filename = time() . ".dat";
		 
						/* prefix the email number to the filename in case two emails
						 * have the attachment with the same file name.
						*/
						$fp = fopen("./" . $email_number . "-" . $filename, "w+");
						fwrite($fp, $attachment['attachment']);
						fclose($fp);
					}

				} 
			
        }
 
		$datefr = utf8_decode(imap_utf8($overview[0]->udate));
		$timefr =  date("d M Y", $datefr);
		$heurefr =  date("H", $datefr);
		$minutefr= date("i", $datefr);
 
$timefr = str_replace( "Jan", 'Janvier', $timefr );
$timefr = str_replace( "Feb", 'Février', $timefr );
$timefr = str_replace( "Mar", 'Mars', $timefr );
$timefr = str_replace( "Apr", 'Avril', $timefr );
$timefr = str_replace( "May", 'Mai', $timefr );
$timefr = str_replace( "Jun", 'Juin', $timefr );
$timefr = str_replace( "Jul", 'Juillet', $timefr );
$timefr = str_replace( "Aug", 'Août', $timefr );
$timefr = str_replace( "Sep", 'Septembre', $timefr );
$timefr = str_replace( "Oct", 'Octobre', $timefr );
$timefr = str_replace( "Nov", 'Novembre', $timefr );
$timefr = str_replace( "Dec", 'Décembre', $timefr );
 
        $output.= '<div class="toggle'.($overview[0]->seen ? 'read' : 'unread').'">';
        $output.= '<span class="from">De: '.utf8_decode(imap_utf8($overview[0]->from)).'</span>';
		 $output.= '<span class="Email">De: '.$mail.'</span>';
        $output.= '<span class="date">Le '.$timefr.' à '.$heurefr.' h '.$minutefr.'</span>';
        $output.= '<br /><span class="subject">Sujet: '.htmlentities(imap_utf8($overview[0]->subject)).'</span> ';
        $output.= '</div>';
 
        $output.= '<div class="body">'.$overview[0]->getMessages('html').'</div><hr />';
 
 
       echo $output;

	 

}
 
	imap_close($inbox);
	}
?>

    </div>
</body>
</html>
