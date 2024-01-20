<?php

namespace NeuralNetwork;

class DataSet
{
  public function __construct(
    private string $filePath,
    private int $numInputs,
    private int $numTargets
  ) {
  }

  public function load()
  {
    list($inputs, $outputs) = $this->loadCSV();

    if ($inputs === null || $outputs === null) {
      return [null, null];
    }

    return [$inputs, $outputs];
  }

  private function loadCSV()
  {
    $file = fopen($this->filePath, 'r');
    if ($file === false) {
      return [null, null];
    }

    // skip the first line (labels)
    fgetcsv($file);

    $inputs = [];
    $outputs = [];

    while (($record = fgetcsv($file)) !== false) {
      $inputRow = array_map('floatval', array_slice($record, 0, $this->numInputs));
      $outputRow = array_map('floatval', array_slice($record, $this->numInputs, $this->numTargets));

      $inputs[] = $inputRow;
      $outputs[] = $outputRow;
    }

    fclose($file);

    return [$inputs, $outputs];
  }
}
