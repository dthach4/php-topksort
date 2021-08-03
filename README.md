# PHP Top-K Sort

A PHP implementation of an in-place Top-K Sort algorithm, inspired by MongoDB's optimized sort-limit.

## Usage

```
topksort(array $array, int $k);
```

Assuming `$array` is an array of sortable values (i.e. numbers or strings), the function `topksort()` sorts the first `$k` values of `$array` in-place (just like the PHP `sort()` function).

A usage example can be found in the `test.php` script, in which you can find a comparison between the use of this function and a common way to achieve the same result.
