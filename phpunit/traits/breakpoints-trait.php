<?php
namespace Elementor\Testing\Traits;

use Elementor\Plugin;

trait Breakpoints_Trait {

	public function set_admin_user() {
		if ( ! current_user_can( 'administrator' ) ) {
			wp_set_current_user( $this->factory()->get_administrator_user()->ID );
		}

		$kit = Plugin::$instance->kits_manager->get_active_kit();

		// In the production environment 'JS' sends empty array, do the same.
		add_post_meta( $kit->get_main_id(), '_elementor_data', '[]' );
	}

	public function set_custom_breakpoint_and_refresh_kit_and_breakpoints( $value ) {
		$this->set_admin_user();

		$kit = Plugin::$instance->kits_manager->get_active_kit();

		// Set a custom value for the tablet breakpoint.
		$kit->set_settings( 'viewport_tablet', $value );

		// Save kit settings.
		$kit->save( [ 'settings' => $kit->get_settings() ] );

		// Refresh kit.
		$kit = Plugin::$instance->documents->get( $kit->get_id(), false );

		Plugin::$instance->breakpoints->refresh();
	}
}
