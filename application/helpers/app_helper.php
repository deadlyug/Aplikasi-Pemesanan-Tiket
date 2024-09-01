<?php

function print_console($data)
{
		echo '<script>';
		echo 'console.log('. json_encode( $data ) .')';
		echo '</script>';
}

function dd($data) {
	echo '<pre>';
	print_r($data);
	echo '</pre>';
	die();
}
