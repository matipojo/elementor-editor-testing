<?php
namespace ElementorEditorTesting\Mock;

abstract class Mock_Base {

	abstract public function get_default_item();

	public function get_default_items() {
		return [];
	}
}
