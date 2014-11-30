<?php namespace Asmoyo\Core\Page;

interface PageInterface {

	public function getAsMenu();

	public function getDetail($slug);

	public function store($attr = array());

	public function update($id, $attr = array());

	public function destroy($id);

}