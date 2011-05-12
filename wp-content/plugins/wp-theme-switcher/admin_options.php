<?php
$wpts_options_msg = '';
$themes = get_themes();
uksort( $themes, "strnatcasecmp" );

$examples = 'eg: '.substr_replace(get_bloginfo('url'),'...',-3) .'?<b>/?lang=1</b>&... (Without <b>"?"</b>)';
$examples .= '<br>Or ';
$examples .= substr_replace(get_bloginfo('url'),'...',-3) .'<b>/...you_label.../</b>...';

$wpts_default =  stripslashes(get_option('wp_theme_switcher_default'));
$wpts_settings = get_option('wp_theme_switcher_settings');
if(!$wpts_settings || !is_array($wpts_settings)) {
	$wpts_settings = array();
} else {
	$wpts_settings = stripslashes_deep($wpts_settings);
}

if (isset($_POST['wpts_submit'])) {
	$process_update = false;
	if (isset($_POST['wpts_default'])) {
		if ($wpts_default!=$_POST['wpts_default']) {
			update_option('wp_theme_switcher_default', addslashes($_POST['wpts_default']));
			$wpts_options_msg .= "<b>".$_POST['wpts_default']."</b> set as default<br />";
		}
	}
	foreach ($_POST as $key => $val){
		if ($key!=='wpts_submit' && $key!=='wpts_default') {
			foreach($themes as $theme) {
				if ($theme['Template']===$key) {
					if (!isset($wpts_settings[$theme['Template']]) || $wpts_settings[$theme['Template']]!= $val) {
						$wpts_settings[$theme['Template']] = addslashes(strip_tags($val));
						$wpts_options_msg .= "Settings saved for <b>".$theme['Template']."</b><br />";
						$process_update = true;
						break;
					}
				}
			}
		}
	}
	if($process_update) {
		update_option('wp_theme_switcher_settings', $wpts_settings);
	}
}

$wpts_settings = stripslashes_deep($wpts_settings);

$wpts_default =  stripslashes(get_option('wp_theme_switcher_default'));
if (empty($wpts_default)){
	$current_theme_data = get_theme(get_current_theme());
	$wpts_default = $current_theme_data["Template"];
}

if(!empty($wpts_options_msg)) {
	?>
<div id="message" class="updated fade">
<p><?php echo $wpts_options_msg; ?></p>
</div>
	<?php
}
?>

<div class="wrap"><?php screen_icon(); ?>
<h2>WP Theme Switcher</h2>
<br />
<form method="post" action="">
<table class="widefat fixed" cellspacing="0">
	<thead>
		<tr class="thead">
			<th><?php _e('Available Themes'); ?></th>
			<th><?php echo __('URI pattern'); ?></th>
			<th width="40px"><?php echo __('Defaul'); ?></th>
		</tr>
	</thead>

	<tfoot>
		<tr class="thead">
			<th><?php _e('Available Themes'); ?></th>
			<th><?php echo __('URI pattern'); ?></th>
			<th><?php echo __('Defaul'); ?></th>
		</tr>
	</tfoot>

	<tbody>
	<?php
	$style = '';
	$all_pattern = '';
	foreach ($themes as $theme) {
		$style = ( ' class="alternate"' == $style ) ? '' : ' class="alternate"';
		?>
		<tr id='theme-<?php echo $theme['Template']?>' <?php echo $style; ?>>
			<td><?php echo $theme['Name'];?><br />
			<?php
			$plugin_base_uri = WP_CONTENT_URL;
			if (isset($theme["Theme Root URI"])) {
				$plugin_base_uri = $theme["Theme Root URI"];
			}
			?>
			<img width="200"
				src="<?php echo $plugin_base_uri.'/'.$theme["Stylesheet"].'/'.$theme["Screenshot"]; ?>"
				alt="" /></td>
			<td valign="middle"><?php 
			$pattern_value = '';
			if (isset($wpts_settings[$theme['Template']])) {
				$pattern_value = $wpts_settings[$theme['Template']];
			}
			?> <input type="text" name="<?php echo $theme['Template']?>"
				size="40" value="<?php echo $pattern_value; ?>" /> <br />
				<?php
				if (empty($pattern_value)){
					$eg = $examples;
				} else {
					$eg = 'preview : '.substr_replace(get_bloginfo('url'),'...',-3) .'<b>/...'.$pattern_value.'.../</b>...';
					$all_pattern .= $pattern_value;
				}
				echo $eg;
				?></td>
			<td>
				<input type="radio" name="wpts_default" value="<?php echo $theme['Template']?>" <?php echo ($theme['Template']==$wpts_default)?'checked="checked"':''; ?>>
			</td>
		</tr>
		<?php
	}
	?>
	</tbody>
</table>
<p class="submit"><input class="button-primary" type="submit"
	name="wpts_submit" class="button" value="<?php _e('Save Changes'); ?>" />
</p>
</form>
<?php 
if (!empty($all_pattern)){
?>
	<p></p>
	<p>
	<strong>Some examples:</strong><br />
		<?php
		echo $examples;
		?>
	</p>
<?php 
}
?>
</div>