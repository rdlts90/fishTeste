<?php
function __autoload($className){
	include_once("models/$className.php");	
}

$users=new User("localhost","root","","fishy");

if(!isset($_POST['action'])) {
	print json_encode(0);
	return;
}

switch($_POST['action']) {
	case 'get_users':
		print $users->getUsers();		
	break;

	case 'get_colors':
		print $users->getColors($_POST['user']);		
	break;
	
	case 'add_user':
		$user = new stdClass;
		$user = json_decode($_POST['user']);
		print $users->add($user);		
	break;

	case 'add_color':
		$user = new stdClass;
		$user = json_decode($_POST['user']);
		print $users->addColor($user);		
	break;
	
	case 'delete_user':
		$user = new stdClass;
		$user = json_decode($_POST['user']);
		print $users->delete($user);		
	break;

	case 'delete_color':
		$user = new stdClass;
		$user = json_decode($_POST['user']);
		print $users->deleteColor($user);		
	break;
	
	case 'update_field_data':
		$user = new stdClass;
		$user = json_decode($_POST['user']);
		print $users->updateValue($user);				
	break;
}

exit();