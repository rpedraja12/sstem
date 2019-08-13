<?php

if(is_admin()){

    add_action('admin_menu', 'zgembed_options');
    
}

function zgembed_options()
{
		
	add_options_page('Zawgyi Embed', 'Zawgyi Embed', 'administrator', 'zawgyi_embed', 'zawgyi_adminpage');
}

function zawgyi_adminpage()
{
	if(isset($_POST))
	{
		if(isset($_POST['Submit']))
		{
			
			update_option('zawgyi_forceCSS',$_POST['zawgyi_forceCSS']);
			
		}
		
	}
	
	if (get_option('zawgyi_init') =="")
	{
		//init
		update_option('zawgyi_forceCSS',0);
		update_option('zawgyi_init',1);
	}
?>
	 <div class="wrap" style="font-size:13px;">

			<div class="icon32" id="icon-options-general"><br/></div><h2>Settings for Zawgyi Embed</h2>
			<form method="post" action="options-general.php?page=zawgyi_embed">
			<table class="form-table">
				
				<tr valign="top">
					<th scope="row">
						Force Zawgyi Font in CSS (not recommend)
					</th>
					<td>
						<p>
						 <input type="checkbox" value="1"
						 <?php if (get_option('zawgyi_forceCSS') == '1') echo 'checked="checked"'; 
						 ?> name="zawgyi_forceCSS" id="zawgyi_forceCSS" group="zawgyi_forceCSS"/>

						 ( It will override all the fonts. Icons font will gone )

					</td>
				</tr>
			</table>
			<p class="submit">
				<input type="submit" name="Submit" class="button button-primary" value="<?php _e('Save Changes') ?>" />		
			</p>
			</form>
<?php
}
?>