<?php 
   /* 
   Plugin Name: My Snappy List Builder
   Plugin URI: http://wordpressplugincourse.com/plugins/snappy-list-builder
   Description: The ultimate email list building plugin for WordPress. Capture new subscribers. Reward subscribers with a custom download upon opt-in. Build unlimited lists. Import and export subscribers easily with .csv
   Version: 1.0 --- Plugin Practice Following Snappy List Builder
   Author: DW @ Protothought
   Author URI: https://proto-thought.com
   License: GPL2
   License URI: https://www.gnu.org/licenses/gpl-2.0.html
   Text Domain: snappy-list-builder
   */

/* !0. TABLE OF CONTENTS */

/*
	
	1. HOOKS
        1.1 - call to register custom shortcodes
        1.2 - register custom admin column headers
        1.3 - register custom admin column data
    
    2. SHORTCODES
        2.1 - slb_register_shortcodes()
        2.2 - slb_form_shortcode()
		
    3. FILTERS
        3.1 - slb_subscriber_column_headers()
		
	4. EXTERNAL SCRIPTS
		
	5. ACTIONS
		
	6. HELPERS
		
	7. CUSTOM POST TYPES
	
	8. ADMIN PAGES
	
	9. SETTINGS
	
*/




/* !1. HOOKS */
// 1.1 
add_action('init', 'slb_register_shortcodes');
//1.2
add_filter('manage_edit-slb_subscriber_columns', 'slb_subscriber_column_headers');
//1.3
add_filter('manage_slb_subscriber_posts_custom_column', 'slb_subscriber_column_data', 1, 2);

/* !2. SHORTCODES */
// 2.1
function slb_register_shortcodes() {
    add_shortcode('slb_form', 'slb_form_shortcode');
}
// 2.2
function slb_form_shortcode($args, $content="") {
    $output = '
        <div class="slb">
            <form id="slb_form" name="slb_form" class="slb-form" method="post">
                <p class="slb-input-container">
                    <label>Your Name</label><br />
                    <input type="text" name="slb_firstname" placeholder="First Name" />
                    <input type="text" name="slb_lastname" placeholder="Last Name" />
                </p>
                <p class="slb-input-container">
                    <label>Your Email</label><br />
                    <input type="email" name="slb_email" placeholder="you@email.com" />
                </p>
    ';
    if (strlen($content)):
        $output .= '<div class="slb-content">' . wpautop($content) . '</div>';
    endif;
    $output .= '
                <p class="slb-input-container">
                    <input type="submit" name="slb_submit" value="Sign Me Up!" />
                </p>
            </form>
        </div>
    ';
    return $output;
}




/* !3. FILTERS */
//3.1
function slb_subscriber_column_headers($columns) {
    $columns = array(
        'checkbox' => '<input type="checkbox">',
        'title' => __('Subscriber Name'),
        'email' => __('Email Address'),
    );
    return $columns;
}
//3.2
function slb_subscriber_column_data($column, $post_id) {
    $output = '';
    switch($column) {
        case 'title':
            $firstname = get_field('slb_firstname', $post_id);
            $lastname = get_field('slb_lastname', $post_id);
            $output .= $firstname . ' ' . $lastname;
            break;
        case 'email':
            $email = get_field('slb_email', $post_id);
            $output .= $email;
            break;
    }
    echo $output;
}



/* !4. EXTERNAL SCRIPTS */




/* !5. ACTIONS */




/* !6. HELPERS */




/* !7. CUSTOM POST TYPES */




/* !8. ADMIN PAGES */




/* !9. SETTINGS */


?>