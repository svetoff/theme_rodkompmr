<?php
/**
 * Displays the searchform of the theme.
 */
?>
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="searchform clearfix" method="get">
		<label class="assistive-text" for="s"><?php _e( 'Поиск', 'travelify' ); ?></label>
		<input type="text" placeholder="<?php esc_attr_e( 'Поиск', 'travelify' ); ?>" class="s field" name="s">
	</form>