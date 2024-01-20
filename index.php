<?php

require_once 'vendor/autoload.php';

use \NeuralNetwork\DataSet;
use \NeuralNetwork\Network;

$data = new DataSet('data.csv', 11, 1);
list($inputs, $targets) = $data->load();

$nn = new Network(count($inputs), 4, 4, count($targets));
$nn->train($inputs, $targets, 0.1);
