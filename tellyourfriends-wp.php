<?php
/*
Plugin Name: TellYourFriends WP
Plugin URI: http://plugins.extendedproduct.com/tellyourfriends-plugin
Description: Allows your users to tell their friends about your website!
Version: 1.0.2
Author: ExtendedProduct
Author URI: http://www.extendedproduct.com
*/

/*  Copyright 2010 ExtendedProduct - support@extendedproduct.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Hook for adding admin menus
add_action('admin_menu', 'tellyourfriends_wp_add_pages');

// action function for above hook
function tellyourfriends_wp_add_pages() {
    add_options_page('TellYourFriends WP', 'TellYourFriends WP', 'administrator', 'tellyourfriends_wp', 'tellyourfriends_wp_options_page');
}

// tellyourfriends_wp_options_page() displays the page content for the Test Options submenu
function tellyourfriends_wp_options_page() {

    // variables for the field and option names 
    $opt_name = 'mt_tellyourfriends_address';
	$opt_name_2 = 'mt_tellyourfriends_title';
    $opt_name_5 = 'mt_tellyourfriends_plugin_support';
	$opt_name_6 = 'mt_tellyourfriends_limit';
	$opt_name_7 = 'mt_tellyourfriends_subject';
	$opt_name_10 = 'mt_tellyourfriends_message';
	$opt_name_13 = 'mt_tellyourfriends_authoremail';
    $hidden_field_name = 'mt_tellyourfriends_submit_hidden';
    $data_field_name = 'mt_tellyourfriends_address';
	$data_field_name_2 = 'mt_tellyourfriends_title';
    $data_field_name_5 = 'mt_tellyourfriends_plugin_support';
    $data_field_name_6 = 'mt_tellyourfriends_limit';
    $data_field_name_7 = 'mt_tellyourfriends_subject';
	$data_field_name_10 = 'mt_tellyourfriends_message';
	$data_field_name_13 = 'mt_tellyourfriends_authoremail';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
	$opt_val_2 = get_option($opt_name_2);
    $opt_val_5 = get_option($opt_name_5);
    $opt_val_6 = get_option($opt_name_6);
    $opt_val_7 = get_option($opt_name_7);
	$opt_val_10 = get_option($opt_name_10);
	$opt_val_13 = get_option($opt_name_13);

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];
		$opt_val_2 = $_POST[$data_field_name_2];
        $opt_val_5 = $_POST[$data_field_name_5];
        $opt_val_6 = $_POST[$data_field_name_6];
        $opt_val_7 = $_POST[$data_field_name_7];
		$opt_val_10 = $_POST[$data_field_name_10];
		$opt_val_13 = $_POST[$data_field_name_13];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
		update_option( $opt_name_2, $opt_val_2 );
        update_option( $opt_name_5, $opt_val_5 );
        update_option( $opt_name_6, $opt_val_6 );  
        update_option( $opt_name_7, $opt_val_7 ); 
		update_option( $opt_name_10, $opt_val_10 );
		update_option( $opt_name_13, $opt_val_13 );

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?php

    }

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'TellYourFriends Plugin Options', 'mt_trans_domain' ) . "</h2>";

    // options form
    
    $change3 = get_option("mt_tellyourfriends_plugin_support");

if ($change3=="Yes" || $change3=="") {
$change3="checked";
$change31="";
} else {
$change3="";
$change31="checked";
}

    ?>
<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("Widget Title:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_2; ?>" value="<?php echo $opt_val_2; ?>" size="50">
</p><hr />

<p><?php _e("Subject of E-Mail (Use %NAME% for Sender's Name, %EMAIL% for Sender's E-Mail):", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_7; ?>" value="<?php echo $opt_val_7; ?>" size="50">
</p><hr />

<p><?php _e("Message in E-Mail (Use %SITEURL% for your URL, %NAME% for Sender's Name, %EMAIL% for Sender's E-Mail and %RECIPIENT% for Recipient's E-Mail):", 'mt_trans_domain' ); ?> 
<textarea name="<?php echo $data_field_name_10; ?>" rows="5" cols="40"><?php echo $opt_val_10; ?></textarea>
</p><hr />

<p><?php _e("Your E-Mail (To be BCC'ed, optional):", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_13; ?>" value="<?php echo $opt_val_13; ?>" size="50">
</p><hr />

<p><?php _e("Maximum Number of Recipients:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_6; ?>" value="<?php echo $opt_val_6; ?>" size="50">
</p><hr />

<p><?php _e("Support this Plugin?", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="Yes" <?php echo $change3; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="No" <?php echo $change31; ?>>No
</p><hr />

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'mt_trans_domain' ) ?>" />
</p><hr />

</form>
<?php
}

function show_tellyourfriends_form($args) {
extract($args);

  $my_email = get_option("mt_tellyourfriends_address"); 
  $title = get_option("mt_tellyourfriends_title");
  $limit = get_option("mt_tellyourfriends_limit");
  $plugin_support2 = get_option("mt_tellyourfriends_plugin_support");
  $hidden_variable = $_POST['hidden_variable'];
  $subject = get_option("mt_tellyourfriends_subject");
  $message = get_option("mt_tellyourfriends_message");
  $author_email = get_option("mt_tellyourfriends_authoremail");


if ($hidden_variable=="done") {
$sub_name=$_POST['myname'];
$sub_email=$_POST['myemail'];
$recipients=$_POST['recipients'];

$blog_url=get_bloginfo('siteurl');

$sub_name=strip_tags($sub_name);
$sub_email=strip_tags($sub_email);
$sub_recipients=strip_tags($recipients);

if ($sub_name=="" || $sub_email=="" || $sub_recipients=="") {
$varwrong=1;

echo $before_title.$title.$after_title.$before_widget;

echo "<p>A required field was not filled in. Please try again</p>";

echo '<form action="'.$_SERVER['php_self'].'" method="post">';

echo '<p>Your Name*: <input type="text" name="myname" /></p>';

echo '<p>Your E-Mail*: <input type="text" name="myemail" /></p>';

echo '<p>Recipients (Separated by commas): <textarea name="recipients"></textarea></p>';

echo '<input type="hidden" name="hidden_variable" value="done" />';

if (is_home()) {
$Path=get_bloginfo('url');
} else {
$Path=get_permalink();
}

echo '<input type="hidden" name="url1" value="'.$Path.'" /><input type="submit" value="Submit" /></form>';

if ($plugin_support2=="Yes" || $plugin_support2=="") {
add_action('wp_footer', 'tellyourfriends_plugin_support');
}

echo $after_widget;
}

if ($varwrong!=1) {
$x=0;
$message=str_replace("%SITEURL%", $_POST['url1'], $message);
$message=str_replace("%NAME%", $sub_name, $message);
$message=str_replace("%EMAIL%", $sub_email, $message);

$message=nl2br($message);
$message=str_replace("<br />", "\n", $message);
$message=str_replace("<br>", "\n", $message);

$sub_recipients=str_replace(" ", "", $sub_recipients);
$myArray = explode(',', $sub_recipients);

foreach($myArray as $key=>$value)
    {
$headers = "From: ".$sub_email."\r\n";

if ($author_email != "") {
$headers .= "Bcc: ".$author_email."\r\n";
}

$subject=str_replace("%SITEURL%", $_POST['url1'], $subject);
$subject=str_replace("%NAME%", $sub_name, $subject);
$subject=str_replace("%EMAIL%", $sub_email, $subject);

$emailsubject=$subject;

$message1=str_replace("%RECIPIENT%", $value, $message);

if ($x<=$limit) {
mail($value,$emailsubject,$message1,$headers);
$x ++;
}
}
echo $before_title.$title.$after_title.$before_widget."<p>Thank you for telling your friends!</p>";

echo '<form action="'.$_SERVER['php_self'].'" method="post">';

echo '<p>Your Name*: <input type="text" name="myname" /></p>';

echo '<p>Your E-Mail*: <input type="text" name="myemail" /></p>';

echo '<p>Recipients (Separated by commas): <textarea name="recipients"></textarea></p>';

echo '<input type="hidden" name="hidden_variable" value="done" />';

if (is_home()) {
$Path=get_bloginfo('url');
} else {
$Path=get_permalink();
}

echo '<input type="hidden" name="url1" value="'.$Path.'" /><input type="submit" value="Submit" /></form>';

if ($plugin_support2=="Yes" || $plugin_support2=="") {
add_action('wp_footer', 'tellyourfriends_plugin_support');
}

echo $after_widget;
}
} else {

echo $before_title.$title.$after_title.$before_widget;

echo '<form action="'.$_SERVER['php_self'].'" method="post">';

echo '<p>Your Name*: <input type="text" name="myname" /></p>';

echo '<p>Your E-Mail*: <input type="text" name="myemail" /></p>';

echo '<p>Recipients (Separated by commas): <textarea name="recipients"></textarea></p>';

echo '<input type="hidden" name="hidden_variable" value="done" />';

if (is_home()) {
$Path=get_bloginfo('url');
} else {
$Path=get_permalink();
}

echo '<input type="hidden" name="url1" value="'.$Path.'" /><input type="submit" value="Submit" /></form>';

if ($plugin_support2=="Yes" || $plugin_support2=="") {
add_action('wp_footer', 'tellyourfriends_plugin_support');
}

echo $after_widget;
}
}

function init_tellyourfriends_widget() {
register_sidebar_widget('TellYourFriends WP', 'show_tellyourfriends_form');
}

function tellyourfriends_plugin_support() {
if (get_option("tellyourfriends_wp_saved")=="") {
$echome="<p style='font-size:x-small'>TellYourFriends Widget published by <a href='http://www.rockemmusic.com'>Drum Kits</a>.</p>";
update_option("tellyourfriends_wp_saved", $echome);
echo $echome;
} else {
$echome=get_option("tellyourfriends_wp_saved");
echo $echome;
}
}

add_action("plugins_loaded", "init_tellyourfriends_widget");

?>
