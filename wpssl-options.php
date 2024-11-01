<?php
// create custom plugin settings menu
add_action('admin_menu', 'wpssl_settings');
function wpssl_settings() {
    add_menu_page(
        'Site Preloader Settings',
        'Site Preloader Settings',
        'manage_options',
        'wpssl-settings',
        'wpssl_settings_page',
        ''
    );

    //call register settings function 
    add_action( 'admin_init', 'register_wpssl_settings_page' );
}

function register_wpssl_settings_page() {
	//register our settings
    register_setting( 'wpssl-settings-group', 'wpssl_loader_state', array('default'=>1,) );
    register_setting( 'wpssl-settings-group', 'wpssl_background_color', array('default'=>'rgba(255,255,255,0.7)',) );
    register_setting( 'wpssl-settings-group', 'wpssl_outer_color', array('default'=>'#16a085',) );
    register_setting( 'wpssl-settings-group', 'wpssl_middle_color', array('default'=>'#e74c3c',) );
	register_setting( 'wpssl-settings-group', 'wpssl_inner_color', array('default'=>'#f9c922',) );
}

function wpssl_settings_page() {
?>
    <div class="wrap">
        <h1>Site Preloader Settings</h1>
        <form method="post" action="options.php">
            <?php
                settings_fields( 'wpssl-settings-group' );
                do_settings_sections( 'wpssl-settings-group' );
                
                $loader_state = esc_attr( get_option('wpssl_loader_state') );
                $background_color = esc_attr( get_option('wpssl_background_color') );
                $outer_color = esc_attr( get_option('wpssl_outer_color') );
                $middle_color = esc_attr( get_option('wpssl_middle_color') );
                $inner_color = esc_attr( get_option('wpssl_inner_color') );
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Enable/Disable Preloader</th>
                    <td><input type="checkbox" name="wpssl_loader_state" value="1" <?php echo $loader_state=='1' ? 'checked' : ''; ?>></td>
                </tr>
            </table> 
            
            <hr>

            <h2>Preloader styling</h2>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Background line color</th>
                    <td><input type="text" name="wpssl_background_color" class="wpssl-color-picker" data-alpha="true" value="<?php echo $background_color; ?>" /></td>
                </tr> 
                <tr valign="top">
                    <th scope="row">Outer line color</th>
                    <td><input type="text" name="wpssl_outer_color" class="wpssl-color-picker" data-alpha="true" value="<?php echo $outer_color; ?>" /></td>
                </tr>   
                <tr valign="top">
                    <th scope="row">Middle line color</th>
                    <td><input type="text" name="wpssl_middle_color" class="wpssl-color-picker" data-alpha="true" value="<?php echo $middle_color; ?>" /></td>
                </tr>   
                <tr valign="top">
                    <th scope="row">Inner line color</th>
                    <td><input type="text" name="wpssl_inner_color" class="wpssl-color-picker" data-alpha="true" value="<?php echo $inner_color; ?>" /></td>
                </tr>
            </table>

            <hr>

            <?php submit_button(); ?>
        </form>
    </div>
<?php } ?>