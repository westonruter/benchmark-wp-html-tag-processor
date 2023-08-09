# Benchmark `WP_HTML_Tag_Processor` vs `preg_*`

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

Here's increasing the iterations and revolutions via `composer run-script test -- --iterations=10 --revs=500`:

```
> phpbench run Bench.php --report=default '--iterations=10' '--revs=500'
PHPBench (1.2.14) running benchmarks... #standwithukraine
with PHP version 8.0.28, xdebug ✔, opcache ❌

\Bench

    benchPregReplace........................I9 - Mo168.012μs (±6.15%)
    benchHtmlTagProcessor...................I9 - Mo11.556ms (±7.66%)

Subjects: 2, Assertions: 0, Failures: 0, Errors: 0
+------+-----------+-----------------------+-----+------+------------+--------------+--------------+----------------+
| iter | benchmark | subject               | set | revs | mem_peak   | time_avg     | comp_z_value | comp_deviation |
+------+-----------+-----------------------+-----+------+------------+--------------+--------------+----------------+
| 0    | Bench     | benchPregReplace      |     | 500  | 1,006,336b | 164.576μs    | -0.66σ       | -4.09%         |
| 1    | Bench     | benchPregReplace      |     | 500  | 1,006,336b | 165.808μs    | -0.55σ       | -3.37%         |
| 2    | Bench     | benchPregReplace      |     | 500  | 1,006,336b | 176.454μs    | +0.46σ       | +2.84%         |
| 3    | Bench     | benchPregReplace      |     | 500  | 1,006,336b | 167.624μs    | -0.38σ       | -2.31%         |
| 4    | Bench     | benchPregReplace      |     | 500  | 1,006,336b | 201.200μs    | +2.81σ       | +17.26%        |
| 5    | Bench     | benchPregReplace      |     | 500  | 1,006,336b | 169.156μs    | -0.23σ       | -1.42%         |
| 6    | Bench     | benchPregReplace      |     | 500  | 1,006,336b | 170.718μs    | -0.08σ       | -0.51%         |
| 7    | Bench     | benchPregReplace      |     | 500  | 1,006,336b | 167.208μs    | -0.42σ       | -2.55%         |
| 8    | Bench     | benchPregReplace      |     | 500  | 1,006,336b | 162.214μs    | -0.89σ       | -5.46%         |
| 9    | Bench     | benchPregReplace      |     | 500  | 1,006,336b | 170.930μs    | -0.06σ       | -0.38%         |
| 0    | Bench     | benchHtmlTagProcessor |     | 500  | 1,115,688b | 9,824.038μs  | -1.66σ       | -12.68%        |
| 1    | Bench     | benchHtmlTagProcessor |     | 500  | 1,115,688b | 9,892.300μs  | -1.58σ       | -12.07%        |
| 2    | Bench     | benchHtmlTagProcessor |     | 500  | 1,115,688b | 10,556.604μs | -0.81σ       | -6.17%         |
| 3    | Bench     | benchHtmlTagProcessor |     | 500  | 1,115,688b | 12,563.596μs | +1.52σ       | +11.67%        |
| 4    | Bench     | benchHtmlTagProcessor |     | 500  | 1,115,688b | 11,667.518μs | +0.48σ       | +3.70%         |
| 5    | Bench     | benchHtmlTagProcessor |     | 500  | 1,115,688b | 11,256.544μs | +0.01σ       | +0.05%         |
| 6    | Bench     | benchHtmlTagProcessor |     | 500  | 1,115,688b | 11,630.186μs | +0.44σ       | +3.37%         |
| 7    | Bench     | benchHtmlTagProcessor |     | 500  | 1,115,688b | 11,489.310μs | +0.28σ       | +2.12%         |
| 8    | Bench     | benchHtmlTagProcessor |     | 500  | 1,115,688b | 12,218.206μs | +1.12σ       | +8.60%         |
| 9    | Bench     | benchHtmlTagProcessor |     | 500  | 1,115,688b | 11,408.966μs | +0.18σ       | +1.41%         |
+------+-----------+-----------------------+-----+------+------------+--------------+--------------+----------------+
```

So in these tests, using `preg_*` functions takes %1 as much time compared to `WP_HTML_Tag_Processor`.