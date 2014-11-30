<?php namespace Asmoyo\Core\Post;

interface PostInterface {

	public function getPaginate($limit = 10);

	public function getPaginateWithCategory($limit = 10);

	public function getDetail($slug);

	public function store($attr = array());

	public function update($id, $attr = array());

	public function destroy($id);
	
}