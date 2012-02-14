<?php
/*

Plugin Name: Photo update

Plugin URI: http://www.churchmediaresource.com/web/quote-cart

Description: Photo update

Version: 1.0

Author: 1625.me 

Author URI: 

*/
# ----------------------------------
#  general settings

function file_list($dir,$pattern="")  
{  
    $arr=array();  
    $dir_handle=opendir($dir);  
    if($dir_handle)  
    {  
        // 这里必须严格比较，因为返回的文件名可能是“0”  
        while(($file=readdir($dir_handle))!==false)  
        {  
            if($file==='.' || $file==='..')  
            {  
                continue;  
            }  
            //$tmp=realpath($dir.'/'.$file); 
            $tmp=$file; 

            if(is_dir($tmp))  
            {  
                $retArr=file_list($tmp,$pattern);  
                if(!emptyempty($retArr))  
                {  
                    $arr[]=$retArr;  
                }  
            }  
            else  
            {  
                if($pattern==="" || preg_match($pattern,$tmp))  
                {  
                    $arr[]=$tmp;  
                }  
            }  
        }  
        closedir($dir_handle);  
    }  
    return $arr;  
}  
  
function photo_update() {
	global $wpdb;
	//$upload_dir = wp_upload_dir(); 
	//$upload_url = $upload_dir['baseurl'];

	//$imgurl = $upload_url . "/product_img";
	$imgurl = $_SERVER['DOCUMENT_ROOT']."/wp-content/uploads/product_img";

	$fileArr = file_list($imgurl) ;  
	//$sql = "SELECT a.id,a.post_title,b.meta_id,b.meta_key FROM wp_posts a left join wp_postmeta b  ON a.id=b.post_id";

       //清除原来图片
	$sql = "delete from " . $wpdb->prefix."postmeta where meta_key = 'attached_file_value'";
	//echo $sql;
	$data = $wpdb->get_results($sql);

	$sql = 'select id,post_title from ' . $wpdb->prefix . 'posts';
	$data = $wpdb->get_results($sql);

	foreach ($data as $entry){
             $post_id = $entry->id;
             $post_title= $entry->post_title;
	     foreach ($fileArr as $fileName) {
		     if(!$post_title) $post_title = 'false';
		     if( strpos($fileName, $post_title) !== false ){
			        $fileUrl = '/' . $fileName ;
				$iSql= 'INSERT INTO ' . $wpdb->prefix . 'postmeta (post_id,meta_key,meta_value) VALUES ("' . $post_id .'","attached_file_value" ," ' . $fileUrl . '")';
				$isql;
				 $iRet = $wpdb->get_results($iSql);
				//echo $iRet;
			  break;
		     }
	     }
	}

//foreach ($array as $i => $value) {
    //unset($array[$i]);
//}
	
		

}# end my_fav_quote_settings


function photo_update_init(){
	$update = stripslashes($_POST['update']);
		if ( $update == 'start' ){
			photo_update();
		}
?>

		<div class="upload-ct">
<h3>批量更新图路径</h3>
<p>如果只是修改个别产品建议到该产品详细编辑页进行修改。</p>
	     <form action="#" method="post">
                          <input type="hidden" class="update" name="update" value="start" />
            <input type="submit" value="      更         新       " />
              </form>
			</div>
<?php	}


add_action('admin_menu', 'photo_update_menu');
function photo_update_menu() {
	add_options_page('Photo update', 'Photo update', 6, __FILE__, 'photo_update_init' );
}

// 列出网站根目录下所有以".php"扩展名（不区分大小写）结尾的文件  
//echo getcwd();
//echo get_settings('home');


