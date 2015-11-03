<?php
$isKeyCountEnabled = false;
$keyCount = 0;

function addKeyCount() {
  global $isKeyCountEnabled;
  global $keyCount;

  if ($isKeyCountEnabled) $keyCount ++;
}

function enableKeyCount($enable = true) {
  global $isKeyCountEnabled;
  $isKeyCountEnabled = $enable;
}

function resetKeyCount() {
  global $keyCount;
  $keyCount = 0;
}

function getKeyCount() {
  global $keyCount;
  return $keyCount;
}
