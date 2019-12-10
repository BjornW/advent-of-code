<?php 
/**
 * The Elves quickly load you into a spacecraft and prepare to launch.
 * 
 * At the first Go / No Go poll, every Elf is Go until the Fuel Counter-Upper. They haven't determined the amount of fuel required yet.
 * 
 * Fuel required to launch a given module is based on its mass. Specifically, to find the fuel required for a module, take its mass, divide by three, round down, and subtract 2.
 * 
 * For example:
 * 
 *     For a mass of 12, divide by 3 and round down to get 4, then subtract 2 to get 2.
 *     For a mass of 14, dividing by 3 and rounding down still yields 4, so the fuel required is also 2.
 *     For a mass of 1969, the fuel required is 654.
 *     For a mass of 100756, the fuel required is 33583.
 * 
 * The Fuel Counter-Upper needs to know the total fuel requirement. To find it, individually calculate the fuel needed for the mass of each module (your puzzle input), then add together all the fuel values.
 * 
 * What is the sum of the fuel requirements for all of the modules on your spacecraft?
 * 
**/



/** 
 * loads a file into an array
 * expects one integer value per line
 * @param string file path
 * @return array each element is a module's mass or bool false on failure
 */ 
function loadFile( $file_path ) {
  $modules_masses = file($file_path, FILE_IGNORE_NEW_LINES); 
  return $modules_masses; 
}


/** 
 * Computes the fuel needs per module based on the 
 * supplied algorithm.
 * @param int module mass 
 * @return int fuel need of supplied module
 */ 
function computeFuelPerModule( $module_mass ) {
  return (floor( $module_mass / 3 )) - 2;  
} 


/** 
 * Computes the total need for fuel based on 
 * each module's mass.
 */
function computeTotal() {
  $modules_masses = loadFile( 'input.txt' ); 
  if( is_array($modules_masses) ) {
    $fuel_needs = array();     
    foreach( $modules_masses as $key => $module_mass ) {
      $module_fuel_needs = computeFuelPerModule( $module_mass ); 
      $fuel_needs[] = $module_fuel_needs; 
    } 
    $total_fuel_needs = array_sum( $fuel_needs ); 
    echo "\nThe total fuel needs are: $total_fuel_needs\n";  
  } else {
    echo "Could not load file"; 
  }
} 


/** 
 * Test our computeFuelPerModule() and computeTotal() functions
 */
function testComputeFuelFunctions() {
  $known_mass_and_fuel = array( 
    12 => 2, 
    14 => 2, 
    1969 => 654, 
    100756 => 33583 
  ); 

  $known_total_fuel = array_sum( $known_mass_and_fuel ); 

  $computed_fuels= array();  
  foreach( $known_mass_and_fuel as $mass => $fuel ) {
    $computed_fuels[ $mass ] = computeFuelPerModule( $mass ); 
    if( $computed_fuels[ $mass ] == $fuel ) {
      echo "Test successful! Known fuel: $fuel == computed fuel: {$computed_fuels[ $mass ]} \n";  
    } else {
      echo "Test failure...Known fuel: $fuel == computed fuel: {$computed_fuels[ $mass ]} \n"; 
    }
  }
  
  $total_computed_fuel = array_sum( $computed_fuels ); 
  if( $known_total_fuel == $total_computed_fuel ) {
    echo "Total fuel test successful! Total known fuel: $known_total_fuel == computed total fuel: $total_computed_fuel \n";   
  } else {
    echo "Total fuel test failure: known fuel: $known_total_fuel == computed total fuel: $total_computed_fuel \n";   
  }

}


/** Run it **/
testComputeFuelFunctions(); 
computeTotal(); 
?>
