<?php

////////////////////////////////////
////////////////////////////////////
//      Deputy Shift Creator      //
//		  		 &				  //
//		  Overlap Checker         //
// 	        by Tom Ulman		  //
//           21/03/2018			  //
////////////////////////////////////
////////////////////////////////////


// test line to run from terminal
// copy and paste the line below into terminal window

// php newshift.php 5 1 1 1508461200 1508482800


////////////////////////////////////
////////////////////////////////////


// command to run file from terminal
if ($argc !== 6) {

   echo "Usage: php newshift.php [id] [employee id] [department] [startTime] [endTime].\n";

   exit(1);

}

// save dummy shifts as objects and place 
// into an array called shifts.
$shifts[] = $objRoster1 = new stdClass;
$objRoster1->Id = 1;
$objRoster1->Employee = 1;
$objRoster1->Department = 1;
$objRoster1->StartTime = 1508450400;
$objRoster1->EndTime = 1508479200;

$shifts[] = $objRoster2 = new stdClass;
$objRoster2->Id = 2;
$objRoster2->Employee = 1;
$objRoster2->Department = 1;
$objRoster2->StartTime = 1508461200;
$objRoster2->EndTime = 	1508482800;

$shifts[] = $objRoster3 = new stdClass;
$objRoster3->Id = 3;
$objRoster3->Employee = 1;
$objRoster3->Department = 1;
$objRoster3->StartTime = 1508529600;
$objRoster3->EndTime = 1508569200;

$shifts[] = $objRoster4 = new stdClass;
$objRoster4->Id = 4;
$objRoster4->Employee = 2;
$objRoster4->Department = 1;
$objRoster4->StartTime = 1508450400;
$objRoster4->EndTime = 1508479200;

/////////////////////////////////////
// generating new shift from input //
/////////////////////////////////////

// grabbing input for new shift
$id = $argv[1];
$employee = $argv[2];
$department = $argv[3];
$startTime = $argv[4];
$endTime = $argv[5];

// setting variable name with input id
// and writing new shift
$input = "objRoster".$argv[1];
$shifts[] = $input = new stdClass;
$input->Id = $argv[1];
$input->Employee = $argv[2];
$input->Department = $argv[3];
$input->StartTime = $argv[4];
$input->EndTime = $argv[5];

echo "\n";
echo "\n";
echo "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n";
echo "\n";
echo "New shift added from input:   \n";
echo "\n";
print_r($input);
echo "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n";
echo "\n";

//display all shifts (for testing purposes)
//print_r($shifts);

// Create a function to run an employees id to check.
function EmployeeShiftChecker($id, $employee, $department, $startTime, $endTime, $shifts) {

  foreach ($shifts as $shift){
  	// find all shifts for designated employee
    if ($shift->{'Employee'} == $employee)  {

    	// create a new array of objects with
    	// employees shifts start and end time converted
    	// into date time objects based on SYD Timezone

    	$selectedShift = "Shift".$shift->{'Id'};

    	$selectedShifts[] = $selectedShift = new stdClass;

    	$selectedShift->Id = $shift->{'Id'};

    	$date = new DateTime();
		$date->setTimestamp($shift->{'StartTime'});
		$date->setTimezone(new DateTimeZone('Australia/Sydney'));
		$selectedShift->StartTime = $date->format('U = Y-m-d H:i:s');
		
		$date = new DateTime();
		$date->setTimestamp($shift->{'EndTime'});
		$date->setTimezone(new DateTimeZone('Australia/Sydney'));
		$selectedShift->EndTime = $date->format('U = Y-m-d H:i:s');


    };

  };
  	// check extracted & converted shifts (for testing purposes)
	//print_r($selectedShifts);

	$x = (count($selectedShifts));
	date_default_timezone_set("Australia/Sydney");
	echo "\n";
	echo "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n";
	echo "!!        Tom Says:   	     !!\n";
	echo "!!      Start the Run! 	     !!\n";
	echo "!!                           !!\n";
	echo "!!    Today is " . date("Y/m/d") . "    !!\n";
	echo "!!   The time is " . date("h:i:sa") . "  !!\n";
	echo "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n";

	// loop through selected shifts 
	for ($i = 0; $i <= $x-1; $i++) {
   	 	//echo "".$selectedShifts[$i]->Id." ID!";

		// run through shifts comparing times
		// this includes the new shift from input
		// print warning if overlap occurs
   	 	foreach ($selectedShifts as $check) {
   	 		if($check->Id != $selectedShifts[$i]->Id) {
   	 			if ($selectedShifts[$i]->StartTime > $check->StartTime && $selectedShifts[$i]->StartTime < $check->EndTime){

						echo "\n";
						echo "         !!!!!!!!!!!!!\n";
						echo "         !! WARNING !!\n";
						echo "         !!!!!!!!!!!!!\n";
						echo "\n";
   						echo "Start of shift id ".$selectedShifts[$i]->Id." overlaps with shift ".$check->Id.".\n";
   						
			
				} if ($selectedShifts[$i]->EndTime > $check->StartTime && $selectedShifts[$i]->EndTime < $check->EndTime)
				{
						echo "\n";
						echo "         !!!!!!!!!!!!!\n";
						echo "         !! WARNING !!\n";
						echo "         !!!!!!!!!!!!!\n";
						echo "\n";
   						echo "End of shift id ".$selectedShifts[$i]->Id." overlaps with shift ".$check->Id.".\n";
			
				};
   	 		}
		}
	}

	date_default_timezone_set("Australia/Sydney");
	echo "\n";
	echo "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n";
	echo "!!        Tom Says:   	     !!\n";
	echo "!!      Run Complete! 	     !!\n";
	echo "!!                           !!\n";
	echo "!!    Today is " . date("Y/m/d") . "    !!\n";
	echo "!!   The time is " . date("h:i:sa") . "  !!\n";
	echo "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n";
	
	

	echo "\n";
};

// call function with input parameters and shifts to check fro voerlap
EmployeeShiftChecker($argv[1], $argv[2], $argv[3], $argv[4], $argv[5], $shifts);