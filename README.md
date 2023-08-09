# Benchmark Performance of `WP_HTML_Tag_Processor` vs `preg_*`

To run:

```bash
composer install
composer run-script download
composer run-script test
```

Example output:

```
> phpbench run Bench.php --report=default
PHPBench (1.2.14) running benchmarks... #standwithukraine
with PHP version 8.0.28, xdebug ✔, opcache ❌

\Bench

    benchPregReplace........................I4 - Mo172.135μs (±19.44%)
    benchHtmlTagProcessor...................I4 - Mo10.234ms (±2.11%)

Subjects: 2, Assertions: 0, Failures: 0, Errors: 0
+------+-----------+-----------------------+-----+------+------------+--------------+--------------+----------------+
| iter | benchmark | subject               | set | revs | mem_peak   | time_avg     | comp_z_value | comp_deviation |
+------+-----------+-----------------------+-----+------+------------+--------------+--------------+----------------+
| 0    | Bench     | benchPregReplace      |     | 100  | 1,006,336b | 162.350μs    | -0.75σ       | -14.58%        |
| 1    | Bench     | benchPregReplace      |     | 100  | 1,006,336b | 262.350μs    | +1.96σ       | +38.04%        |
| 2    | Bench     | benchPregReplace      |     | 100  | 1,006,336b | 182.850μs    | -0.20σ       | -3.79%         |
| 3    | Bench     | benchPregReplace      |     | 100  | 1,006,336b | 177.820μs    | -0.33σ       | -6.44%         |
| 4    | Bench     | benchPregReplace      |     | 100  | 1,006,336b | 164.920μs    | -0.68σ       | -13.23%        |
| 0    | Bench     | benchHtmlTagProcessor |     | 100  | 1,115,688b | 10,333.340μs | +1.01σ       | +2.13%         |
| 1    | Bench     | benchHtmlTagProcessor |     | 100  | 1,115,688b | 9,983.460μs  | -0.63σ       | -1.33%         |
| 2    | Bench     | benchHtmlTagProcessor |     | 100  | 1,115,688b | 9,779.440μs  | -1.59σ       | -3.35%         |
| 3    | Bench     | benchHtmlTagProcessor |     | 100  | 1,115,688b | 10,161.130μs | +0.20σ       | +0.42%         |
| 4    | Bench     | benchHtmlTagProcessor |     | 100  | 1,115,688b | 10,333.350μs | +1.01σ       | +2.13%         |
+------+-----------+-----------------------+-----+------+------------+--------------+--------------+----------------+
```