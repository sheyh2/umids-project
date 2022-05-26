<?php
require '../DB/Models/Salary.php';

use DB\Models\Salary;

if (!function_exists('response')) {
    function response(int $code, string $message, ?array $data = null)
    {
        header('Content-type: application/json');
        echo json_encode([
            'status'  => $code,
            'message' => $message,
            'data'    => $data
        ]);
        exit();
    }
}

if (!function_exists('dd')) {
    function dd()
    {
        echo '<pre>';
        array_map(function ($x) {
            var_dump($x);
        }, func_get_args());
        die;
    }
}

$data = [];
$total = [];

foreach ($_POST as $key => $salaries) {
    foreach ($salaries as $id => $salary) {
        if (empty($salary) && $key !== 'total') {
            response(422, $key . ' is required');
        }

        if (strpos($key, 'price') !== false) {
            if (!isset($total[$id])) {
                $total[$id] = 0;
            }

            $total[$id] += (int)$salary;
        }

        if ($key === 'total') {
            $data[$id][$key] = $total[$id];
        } else {
            $data[$id][$key] = $salary;
        }
    }
}

$salary = new Salary();

if ($salary->insert($data)) {
    response(
        200,
        'success',
        $total
    );
} else {
    response(
        400,
        'error',
        $data
    );
}