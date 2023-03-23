<?php
namespace docupet\binning {

class BinningFilter
{
    private $min = 0.0;
    private $max = 0.0;
    private $b1 = 0.0;
    private $b2 = 0.0;
    private $array = array();
    private $arrlen = 0;

    // Constructor
    public function __construct($input_array){
        $this->array = $input_array;
        $this->min = min($this->array);
        $this->max = max($this->array);
        $this->arrlen = count($this->array);
    }

    // Equal Width Bins:
    public function equal_width() {
        // Divide the bins into three equal bins given on the range of the values:
        $delta = $this->max - $this->min;
        $this->b1 = $delta *.33;
        $this->b2 = $delta *.66;

        // Construct the output buckets:
        $b0_b1 = array();
        $b1_b2 = array();
        $b2_b3 = array();

        // Sort Data:
        foreach ($this->array as $value) {
            if ($value <= $this->b1) {
                array_push($b0_b1,$value);
            } else if ($value <= $this->b2) {
                array_push($b1_b2,$value);
            } else {
                array_push($b2_b3,$value);
            }
        };

        // Return:
        return [$b0_b1,$b1_b2,$b2_b3];
    }


    // Equal Frequency Bins:
    public function equal_frequency() {
        // Construct the output buckets:
        $b0_b1 = array();
        // Sort the array into a local copy:
        $b1_b2 = $this->array;
        sort($b1_b2);
        $b2_b3 = array();

        // init lengths:
        // bottom:
        $lb = 0;
        // center:
        $lc = $this->arrlen;
        // top:
        $lt = 0;

        // Now make the freuqency equal across them:
        while ($lb < $lc) {
            // shift first (min) value:
            $min = array_shift($b1_b2);
            // pop last (max) value:
            $max = array_pop($b1_b2);
            // insert into arrays:
            array_push($b0_b1,$min);
            array_push($b2_b3,$max);
            // Update counters:
            $lb = count($b0_b1);
            $lt = count($b2_b3);
            $lc = count($b1_b2);
        }
        // Should not be backwards.
        sort($b2_b3);
        // Return:
        return [$b0_b1,$b1_b2,$b2_b3];
    }

}
};

