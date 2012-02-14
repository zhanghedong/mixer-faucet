<?php
/*

Plugin Name: basket 

Plugin URI: http://1625.me

Description: basket

Version: 1.0

Author: 1625.me 

Author URI: 

*/


//////////////添加自定义字段
$new_meta_boxes = array(
    "description" => array(
        "name" => "description",
        "std" => "",
        "title" => "Description:"),
    "item" => array(
        "name" => "unit",
        "std" => "",
        "title" => "unit:"),
    "item" => array(
        "name" => "item",
        "std" => "",
        "title" => "Item:"),
    "size" => array(
        "name" => "size",
        "std" => "",
        "title" => "Size:"),
    "pack" => array(
        "name" => "pack",
        "std" => "",
        "title" => "PacK:"),
    "cbm" => array(
        "name" => "cbm",
        "std" => "",
        "title" => "CBM:"),
    "qty" => array(
        "name" => "qty",
        "std" => "",
        "title" => "qty:"),
    "attached_file" => array(
        "name" => "attached_file",
        "std" => "",
        "title" => "Attached file:")
);


function new_meta_boxes() {
    global $post, $new_meta_boxes;

    foreach($new_meta_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

        if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];

        echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

        // 自定义字段标题
        echo'<h4>'.$meta_box['title'].'</h4>';

        // 自定义字段输入框
        echo '<input class="regular-text"  name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" /><br />';
    }
}

function create_meta_box() {
    global $theme_name;

    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', 'Detail', 'new_meta_boxes', 'post', 'normal', 'high' );
    }
}



function save_postdata( $post_id ) {
    global $post, $new_meta_boxes;

    foreach($new_meta_boxes as $meta_box) {
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {
            return $post_id;
        }

        if ( 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ))
                return $post_id;
        } 
        else {
            if ( !current_user_can( 'edit_post', $post_id ))
                return $post_id;
        }

        $data = $_POST[$meta_box['name'].'_value'];

        if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
            add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
            update_post_meta($post_id, $meta_box['name'].'_value', $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
    }
}

add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');


function remove_post_custom_fields() {
	remove_meta_box( 'postcustom' , 'post' , 'normal' ); 
}
add_action( 'admin_menu' , 'remove_post_custom_fields' );




//邮件保存到数据库





///评论邮件通知
function comment_mail($comment_id,$comment){

	/////保存当前评论ID
	add_option('comment_id_current',$comment_id);
	//Get current options from database
	$email_to = stripslashes(get_option('admin_email'));
	//// Update options if user posted new information
	$tel= stripslashes($_POST['tel']);
	$email= stripslashes($_POST['email']);
	$author= stripslashes($_POST['author']);
	$subject= stripslashes($_POST['subject']);
	$comment= stripslashes($_POST['comment']);
	$productname= stripslashes($_POST['productname']);
	
	//$content .=   $comment . '&nbsp;&nbsp;&nbsp;&nbsp;author:';
	//$content .=   $author . '&nbsp;&nbsp;&nbsp;&nbsp;email:';
	//$content .=   $email . '&nbsp;&nbsp;&nbsp;&nbsp;tel:';
	//$content .=  $tel . '&nbsp;&nbsp;&nbsp;&nbsp;product list:';
  	 $content .="Dear:webmaster \n\n ";
	 $content .=  $comment ;
	 $content .=" \n\n author:";
	 $content .=  $author ;
	 $content .="\n\n email:";
	 $content .=  $email ;
	 $content .=" \n\n tel:\n\n";
	 $content .=  $tel;

	 $content .=" \n\n Product list: ";
if($productname != ''){
	$content .=  $productname;
}

	 $content .=" \n\n";

	wp_mail($email_to,$subject,$content);
	global $phpmailer;
	//if ( $phpmailer->ErrorInfo != "" ) {
               //echo 'abc';
	//} else {
		//echo 'cde';
	//}

}


add_action ( 'wp_insert_comment', comment_mail, 10, 2 );
