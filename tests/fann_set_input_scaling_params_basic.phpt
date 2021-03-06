--TEST--
Test function fann_set_input_scaling_params() by calling it with its expected arguments
--FILE--
<?php

$num_input = 2;
$num_output = 1;
$num_layers = 3;
$num_neurons_hidden = 3;
$desired_error = 0.001;
$max_epochs = 50000;
$epochs_between_reports = 1000;

$ann = fann_create_standard($num_layers, $num_input, $num_neurons_hidden, $num_output);

$filename = ( dirname( __FILE__ ) . "/fann_set_input_scaling_params.tmp" );				 
$content = <<<EOF
4 2 1
-1 -1
-1
-1 1
1
1 -1
1
1 1
-1
EOF;

file_put_contents( $filename, $content );
$train_data = fann_read_train_from_file( $filename );

$new_input_min = 0.01;
$new_input_max = 1.0;
var_dump( fann_set_input_scaling_params( $ann, $train_data, $new_input_min, $new_input_max ) );

?>
--CLEAN--
<?php
$filename = ( dirname( __FILE__ ) . "/fann_set_input_scaling_params.tmp" );
if ( file_exists( $filename ) )
	unlink( $filename );
?>
--EXPECTF--
bool(true)