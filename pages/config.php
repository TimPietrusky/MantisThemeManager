<?php
auth_reauthenticate( );
access_ensure_global_level(config_get('manage_plugin_threshold'));

html_page_top(lang_get('plugin_themeManager_title'));

print_manage_menu();

// Variables
$error = false;

// Load available themes
$themes = getThemes($error);

?>

<style type="text/css">
    .mantisbt-theme-manager .theme-name-active {font-weight:bold;}

    .mantisbt-theme-manager img {
        width:200px;
        border:3px solid #fff;

        overflow-y:hidden;

        -webkit-border-radius:5px;
           -moz-border-radius:5px;
                border-radius:5px;

        -webkit-box-shadow: 2px 2px 10px #777;
           -moz-box-shadow: 2px 2px 10px #777;
                box-shadow: 2px 2px 10px #777;

        -webkit-transition: all .3s ease-in-out;
           -moz-transition: all .3s ease-in-out;
            -ms-transition: all .3s ease-in-out;
             -o-transition: all .3s ease-in-out;
                transition: all .3s ease-in-out;
    }

    .mantisbt-theme-manager img:hover {
        -webkit-transform: scale(1.8);
           -moz-transform: scale(1.8);
            -ms-transform: scale(1.8);
             -o-transform: scale(1.8);
                transform: scale(1.8);
    }
}
</style>

<br />
<form action="<?php echo plugin_page( 'config_edit' )?>" method="post">
    <table align="center" class="width50 mantisbt-theme-manager" cellspacing="1">

<!-- Title -->
    <tr>
        <td>
            <table align="center" class="width100 mantisbt-theme-manager" cellspacing="1">
                <tr>
                	<td class="form-title" colspan="3">
                		<?php echo lang_get( 'plugin_themeManager_title' ); ?>
                	</td>
                </tr>
            </table>
        </td>
    </tr>


<!-- Choose Theme -->
    <tr>
        <td>
            <table align="center" class="width100 mantisbt-theme-manager" cellspacing="1">

            <tr>
            	<td class="form-title" colspan="3">
            		<?php echo lang_get( 'plugin_themeManager_config' )?>
            	</td>
            </tr>

            <tr class="row-category">
            	<td><?php echo lang_get('plugin_themeManager_category_row_theme'); ?></td>
            	<td><?php echo lang_get('plugin_themeManager_category_row_selected'); ?></td>
            	<td><?php echo lang_get('plugin_themeManager_category_row_preview'); ?></td>
            </tr>

            <?php foreach ($themes as $theme): ?>
                <tr <?php echo helper_alternate_class()?>>
            	<td class="row-category center theme-name<?php if ($theme['isActive']) {echo "-active";} ?>" width="20%">
            		<?php echo $theme['name']; ?>
            	</td>
            	<td class="center" width="40%">
            		<label>
            		    <input
            		        type="radio"
            		        name="active_theme"
            		        value="<?php echo $theme['name'];?>"
            		        <?php if ($theme['isActive']): ?>
                                checked="checked"
            		        <?php endif; ?>
            		    />

            		    <?php if ($theme['isActive']): ?>
            		        <span class="required"></span>
            		    <?php endif; ?>
            		</label>
            	</td>
            	<td class="right" width="40%">
            	    <a href="<?php echo $theme['img']; ?>">
            		    <img src="<?php echo $theme['img']; ?>" alt="<?php echo $theme['name'];?>" title="<?php echo lang_get('plugin_themeManager_preview'); ?>">
            		</a>
            	</td>
            </tr>
            <?php endforeach ?>

            </table>
        </td>
    </tr>


    <tr>
    	<td class="center" colspan="3">
    		<input type="submit" class="button" value="<?php echo lang_get( 'plugin_themeManager_choose' )?>" />
    	</td>
    </tr>

    </table>
</form>

<?php
    // Show some help
    include('help.php');
?>

<?php
html_page_bottom();



/* functions */

/**
 * Get all local themes
 */
function getThemes(&$error) {
    $active_theme = plugin_config_get('active_theme');
    $themes_path = getcwd() . "/css/themes/";
    $themes = array();

    // Add default theme
    $themes[] = array(
        'name' => 'default',
        'img' => "plugins/MantisThemeManager/pages/default.png",
        'isActive' => $active_theme == 'default'
    );


    // Load themes from css/themes
    if (file_exists($themes_path)) {
        if ($handle = opendir($themes_path)) {
            while (false !== ($theme_name = readdir($handle))) {
                if ($theme_name !== '.' && $theme_name !== '..') {
                    $themes[] = array(
                        'name' => $theme_name,
                        'img' => "./css/themes/$theme_name/" . $theme_name . ".png",
                        'isActive' => $active_theme == $theme_name
                    );
                }

            }
            closedir($handle);
        }
    // Create the "themes" folder first
    } else {
        // Bullshit, I know
        $error = true;
    }

    return $themes;
}
