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

    benchPregReplace........................I4 - Mo163.776μs (±2.44%)
    benchHtmlTagProcessor...................I4 - Mo5.681ms (±2.08%)

Subjects: 2, Assertions: 0, Failures: 0, Errors: 0
+------+-----------+-----------------------+-----+------+------------+-------------+--------------+----------------+
| iter | benchmark | subject               | set | revs | mem_peak   | time_avg    | comp_z_value | comp_deviation |
+------+-----------+-----------------------+-----+------+------------+-------------+--------------+----------------+
| 0    | Bench     | benchPregReplace      |     | 100  | 1,006,456b | 173.370μs   | +1.92σ       | +4.69%         |
| 1    | Bench     | benchPregReplace      |     | 100  | 1,006,456b | 161.670μs   | -0.98σ       | -2.38%         |
| 2    | Bench     | benchPregReplace      |     | 100  | 1,006,456b | 164.990μs   | -0.15σ       | -0.37%         |
| 3    | Bench     | benchPregReplace      |     | 100  | 1,006,456b | 163.820μs   | -0.44σ       | -1.08%         |
| 4    | Bench     | benchPregReplace      |     | 100  | 1,006,456b | 164.180μs   | -0.35σ       | -0.86%         |
| 0    | Bench     | benchHtmlTagProcessor |     | 100  | 1,115,816b | 5,650.710μs | +0.40σ       | +0.83%         |
| 1    | Bench     | benchHtmlTagProcessor |     | 100  | 1,115,816b | 5,704.560μs | +0.86σ       | +1.79%         |
| 2    | Bench     | benchHtmlTagProcessor |     | 100  | 1,115,816b | 5,432.330μs | -1.47σ       | -3.06%         |
| 3    | Bench     | benchHtmlTagProcessor |     | 100  | 1,115,816b | 5,730.030μs | +1.08σ       | +2.25%         |
| 4    | Bench     | benchHtmlTagProcessor |     | 100  | 1,115,816b | 5,502.710μs | -0.87σ       | -1.81%         |
+------+-----------+-----------------------+-----+------+------------+-------------+--------------+----------------+
```

Here's increasing the iterations and revolutions via `composer run-script test -- --iterations=10 --revs=500`:

```
> phpbench run Bench.php --report=default '--iterations=10' '--revs=500'
PHPBench (1.2.14) running benchmarks... #standwithukraine
with PHP version 8.0.28, xdebug ✔, opcache ❌

\Bench

    benchPregReplace........................I9 - Mo162.969μs (±11.76%)
    benchHtmlTagProcessor...................I9 - Mo6.341ms (±7.42%)

Subjects: 2, Assertions: 0, Failures: 0, Errors: 0
+------+-----------+-----------------------+-----+------+------------+-------------+--------------+----------------+
| iter | benchmark | subject               | set | revs | mem_peak   | time_avg    | comp_z_value | comp_deviation |
+------+-----------+-----------------------+-----+------+------------+-------------+--------------+----------------+
| 0    | Bench     | benchPregReplace      |     | 500  | 1,006,456b | 162.648μs   | -0.35σ       | -4.12%         |
| 1    | Bench     | benchPregReplace      |     | 500  | 1,006,456b | 158.994μs   | -0.53σ       | -6.27%         |
| 2    | Bench     | benchPregReplace      |     | 500  | 1,006,456b | 160.830μs   | -0.44σ       | -5.19%         |
| 3    | Bench     | benchPregReplace      |     | 500  | 1,006,456b | 164.396μs   | -0.26σ       | -3.09%         |
| 4    | Bench     | benchPregReplace      |     | 500  | 1,006,456b | 167.818μs   | -0.09σ       | -1.07%         |
| 5    | Bench     | benchPregReplace      |     | 500  | 1,006,456b | 165.782μs   | -0.19σ       | -2.27%         |
| 6    | Bench     | benchPregReplace      |     | 500  | 1,006,456b | 162.266μs   | -0.37σ       | -4.34%         |
| 7    | Bench     | benchPregReplace      |     | 500  | 1,006,456b | 160.924μs   | -0.44σ       | -5.13%         |
| 8    | Bench     | benchPregReplace      |     | 500  | 1,006,456b | 163.622μs   | -0.30σ       | -3.54%         |
| 9    | Bench     | benchPregReplace      |     | 500  | 1,006,456b | 229.032μs   | +2.98σ       | +35.02%        |
| 0    | Bench     | benchHtmlTagProcessor |     | 500  | 1,115,816b | 6,195.460μs | -0.37σ       | -2.75%         |
| 1    | Bench     | benchHtmlTagProcessor |     | 500  | 1,115,816b | 5,634.564μs | -1.56σ       | -11.55%        |
| 2    | Bench     | benchHtmlTagProcessor |     | 500  | 1,115,816b | 5,732.946μs | -1.35σ       | -10.01%        |
| 3    | Bench     | benchHtmlTagProcessor |     | 500  | 1,115,816b | 6,439.176μs | +0.14σ       | +1.08%         |
| 4    | Bench     | benchHtmlTagProcessor |     | 500  | 1,115,816b | 6,708.682μs | +0.71σ       | +5.31%         |
| 5    | Bench     | benchHtmlTagProcessor |     | 500  | 1,115,816b | 6,200.056μs | -0.36σ       | -2.68%         |
| 6    | Bench     | benchHtmlTagProcessor |     | 500  | 1,115,816b | 7,291.350μs | +1.95σ       | +14.45%        |
| 7    | Bench     | benchHtmlTagProcessor |     | 500  | 1,115,816b | 6,452.280μs | +0.17σ       | +1.28%         |
| 8    | Bench     | benchHtmlTagProcessor |     | 500  | 1,115,816b | 6,203.808μs | -0.35σ       | -2.62%         |
| 9    | Bench     | benchHtmlTagProcessor |     | 500  | 1,115,816b | 6,847.656μs | +1.01σ       | +7.49%         |
+------+-----------+-----------------------+-----+------+------------+-------------+--------------+----------------+
```

So in these tests, using `preg_*` functions takes 2.57% as much time compared to `WP_HTML_Tag_Processor`. So using
regular expressions is indeed much faster, but at the same time they are much riskier. When deciding between the two
we will have to weigh the pros and cons of performance versus security and correctness.
