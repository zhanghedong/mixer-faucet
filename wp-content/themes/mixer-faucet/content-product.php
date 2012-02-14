<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<?php
global $images_meta_key,$query,$description_value;
$curr_post_ID = get_the_ID();
//echo $curr_post_ID;
$upload_dir = wp_upload_dir(); 
$upload_url = $upload_dir['baseurl'];
$upload_url = trim($upload_url);
$file_url = get_post_meta($curr_post_ID,$images_meta_key,true); 
$description = get_post_meta($curr_post_ID,$description_value,true); 
$file_url = trim($file_url);
$attr_file_url = $upload_url.'/product_img/'.$file_url; 
$product_name = $query->post->post_title;
if( !$product_name ){
$product_name = get_the_title();
}
//$product_name = $product_name . '&nbsp;' . $description;
?>
         
<li class="product-item">
<?php if(is_category()){
	$BasketFavProductID = $_COOKIE["selectProductId"];
$selected='';
$productIDArr = split(',',$BasketFavProductID);
foreach($productIDArr as $values)
{
	if( $values != '' ){
		if($values == $curr_post_ID){
			$selected = 'true';	
		}
	}
}


?>
<p class="checkbox"><input name="chkproductids" class="chkproductid" title="<?php echo $product_name ;?>" <?php if($selected) echo 'checked="checked"';?>"  value="<?php echo $curr_post_ID;?>" type="checkbox"></p>
<?php } ?>

<div class="img"><a href="<?php echo the_permalink(); ?>" target="_blank"><img src="<?php echo $attr_file_url; ?>" alt="<?php echo $product_name ;?>"  title="<?php echo $product_name ;?>" /></a></div>
<h4>
<a href="<?php echo the_permalink(); ?>" target="_blank"><?php echo $description; ?><span class="item">Item#：<?php echo $product_name;?></span></a>
</h4>



</li>

