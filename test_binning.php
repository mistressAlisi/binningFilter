<?php
namespace docupet\binning;
include "binning/BinningFilter.php";
use docupet\binning\BinningFilter;

$test_count = 0;
$test_pass = 0;
$test_fail = 0;
function do_test($test_data,$test_data_res_ewidth,$test_data_res_efreq) {
    $bc = new BinningFilter($test_data);
    $ew_test = $bc->equal_width();
    if (($test_data_res_ewidth[0] != $ew_test[0]) or ($test_data_res_ewidth[1] != $ew_test[1]) or ($test_data_res_ewidth[2] != $ew_test[2])) {
        print("\n*** OH NOES! Equal Width Bins Test FAILED for Test data: ***\n");
        print(json_encode($test_data)."\n");
        print("***Expected output:\n");
        print(json_encode($test_data_res_ewidth)."\n");
        print("***Actual output:\n");
        print(json_encode($ew_test)."\n");
        return false;
    } else {
        print("*** Width Test Passed! ***\n");
    }
    $ef_test = $bc->equal_frequency();
    if (($test_data_res_efreq[0] != $ef_test[0]) or ($test_data_res_efreq[1] != $ef_test[1]) or ($test_data_res_efreq[2] != $ef_test[2])) {
        print("\n*** OH NOES! Equal Frequency Bins Test FAILED for Test data: ***\n");
        print(json_encode($test_data)."\n");
        print("***Expected output:\n");
        print(json_encode($test_data_res_efreq)."\n");
        print("***Actual output:\n");
        print(json_encode($ef_test)."\n");
        return false;
    } else {
        print("*** Frequency Test Passed! ***\n");
    }
    return true;
};


print("\n***Binning Filter test harness***\n");
print("\n**Test Case 1:**\n");
$test_data = array(0.1, 3.4, 3.5, 3.6, 7.0, 9.0, 6.0, 4.4, 2.5, 3.9, 4.5, 2.8);
$test_data_res_ewidth = [
    array(0.1,2.5,2.8),
    array(3.4,3.5,3.6,4.4,3.9,4.5),
    array(7,9,6)];
$test_data_res_efreq = [
    array(0.1,2.5,2.8,3.4),
    array(3.5,3.6,3.9,4.4),
    array(4.5,6,7,9)];
if(do_test($test_data,$test_data_res_ewidth,$test_data_res_efreq) == true) {
    $test_pass++;

} else {
    $test_fail++;

};

print("\n**Test Case 2:**\n");
$test_data = array(10,30,33,22,55,99,75,60,12,49,61,39);
$test_data_res_ewidth = [[10,22,12],[30,33,55,49,39],[99,75,60,61]];
$test_data_res_efreq = [[10,12,22,30],[33,39,49,55],[60,61,75,99]];
if(do_test($test_data,$test_data_res_ewidth,$test_data_res_efreq) == true) {
    $test_pass++;

} else {
    $test_fail++;

};

print("\n**Test Case 3:**\n");
$test_data = array(10,30,33,22,55,99,75,60,12,49,61,39,0.1,0.5,0.97,0.6,5.5,37.6,76.5,88.6);
$test_data_res_ewidth = [[10,30,22,12,0.1,0.5,0.97,0.6,5.5],[33,55,60,49,61,39,37.6],[99,75,76.5,88.6]];
$test_data_res_efreq = [[0.1,0.5,0.6,0.97,5.5,10,12],[22,30,33,37.6,39,49],[55,60,61,75,76.5,88.6,99]];
if(do_test($test_data,$test_data_res_ewidth,$test_data_res_efreq) == true) {
    $test_pass++;

} else {
    $test_fail++;

};
$test_count = $test_pass+$test_fail;
$test_coverage = ($test_pass/($test_count))*100;
echo "\n Ran ".$test_count." tests. Total successes: ".$test_pass.", Total failures: ".$test_fail.". Test Coverage: ".$test_coverage."% ****\n";


