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

    benchPregReplaceDocument................I4 - Mo172.566μs (±2.29%)
    benchHtmlTagProcessorDocument...........I4 - Mo5.628ms (±2.57%)
    benchPregReplaceScriptTag...............I4 - Mo3.848μs (±4.86%)
    benchHtmlTagProcessorScriptTag..........I4 - Mo35.582μs (±6.77%)

Subjects: 4, Assertions: 0, Failures: 0, Errors: 0
+------+-----------+--------------------------------+-----+------+------------+-------------+--------------+----------------+
| iter | benchmark | subject                        | set | revs | mem_peak   | time_avg    | comp_z_value | comp_deviation |
+------+-----------+--------------------------------+-----+------+------------+-------------+--------------+----------------+
| 0    | Bench     | benchPregReplaceDocument       |     | 100  | 1,012,632b | 171.880μs   | -0.66σ       | -1.51%         |
| 1    | Bench     | benchPregReplaceDocument       |     | 100  | 1,012,632b | 172.790μs   | -0.43σ       | -0.99%         |
| 2    | Bench     | benchPregReplaceDocument       |     | 100  | 1,012,632b | 173.900μs   | -0.16σ       | -0.36%         |
| 3    | Bench     | benchPregReplaceDocument       |     | 100  | 1,012,632b | 171.690μs   | -0.71σ       | -1.62%         |
| 4    | Bench     | benchPregReplaceDocument       |     | 100  | 1,012,632b | 182.350μs   | +1.96σ       | +4.49%         |
| 0    | Bench     | benchHtmlTagProcessorDocument  |     | 100  | 1,121,992b | 5,674.360μs | -0.28σ       | -0.72%         |
| 1    | Bench     | benchHtmlTagProcessorDocument  |     | 100  | 1,121,992b | 5,822.110μs | +0.73σ       | +1.86%         |
| 2    | Bench     | benchHtmlTagProcessorDocument  |     | 100  | 1,121,992b | 5,943.260μs | +1.55σ       | +3.98%         |
| 3    | Bench     | benchHtmlTagProcessorDocument  |     | 100  | 1,121,992b | 5,564.630μs | -1.03σ       | -2.64%         |
| 4    | Bench     | benchHtmlTagProcessorDocument  |     | 100  | 1,121,992b | 5,573.260μs | -0.97σ       | -2.49%         |
| 0    | Bench     | benchPregReplaceScriptTag      |     | 100  | 980,752b   | 3.820μs     | +0.45σ       | +2.19%         |
| 1    | Bench     | benchPregReplaceScriptTag      |     | 100  | 980,752b   | 3.910μs     | +0.95σ       | +4.60%         |
| 2    | Bench     | benchPregReplaceScriptTag      |     | 100  | 980,752b   | 3.620μs     | -0.65σ       | -3.16%         |
| 3    | Bench     | benchPregReplaceScriptTag      |     | 100  | 980,752b   | 3.440μs     | -1.64σ       | -7.97%         |
| 4    | Bench     | benchPregReplaceScriptTag      |     | 100  | 980,752b   | 3.900μs     | +0.89σ       | +4.33%         |
| 0    | Bench     | benchHtmlTagProcessorScriptTag |     | 100  | 980,752b   | 36.540μs    | -0.04σ       | -0.28%         |
| 1    | Bench     | benchHtmlTagProcessorScriptTag |     | 100  | 980,752b   | 40.680μs    | +1.63σ       | +11.02%        |
| 2    | Bench     | benchHtmlTagProcessorScriptTag |     | 100  | 980,752b   | 34.170μs    | -1.00σ       | -6.75%         |
| 3    | Bench     | benchHtmlTagProcessorScriptTag |     | 100  | 980,752b   | 37.820μs    | +0.47σ       | +3.21%         |
| 4    | Bench     | benchHtmlTagProcessorScriptTag |     | 100  | 980,752b   | 34.000μs    | -1.06σ       | -7.21%         |
+------+-----------+--------------------------------+-----+------+------------+-------------+--------------+----------------+
```

Here's increasing the iterations and revolutions via `composer run-script test -- --iterations=10 --revs=500`:

```
> phpbench run Bench.php --report=default '--iterations=10' '--revs=500'
PHPBench (1.2.14) running benchmarks... #standwithukraine
with PHP version 8.0.28, xdebug ✔, opcache ❌

\Bench

    benchPregReplaceDocument................I9 - Mo170.796μs (±8.08%)
    benchHtmlTagProcessorDocument...........I9 - Mo6.167ms (±12.65%)
    benchPregReplaceScriptTag...............I9 - Mo3.972μs (±6.88%)
    benchHtmlTagProcessorScriptTag..........I9 - Mo43.674μs (±7.63%)

Subjects: 4, Assertions: 0, Failures: 0, Errors: 0
+------+-----------+--------------------------------+-----+------+------------+-------------+--------------+----------------+
| iter | benchmark | subject                        | set | revs | mem_peak   | time_avg    | comp_z_value | comp_deviation |
+------+-----------+--------------------------------+-----+------+------------+-------------+--------------+----------------+
| 0    | Bench     | benchPregReplaceDocument       |     | 500  | 1,012,632b | 165.430μs   | -0.69σ       | -5.58%         |
| 1    | Bench     | benchPregReplaceDocument       |     | 500  | 1,012,632b | 165.204μs   | -0.71σ       | -5.70%         |
| 2    | Bench     | benchPregReplaceDocument       |     | 500  | 1,012,632b | 167.324μs   | -0.56σ       | -4.49%         |
| 3    | Bench     | benchPregReplaceDocument       |     | 500  | 1,012,632b | 161.122μs   | -0.99σ       | -8.03%         |
| 4    | Bench     | benchPregReplaceDocument       |     | 500  | 1,012,632b | 178.980μs   | +0.27σ       | +2.16%         |
| 5    | Bench     | benchPregReplaceDocument       |     | 500  | 1,012,632b | 176.392μs   | +0.08σ       | +0.68%         |
| 6    | Bench     | benchPregReplaceDocument       |     | 500  | 1,012,632b | 173.806μs   | -0.10σ       | -0.80%         |
| 7    | Bench     | benchPregReplaceDocument       |     | 500  | 1,012,632b | 170.104μs   | -0.36σ       | -2.91%         |
| 8    | Bench     | benchPregReplaceDocument       |     | 500  | 1,012,632b | 179.916μs   | +0.33σ       | +2.69%         |
| 9    | Bench     | benchPregReplaceDocument       |     | 500  | 1,012,632b | 213.712μs   | +2.72σ       | +21.98%        |
| 0    | Bench     | benchHtmlTagProcessorDocument  |     | 500  | 1,121,992b | 6,205.614μs | -0.56σ       | -7.05%         |
| 1    | Bench     | benchHtmlTagProcessorDocument  |     | 500  | 1,121,992b | 5,998.362μs | -0.80σ       | -10.15%        |
| 2    | Bench     | benchHtmlTagProcessorDocument  |     | 500  | 1,121,992b | 5,664.802μs | -1.20σ       | -15.15%        |
| 3    | Bench     | benchHtmlTagProcessorDocument  |     | 500  | 1,121,992b | 5,828.444μs | -1.00σ       | -12.70%        |
| 4    | Bench     | benchHtmlTagProcessorDocument  |     | 500  | 1,121,992b | 6,099.154μs | -0.68σ       | -8.65%         |
| 5    | Bench     | benchHtmlTagProcessorDocument  |     | 500  | 1,121,992b | 6,647.214μs | -0.03σ       | -0.44%         |
| 6    | Bench     | benchHtmlTagProcessorDocument  |     | 500  | 1,121,992b | 7,335.862μs | +0.78σ       | +9.88%         |
| 7    | Bench     | benchHtmlTagProcessorDocument  |     | 500  | 1,121,992b | 7,146.024μs | +0.56σ       | +7.04%         |
| 8    | Bench     | benchHtmlTagProcessorDocument  |     | 500  | 1,121,992b | 7,355.010μs | +0.80σ       | +10.17%        |
| 9    | Bench     | benchHtmlTagProcessorDocument  |     | 500  | 1,121,992b | 8,482.808μs | +2.14σ       | +27.06%        |
| 0    | Bench     | benchPregReplaceScriptTag      |     | 500  | 980,752b   | 4.268μs     | +0.70σ       | +4.79%         |
| 1    | Bench     | benchPregReplaceScriptTag      |     | 500  | 980,752b   | 4.112μs     | +0.14σ       | +0.96%         |
| 2    | Bench     | benchPregReplaceScriptTag      |     | 500  | 980,752b   | 4.012μs     | -0.22σ       | -1.49%         |
| 3    | Bench     | benchPregReplaceScriptTag      |     | 500  | 980,752b   | 4.042μs     | -0.11σ       | -0.76%         |
| 4    | Bench     | benchPregReplaceScriptTag      |     | 500  | 980,752b   | 4.038μs     | -0.12σ       | -0.85%         |
| 5    | Bench     | benchPregReplaceScriptTag      |     | 500  | 980,752b   | 4.816μs     | +2.65σ       | +18.25%        |
| 6    | Bench     | benchPregReplaceScriptTag      |     | 500  | 980,752b   | 3.916μs     | -0.56σ       | -3.85%         |
| 7    | Bench     | benchPregReplaceScriptTag      |     | 500  | 980,752b   | 3.864μs     | -0.75σ       | -5.13%         |
| 8    | Bench     | benchPregReplaceScriptTag      |     | 500  | 980,752b   | 3.842μs     | -0.82σ       | -5.67%         |
| 9    | Bench     | benchPregReplaceScriptTag      |     | 500  | 980,752b   | 3.818μs     | -0.91σ       | -6.26%         |
| 0    | Bench     | benchHtmlTagProcessorScriptTag |     | 500  | 980,752b   | 48.380μs    | +0.77σ       | +5.87%         |
| 1    | Bench     | benchHtmlTagProcessorScriptTag |     | 500  | 980,752b   | 42.704μs    | -0.86σ       | -6.55%         |
| 2    | Bench     | benchHtmlTagProcessorScriptTag |     | 500  | 980,752b   | 42.650μs    | -0.87σ       | -6.67%         |
| 3    | Bench     | benchHtmlTagProcessorScriptTag |     | 500  | 980,752b   | 42.698μs    | -0.86σ       | -6.57%         |
| 4    | Bench     | benchHtmlTagProcessorScriptTag |     | 500  | 980,752b   | 45.418μs    | -0.08σ       | -0.61%         |
| 5    | Bench     | benchHtmlTagProcessorScriptTag |     | 500  | 980,752b   | 44.826μs    | -0.25σ       | -1.91%         |
| 6    | Bench     | benchHtmlTagProcessorScriptTag |     | 500  | 980,752b   | 44.734μs    | -0.28σ       | -2.11%         |
| 7    | Bench     | benchHtmlTagProcessorScriptTag |     | 500  | 980,752b   | 52.458μs    | +1.94σ       | +14.79%        |
| 8    | Bench     | benchHtmlTagProcessorScriptTag |     | 500  | 980,752b   | 42.186μs    | -1.01σ       | -7.69%         |
| 9    | Bench     | benchHtmlTagProcessorScriptTag |     | 500  | 980,752b   | 50.930μs    | +1.50σ       | +11.45%        |
+------+-----------+--------------------------------+-----+------+------------+-------------+--------------+----------------+
```

So in these tests, using PREG functions is ~36x faster than `WP_HTML_Tag_Processor` when processing a full HTML document.
And when processing a single HTML tag, PREG is ~11x faster than `WP_HTML_Tag_Processor`.

So using regular expressions is indeed much faster, but at the same time they are much riskier. When deciding between the
two we will have to weigh the pros and cons of performance versus security and correctness.
