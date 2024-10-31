<?php
/**
 * Nice Portfolio by NiceThemes.
 *
 * Opening wrapper before loop of projects.
 *
 * Override this template by copying it to `your-theme/portfolio/loop/main-wrapper-start.php`.
 *
 * @package Nice_Portfolio
 * @since   1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
<div <?php nice_portfolio_class(); ?> data-columns="<?php nice_portfolio_grid_columns(); ?>">
