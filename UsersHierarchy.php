<?php

////////////////////////////////////
////////////////////////////////////
//            Deputy              //
//             Users              //
//		     Hierarchy			  //
//		                          //
// 	        by Tom Ulman		  //
//           21/03/2018			  //
////////////////////////////////////
////////////////////////////////////


// test line to run from terminal
// copy and paste the line below into terminal window

// php UsersHierarchy.php 4


////////////////////////////////////
////////////////////////////////////


// command to run file from terminal

if ($argc !== 2) {

   echo "Usage: php UsersHierarchy.php [id].\n";

   exit(1);

}

// Set Arbitrary Roles
$roles[] = $objRole1 = new stdClass;
$objRole1->Id = 1;
$objRole1->Name = "System Administrator";
$objRole1->Parent = 0;

$roles[] = $objRole1 = new stdClass;
$objRole1->Id = 2;
$objRole1->Name = "Location Manager";
$objRole1->Parent = 1;

$roles[] = $objRole1 = new stdClass;
$objRole1->Id = 3;
$objRole1->Name = "Supervisor";
$objRole1->Parent = 2;

$roles[] = $objRole1 = new stdClass;
$objRole1->Id = 4;
$objRole1->Name = "Employee";
$objRole1->Parent = 3;


// Set Arbitrary Users
$users[] = $objUser1 = new stdClass;
$objUser1->Id = 1;
$objUser1->Name = "Adam Admin";
$objUser1->Role = 1;

$users[] = $objUser1 = new stdClass;
$objUser1->Id = 2;
$objUser1->Name = "Emily Employee";
$objUser1->Role = 4;

$users[] = $objUser1 = new stdClass;
$objUser1->Id = 3;
$objUser1->Name = "Sam Supervisor";
$objUser1->Role = 3;

$users[] = $objUser1 = new stdClass;
$objUser1->Id = 4;
$objUser1->Name = "Mary Manager";
$objUser1->Role = 2;

function SubordinateFinder($id, $roles, $users) {
	$subRoles = null;
	// find the user in question from id
	foreach($users as $user) {
	    if ($user->{'Id'} == $id) {
	        $u = $user;

	        break;
	    }
	}

	// from the role of that user find all 
	// roles that fall underneath (incrementally after it)
	foreach($roles as $role) {
	    if ($role->{'Id'} > $u->{'Role'}) {
	        $subRoles[] = $role->{'Id'};
	    };	        
	}

	// if no sub roles stop, else report sub users
	if  ($subRoles == !null) {
		// loop through all users with found roles and print them
		foreach($users as $user) {
	    	if (in_array($user->{'Role'}, $subRoles)) {
    			$subordinates[] = $user;	        
			}
		}

		echo "\n";
		echo "\n";
		echo "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n";
		echo "\n";
		echo "Subordinates:   \n";
		echo "\n";
		print_r($subordinates);
		echo "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n";
		echo "\n";
		

	} else {
		echo "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n";
		echo "\n";
		echo "No roles/subs below this user \n";
		echo "\n";	 
		echo "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n";
	}	
};


SubordinateFinder($argv[1], $roles, $users);