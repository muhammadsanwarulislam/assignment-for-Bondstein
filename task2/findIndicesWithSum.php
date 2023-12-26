<?php

function findIndicesWithSum($nums, $target) {
    $left = 0;
    $right = count($nums) - 1;

    while ($left < $right) {
        $currentSum = $nums[$left] + $nums[$right];

        if ($currentSum == $target) {
            return [$left, $right];
        } elseif ($currentSum < $target) {
            $left++;
        } else {
            $right--;
        }
    }

    return null;
}

// Example usage:
$numbers = [1, 2, 3, 4, 7, 11, 15];
$targetSum = 9;

$result = findIndicesWithSum($numbers, $targetSum);

if ($result !== null) {
    echo "Indices with sum $targetSum: " . implode(', ', $result) . PHP_EOL;
} else {
    echo "No indices found with sum $targetSum" . PHP_EOL;
}

