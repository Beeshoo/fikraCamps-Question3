<?php

    /*  Q3: Write a program that gets the data from the oscar.csv file and figures out:
    ===================================================================================================================
    ====    1. print name of the actor who has more Oscars from the others
    ====    2. print name of the actor who is the oldest actor or actress who got the Oscar, in what year and for what movie.
    ====    3. print the name of the actor who got the more than Oscar in row
    ====    please note that the CSV file's data are ordered like this ( "Index", "Year", "Age", "Name", "Movie" ).
    ===================================================================================================================
    */

    $file = file("oscar.csv");                                  // => define the csv file (OSCARS) in a variable.

    foreach ($file as $details) {                               // => converte var $file into multidimensional ->
        $oscars[] = explode(',',$details);                      //    array using foreach & explode function.
    }

    // 1. GET THE NAME OF ACTORS WHO HAD MORE OSCARS THAN THE OTHERS
    $arrActsName = array() ;                                    // => define an array to get single array of ->
    foreach ($oscars as $oscar) {                               //    actors names by using foreach & keys 3

        $arrActsName[] = $oscar[3] ;                            // => key [3] represent to the field of actors names
    }
    $frequencyNames = array_count_values($arrActsName);         // => by using this function will Returns ->
                                                                //    an associative array of values from -> 
                                                                //    array as keys and their count as value. 
                                                                
    $max = array_keys($frequencyNames, max($frequencyNames));   // => array_keys function for getting the keys -> 
                                                                //    of any array & max function to get the -> 
                                                                //    max value of any array.

    // 2. GET THE NAME OF OLDEST ACTOR HAD OSCAR
    $randLine = array_rand($oscars);                            // => choose random array from multi_array $oscars.
    $randAge = $randLine[2];                                    // => choose the age field (key[2]) of $randLine array.
    foreach ($oscars as $oscar) {                               // => by using foreach to compare the age of all ->
        if ($oscar[2] > $randAge) {                             //    actors with $randAge to get the oldest actor, ->
            $randAge = $oscar[2];                               //    his | her name, and movie title.
            $year = $oscar[1];
            $oldestAct = $oscar[3];
            $movieName = $oscar[4];
        }
    }

    // 3. GET THE NAME OF ACTOR WHO GOT MORE THAN ONE OSCAR IN THE SAME YEAR
    foreach ($oscars as $oscar) {                               // => check all array inside the multi_arr $oscars ->
        if (count($oscar) > 5) {                                //    if that had more than 5 parameter, that mean ->
            $moreOscarInYear[] = $oscar[3];                     //    the actor had more than one Oscar in the same year ->
        }                                                       //    then put his name in $moreOscarInYear array
    }
    $names ='';
    foreach ($moreOscarInYear as $act) {                        // => by foreach convert $moreOscarInYear array into ->
        $names .= "<strong>".$act."</strong> & ";               //    string var $names separated by (&).
    }
    $names = substr($names, 0, -2);                             // => this function to subtruct the last chars from $names->
                                                                //    (& ).

    // PRINTING THE RESULTS
    echo "<ol>";
        echo "<li> The Actor Who get Oscar more than the others : <strong>".$max[0]."</strong>.</li>";
        echo "<li> The Oldest Actor get Oscar : <strong>".$oldestAct."</strong> in the Film (".$movieName.") in ".$year.". </li>";
        echo "<li> The Actor Who got More than one Oscar in the Same Year : ".$names." .</li>";
    echo "</ol>";


?>