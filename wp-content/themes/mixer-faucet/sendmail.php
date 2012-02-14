<?php
echo 'abc';

//function favorite_mail_settings() {

	//global $favorite_mail_cookie,$table_mail_post_rel,$table_mail_content,$wpdb;

	
	//// Get current options from database
	//$email_to = stripslashes(get_option('favorite_mail_to'));
	//$msg_fail = stripslashes(get_option('favorite_mail_msg_fail'));
	//$msg_sent = stripslashes(get_option('favorite_mail_msg_sent'));

	////// Update options if user posted new information
	//if( $_POST['process'] == 'edit' ) {
		//// Read from to 
		//$email_to = stripslashes($_POST['favorite_mail_to']);
		//$msg_fail = stripslashes($_POST['favorite_mail_msg_fail']);
		//$msg_sent = stripslashes($_POST['favorite_mail_msg_sent']);
		//// Save to database
		//update_option('favorite_mail_to', $email_to );
		//update_option('favorite_mail_msg_fail', $msg_fail);
		//update_option('favorite_mail_msg_sent', $msg_sent);
		////notify change
		//echo '<div id="message" class="updated fade"><p><strong>';
		//_e('Settings saved.', 'favorite_mail_domain');
		//echo '</strong></p></div>';
	//}
	//if( $_POST['process'] == 'send-mail' ) {
		//$content = stripslashes($_POST['content']);
		//$mailTo = spliti (',' , $email_to);
		////var_dump($mailTo);
		////exit;	
		//wp_mail($mailTo,'test from favorite',$content,'4756088@qq.com');
		//global $phpmailer;
		//if ( $phpmailer->ErrorInfo != "" ) {
			//echo $phpmailer->ErrorInfo ;
		//} else {
			//favorite_mail_insert();
			//echo $msg_sent;
		//}
	//}	

       //$sql = 'SELECT name, email, content FROM ' . $table_mail_content . ' ORDER BY CREATED_DATE desc ';
       //$favorite_list = $wpdb->get_results($sql);

//}
?>
