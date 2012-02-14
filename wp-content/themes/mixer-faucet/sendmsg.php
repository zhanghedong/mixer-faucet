<?php

function favorite_mail_insert(){
	global $favorite_mail_cookie,$table_mail_post_rel,$table_mail_content,$wpdb;
	$name = stripslashes($_POST['name']);
	$email = stripslashes($_POST['email']);
	$content = stripslashes($_POST['content']);
	$post_id = stripslashes($_POST['post_id']);
        $sql='INSERT INTO ' . $table_mail_content . ' (IP,NAME,EMAIL,CONTENT) VALUES ("' . favorite_getip() .'","' . $name . '" ," ' . $email . '","' . $content . '")';
	//echo $sql;
	$wpdb->query($sql);
	$mail_id = mysql_insert_id();


	$posts_id = split(',',$post_id);
	$indexCount=0;

         foreach($posts_id as $values)
            {
                if($indexCount<$len-1){
			$sql='INSERT INTO ' . $table_mail_post_rel . ' (POST_ID,MAIL_ID) VALUES ("' . $values .'","' .$mail_id . '" )';
			$wpdb->query($sql);
                }
                $indexCount++;

            }



	//$sql = ' UPDATE ' . $table_mail_post_rel . ' SET MAIL_ID =' . $mail_id . ' WHERE post_id in ( ' . $post_id . ' ) and cookie = "' . $_COOKIE["favorite_mail_cookie"] . '" '; 
	//$wpdb->query($sql);
	
}

function favorite_getip() {
	if (isset($_SERVER)) {
		if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
			$ip_addr = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} 
		elseif (isset($_SERVER["HTTP_CLIENT_IP"])) {
			$ip_addr = $_SERVER["HTTP_CLIENT_IP"];
		} 
		else {
			$ip_addr = $_SERVER["REMOTE_ADDR"];
		}
	} 
	else {
		if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
			$ip_addr = getenv( 'HTTP_X_FORWARDED_FOR' );
		} 
		elseif ( getenv( 'HTTP_CLIENT_IP' ) ) {
			$ip_addr = getenv( 'HTTP_CLIENT_IP' );
		} 
		else {
			$ip_addr = getenv( 'REMOTE_ADDR' );
		}
	}
	
	return $ip_addr;
}# end my_fav_quote_show_optin_form
function favorite_mail_settings() {

	global $favorite_mail_cookie,$table_mail_post_rel,$table_mail_content,$wpdb;

	
	// Get current options from database
	//$email_to = stripslashes(get_option('favorite_mail_to'));
	//$msg_fail = stripslashes(get_option('favorite_mail_msg_fail'));
	//$msg_sent = stripslashes(get_option('favorite_mail_msg_sent'));
	$email_to = '4756088@qq.com';
	$msg_fail = 'error';
	$msg_sent = 'success';

	//// Update options if user posted new information
//	if( $_POST['process'] == 'send-mail' ) {
		$content = stripslashes($_POST['content']);
		$mailTo = spliti (',' , $email_to);
		//var_dump($mailTo);
		//exit;	
		wp_mail($mailTo,'test from favorite',$content);
		global $phpmailer;
		if ( $phpmailer->ErrorInfo != "" ) {
			echo '{"ret":"' . $phpmailer->ErrorInfo . '"}';
		} else {
			favorite_mail_insert();
			echo '{"ret":"' . $msg_sent . '"}';
			//echo $msg_sent;
		}
//	}	

       //$sql = 'SELECT name, email, content FROM ' . $table_mail_content . ' ORDER BY CREATED_DATE desc ';
       //$favorite_list = $wpdb->get_results($sql);
	//echo 'true';

}
if( $_POST['process'] == 'send-mail' ) {
favorite_mail_settings();
}
?>
