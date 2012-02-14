<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to basket_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>


	<div id="comments">
	<?php if ( have_comments() ) : ?>
<?php endif; // check for comment navigation ?>


<?php



$current_comment_id = get_option('comment_id_current');
if( $current_comment_id > 0){
	echo '<div class="tip-0">E-mail sent successfully</div>';
	delete_option('comment_id_current');
}
$BasketFavProductName =  $_COOKIE['selectProductName'];
$BasketFavProductID = $_COOKIE["selectProductId"];
$opt= (isset($_GET['opt'])) ? $_GET['opt'] : false  ;

$productNameArr = split(',',$BasketFavProductName);

$productIDArr = split(',',$BasketFavProductID);
$len = count($productIDArr);

$indexCount=0;
$productListHtml = '';
if($len > 1){
	 foreach($productIDArr as $values)
	 {
	       if($indexCount<$len-1){
			$productListHtml .= '<p class="product-selected-wrap"><label class="nowidth"><input name="postids" type="checkbox" value="' . $values . '" checked="checked" /> ' . $productNameArr[$indexCount] . ' </label><a target="_blank" href="' . get_bloginfo('url') . '/?p=' . $values . '" class="to-details">Product Details</a><a class="delete-product" href="#" data-productid="' . $values . '" title="Remove This Item">X</a></p>';
		}
		$indexCount = $indexCount + 1;
	 }

        $productListHtml .= '<input type="hidden" name="productname" id="tempproductname" value="' . $BasketFavProductName . '">';

}else{
 $ID = get_the_ID();
 $title= get_the_title();
 $productListHtml .= '<input type="hidden" name="productname" value="' . $title . '">';
}


       $fields =  array(
	       'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Message', 'basket' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
               'author' => '<p class="comment-form-field comment-form-author">' . '<label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
                    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="13"' . $aria_req . ' /></p>',
               'email'  => '<p class="comment-form-field comment-form-email"><label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
                    '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="13"' . $aria_req . ' /></p>',
			    'comment_notes_before' => '<div class="product-selected-list">' . $productListHtml . '</div>' ,
			    'comment_notes_after' => '',
        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
        'title_reply'          => __( 'Contact Supplier' ),
        'title_reply_to'       => __( 'Contact Supplier %s' ),
        'cancel_reply_link'    => __( 'Cancel reply' ),
        'label_submit'         => __( 'Send' ),
       );
 	comment_form($fields); 
     ?>
</div><!-- #comments -->
