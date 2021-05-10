<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       peterkeyser.ca
 * @since      1.0.0
 *
 * @package    Projects_Plugin
 * @subpackage Projects_Plugin/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php
echo '<form action="options.php" method="post" id="ppprojects_options">';
echo '<h1>PROJECTS PLUGIN - General Settings</h1>';
echo '<table class="form-table">';

settings_fields( 'pp_projects_options_api' );
do_settings_fields( 'pp_projects_options', 'pp_projects_options_api' );

echo '</table>';
submit_button();
echo '<button id="reset_color">Reset</button>';
echo '</form>';