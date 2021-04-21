<?php

// First step: Arrays
$skills = array();
$departments = array();
$employees = array();

// Second step: Classes (not sure if public)
class Skill {
public $description;
}
class Department {
public $name;
public $number;
}
class Employee {
public $name;
public $Department;
public $Skill;
public $line;
}

// Third step: Adding instances and pushing them to their respective array
$bookTrip = new Skill("Book a trip");
$booking = new Department("Booking Department", 01445);
$thomas = new Employee("Thomas", booking, bookTrip, 013);

array_push($skills, bookTrip);
array_push($departments, booking);
array_push($employees, thomas);

/* Now to the actual purpose of this application
What I want to have is a request that checks if 
*/
class Request {
public $serviceWanted;
getContact() {
foreach($employees as $capableEmployee){
if( this.serviceWanted === employee.skill){
array_push(output, employee.name);
array_push(output, employee.department);
array_push(output, employee.line);
json_encode($output);
} else {
echo “No one is able to solve your problem!”;
}
}
}
}

// This will be the output
$output = array();

$bookMeATrip = new Request("Book a trip");
$bookMeATrip.getContact();


?>
