<?php include 'functions.php';
/*
Plugin Name: Flipit Coupon Plugin
Plugin URI: http://www.flipit.com
Description: This plugin allows you to create Coupons from Flipit.com
Author: Erwin Nandpersad
Version: 1.0
Author URI: http://www.flipit.com/
*/




  wp_register_sidebar_widget(
    'flipit_widget',          // your unique widget id
    'Flipit.com Coupon Plugin',                 // widget name
    'flipit_widget_display',  // callback function to display widget
    array(                      // options
        'description' => 'Flipit Coupon Parser'
    )
);

wp_register_widget_control(
	'flipit_widget',		// id
	'flipit_widget',		// name
	'flipit_widget_control'	// callback function
);



    function flipit_widget_control($args=array(), $params=array()) {
    	//the form is submitted, save into database
    	if (isset($_POST['submitted'])) {
    		update_option('flipit_coupon_title',$_POST['coupontitle']);
    		update_option('flipit_image_size', (int) $_POST['imagesize']);
			update_option('flipit_stringlength', (int) $_POST['stringlength']);
			update_option('flipit_country',  $_POST['country']);
			update_option('flipit_coupons_show', (int) $_POST['coupons_show']);
			update_option('flipit_width', (int) $_POST['width']);
			update_option('flipit_showlogo', (int) $_POST['showlogo']);
			update_option('flipit_color',$_POST['color']);
			
    	}

    	//load options
    	$flipit_coupon_title = get_option('flipit_coupon_title');
		$imagesize = get_option('flipit_image_size');
		$stringlength = get_option('flipit_stringlength');
		$country = get_option('flipit_country');
		$coupons_show = get_option('flipit_coupons_show');
		$width = get_option('flipit_width');
		$showlogo = get_option('flipit_showlogo');
		$color = get_option('flipit_color');
    	?>
    	
    	
    	Coupon title<br />
    	<input type="text" class="widefat" name="coupontitle" value="<?php echo $flipit_coupon_title; ?>" placeholder="Your title" />
    	<br /><br />
    	
    	
    	Country:<br />
    	<select name="country">
			<option value="at" <?php echo  ($country == 'at' ? 'selected=selected' : '');?>> Austria </option>
    		<option value="au" <?php echo  ($country == 'au' ? 'selected=selected' : '');?> > Australia </option>
    		<option value="be" <?php echo  ($country == 'be' ? 'selected=selected' : '');?>> Belgium </option>
			<option value="br" <?php echo  ($country == 'br' ? 'selected=selected' : '');?>> Brazil </option>
			<option value="ca" <?php echo  ($country == 'ca' ? 'selected=selected' : '');?>> Canada </option>
			<option value="dk" <?php echo  ($country == 'dk' ? 'selected=selected' : '');?>> Denmark </option>
			<option value="fr" <?php echo  ($country == 'fr' ? 'selected=selected' : '');?>> France </option>
    		<option value="de" <?php echo  ($country == 'de' ? 'selected=selected' : '');?>> Germany </option>
    		<option value="it" <?php echo  ($country == 'it' ? 'selected=selected' : '');?>> Italy </option>
    		<option value="in" <?php echo  ($country == 'in' ? 'selected=selected' : '');?>> India </option>
    		<option value="id" <?php echo  ($country == 'id' ? 'selected=selected' : '');?>> Indonesia </option>
    		<option value="nz" <?php echo  ($country == 'nz' ? 'selected=selected' : '');?>> New Zealand </option>
			<option value="nl" <?php echo  ($country == 'nl' ? 'selected=selected' : '');?>> Netherlands </option>
			<option value="no" <?php echo  ($country == 'no' ? 'selected=selected' : '');?>> Norway </option>
			<option value="my" <?php echo  ($country == 'my' ? 'selected=selected' : '');?>> Malaysia </option>
    		<option value="pl" <?php echo  ($country == 'pl' ? 'selected=selected' : '');?>> Poland </option>
			<option value="pt" <?php echo  ($country == 'pt' ? 'selected=selected' : '');?>> Portugal </option>
    		<option value="es" <?php echo  ($country == 'es' ? 'selected=selected' : '');?>> Spain </option>
			<option value="ch" <?php echo  ($country == 'ch' ? 'selected=selected' : '');?>> Switserland </option>
			<option value="se" <?php echo  ($country == 'se' ? 'selected=selected' : '');?>> Sweden </option>
    		<option value="sg" <?php echo  ($country == 'sg' ? 'selected=selected' : '');?>> Singapore </option>
			<option value="us" <?php echo  ($country == 'us' ? 'selected=selected' : '');?>> United States </option>
    		
    		
    		
    		<br />
    	</select>
    	<br /><br />
    	
    	
    	Show logo:<br />
    	<select name="showlogo">
    		<option value="1" <?php echo  ($showlogo == 1 ? 'selected=selected' : '');?>> Yes </option>
    		<option value="0" <?php echo  ($showlogo == 0 ? 'selected=selected' : '');?>> No </option>
    		<br />
    	</select>
    	<br /><br />
    	
    	
    	Coupons to show:<br />
    	<input type="text" class="widefat" name="coupons_show" value="<?php echo stripslashes($coupons_show); ?>" placeholder="e.g. 15" />
    	<br /><br />
    	
    	Width:<br />
    	<input type="text" class="widefat" name="width" value="<?php echo stripslashes($width); ?>" placeholder="e.g. 15" />
    	<br /><br />
    	
    	Text color:<br />
    	<input type="text" class="widefat" name="color" value="<?php echo ($color!='' ?  stripslashes($color) : '#000000');?>" />
    	<br /><br />

    	Image size:<br />
    	<input type="text" class="widefat" name="imagesize" value="<?php echo stripslashes($imagesize); ?>" placeholder="e.g. 50" value="50" />
    	<br /><br />
    	
    	String Length:<br />
    	<input type="text" class="widefat" name="stringlength" value="<?php echo stripslashes($stringlength); ?>" placeholder="e.g. 20" />
    	<br /><br />

    	

    	<input type="hidden" name="submitted" value="1" />
    	<?php
    }



    function flipit_widget_display($args=array(), $params=array()) { 
    	//load options
    	$coupon_title = (get_option('flipit_coupon_title')=='' ? 'Coupons' : get_option('flipit_coupon_title'));
    	$imagesize = (get_option('flipit_image_size')==0 ? 20 : get_option('flipit_image_size'));
    	$stringlength = (get_option('flipit_stringlength')==0 ? 45 : get_option('flipit_stringlength'));
    	$country = get_option('flipit_country');
		$coupons_show = (int) get_option('flipit_coupons_show');
		$width = (int) get_option('flipit_width');
		$showlogo = (int) get_option('flipit_showlogo');
		$color = (get_option('flipit_color') =='' ? 'black' : get_option('flipit_color'));
    	//widget output
    	echo stripslashes($args['before_widget']);
		
		echo '<h3 class="widget-title">'.$coupon_title."</h3>";
    	echo stripslashes($args['after_title']);

    	// html
    	if($country =='nl'){
    		$feedUrl = 'http://www.kortingscode.nl/public/rss/popular-offers.xml';
    	} else {
    		$feedUrl = 'http://www.flipit.com/public/'.$country.'/rss/popular-offers.xml';
    	}
    	  
   $rawFeed = file_get_contents($feedUrl);
   $xml = new SimpleXmlElement($rawFeed);
   // print some HTML for the widget to display here
  
   
   if($width != 0) {
   	echo '<ul style="width:'.$width.'px;" >';
   } else {
   	echo '<ul style="width:400px;  " id="ac">';
   }
   
   $counter = 0;
 foreach ($xml->channel->item as $item)
{
	preg_match_all('/src="([^"]*)"/',(string)$item->description, $result);   
	$image ='';
	 
	$image =str_replace("\"","",$result[0][0]);
	$image =str_replace("src=\"","",$result[0][0]);
	$image = str_replace("\"","",$image);
	
	?>
 	
<li >
	<?php if($showlogo==1): ?>
	<img src="<?php echo $image;?>" width="<?php echo $imagesize;?>">
	<?php endif;?>



<a target="_blank" href="<?php echo $item->link;?>" style=" font-size:12px; list-style: none; color:<?php echo $color;?>">
	
	<?php echo  StringLength($item->title,$stringlength);?>

 

</a> <BR>
</li>
<?php
$counter++;
if($coupons_show == 0 ) {
	if($counter == 10) break;
} else {
	if($counter == $coupons_show) break;
}


 }	?>

</ul><?php 
		
		
		
   echo stripslashes($args['after_widget']);
 }

