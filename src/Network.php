<?php

namespace NeuralNetwork;

class Network
{
  public function __construct(
    public int $inputs,
    public int $hiddenLayers,
    public int $neurons,
    public int $outputs,
    public array $weights = [],
    public array $biases = []
  ) {
    for ($i = 0; $i < $this->inputs; $i++) {
      $this->weights[$i] = [];
      for ($j = 0; $j < $this->hiddenLayers; $j++) {
        $this->weights[$i][$j] = rand(0, PHP_INT_MAX) / sqrt($this->hiddenLayers);
      }
    }

    for ($i = 0; $i < $this->hiddenLayers; $i++) {
      $this->biases[$i] = [];
      for ($j = 0; $j < $this->neurons; $j++) {
        $this->biases[$i][$j] = rand(0, PHP_INT_MAX) / PHP_INT_MAX;
      }
    }
  }

  public function train(array $inputs, array $targets, float $learnRate): void
  {
    $epoch = 0;
    $epochs = 1;

    while ($epoch < $epochs) {
      for ($i = 0; $i < 10; $i++) {
        $prediction = $this->feedForward($inputs[$i]);
        $target = $targets[$i][0];
        $loss = $this->calculateLoss($prediction, $target);

        print("input: $i | ");
        print("prediction: $prediction | ");
        print("target: $target | ");
        print("loss: $loss\n");
      }

      $epoch++;
    }
  }

  private function calculateLoss(float $prediction, float $target): float
  {
    return pow($prediction - $target, 2);
  }

  private function feedForward(array $input): float
  {
    if (count($input) !== count($this->weights[0])) {
      die("inputs do not match weights");
    }

    $sums = array_map(function ($row) use ($input) {
      return array_sum(array_map(function ($x, $y) {
        return $x * $y;
      }, $row, $input));
    }, $this->weights);

    $addbiases = array_map(function ($sum, $bias) {
      return $sum + $bias;
    }, $sums, $this->biases);

    $output = array_map(function ($sum) {
      return $this->sigmoid($sum);
    }, $addbiases);

    // assuming a single output
    // TODO: expect multiple output layers and adjust function return
    return $output[0];
  }

  private function sigmoid(float $x): float
  {
    return 1 / (1 + exp(-$x));
  }
}
