<?php
/**
 * 9X9 SUDOKU SOLVER
 * Created by JetBrains PhpStorm.
 * User: pashupatipradhan
 * Date: 9/25/13
 * Time: 8:49 PM
 * To change this template use File | Settings | File Templates.
 */

/*
 * this is an array of unsloved sudoku problem
 */
$problem = array(
    array(0, 8, 0, 4, 7, 1, 6, 3, 0),
    array(0, 5, 0, 0, 9, 0, 0, 0, 8),
    array(0, 7, 3, 0, 6, 0, 2, 9, 0),
    array(0, 0, 0, 0, 0, 7, 0, 0, 0),
    array(0, 2, 0, 3, 5, 8, 0, 4, 0),
    array(0, 0, 0, 9, 0, 0, 0, 0, 0),
    array(0, 6, 2, 0, 8, 0, 3, 1, 0),
    array(8, 0, 0, 0, 1, 0, 0, 5, 0),
    array(0, 9, 1, 5, 3, 4, 0, 6, 0)
);


function solve()
{
//    start solving from the initial position
    sudokuSolver(0, 0);
}

/*
 * Function that recurse and backtracks
 * to solve the give problem
 */
function sudokuSolver($row, $col)
{
    global $problem;

    if ($col >= 9) {
        $col = 0;
        if (++$row >= 9)
            return true;
    }

    /*
     * checks the particular position is filled or not
     * if already filled ignore the current position
     * and  move to next position
     */
    if ($problem[$row][$col] != 0) {
        return sudokuSolver($row, $col + 1);
    }
    /*
     * insert the numbers and validates
     * whether the give value is valid for the
     * current position or not
     */
    for ($value = 1; $value <= 9; $value++) {
        if (isValidValue($row, $col, $value)) {
            $problem[$row][$col] = $value;
            if (sudokuSolver($row, $col + 1)) {
                return true;
            }
        }
    }

    // Reset the value
    $problem[$row][$col] = 0; // reset on backtrack
    return false;
}

/*
 * validates whether the give no is valid for the given position
*/
function isValidValue($row, $col, $value)
{
    global $problem;
    // Check validity in row
    for ($i = 0; $i < 9; $i++) {
        if ($value == $problem[$i][col]) {
            return false;
        }
    }

    // Check validity in column
    for ($j = 0; $j < 9; $j++) {
        if ($value == $problem[$row][$j]) {
            return false;
        }
    }

    //Check validity in 3X3 small box
    $rowSmall = ($row / 3) * 3;
    $colSmall = ($col / 3) * 3;
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            if ($value == $problem[$rowSmall + $i][$colSmall + $j]) {
                return false;
            }
        }
    }

//    if everything is valid return
    return true;
}


function sudoku()
{
    echo("Given SUDOKU PROBLEM  <br />");
    display();
    solve();
    echo(" <br /> <br /> SOLUTION  <br />");
    display();
}

function display()
{
    global $problem;
    for ($i = 0; $i < 9; $i++) {
        if ($i % 3 == 0)
            echo("+-------+-------+-------+ <br />");

        for ($j = 0; $j < 9; $j++) {
            if ($j % 3 == 0)
                echo("| ");

            if ($problem[$i][$j] == 0)
                echo("0");

            else
                echo($problem[$i][$j]);

            echo(" ");

        }

        echo("| <br />");
    }

    echo("+-------+-------+-------+ <br />");
}

print_r(sudoku());

?>