- A quick Binning Filter implementation in pure PHP.
- The algortihm implements a sorting algorithm that will bin a given set of numeric types into 3 bins, either equal width bins, or equal frequency bins.


- Requirements: Just PHP. The Test is written for PHP-CLI.

- ** Class Description:
- BinningFilter:  The filter class itself. To use it, please instantiate it as below:
    - *** Instantiation and Constructor:
    - ** BinningFilter::__constructor($data_array) where the $data_array is an array of numeric values to sort. Such as:
    - ** $bf = new BinningFilter($data_array);.

    - *** Usage:
    - After instantiation, simply use equal_width for sorting the data into the 3 equal width bins: Returns 3 arrays in an array: [min, mid and max]:
    - $bf->equal_width();

    - Or, use equal_frequency for sorting the data into three equal frequency bins: Returns 3 arrays in an array: [min, mid and max]:
    - $bf->equal_frequency();

- ** Testing:
    - *  A Simple unit test is provided, simply run it from the CLI inside the directory:
    - * 'php test_binning.php' is all that needs to be executed.



