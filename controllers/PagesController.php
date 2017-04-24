<?php

class PagesController
{

	public function getIndex()
	{
		$data = [
			'title' => 'Home',
			'content' => 'Lorem ipsum dolor sit amet.'
		];
		return view('main', $data);
	}

	public function getAbout()
	{
		$data = [
			'title' => 'About',
			'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing.'
		];
		return view('main', $data);
	}

	public function getContact()
	{
		$data = [
			'title' => 'Contact',
			'content' => 'Lorem ipsum dolor sit.'
		];
		return view('main', $data);
	}

}