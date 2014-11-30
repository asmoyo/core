<?php namespace Asmoyo\Core\Category;

interface CategoryInterface {

	public function getPaginate($limit = 10);

	public function getPaginateWithPost($limit = 10);

	public function getDetail($slug);

	public function getAsDropdown($field_value = 'id', $field_text = 'title');

	public function store($attr = []);

	public function update($id, $attr = array());

	public function destroy($id);

}