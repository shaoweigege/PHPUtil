<?php
/**
 * MIT License
 *
 * Copyright (c) 2018 Dogan Ucar, <dogan@dogan-ucar.de>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace doganoo\PHPUtil\Util;

/**
 * Class ArrayUtil
 *
 * @package doganoo\PHPUtil\Util
 */
final class ArrayUtil {
    /**
     * prevent from instantiation
     * StringUtil constructor.
     */
    private function __construct() {
    }

    /**
     * converts an array to a string using $delimiter as the delimiter between the elements
     *
     * @param array $array
     * @param string $delimiter
     * @return string
     */
    public static function arrayToString(array $array, $delimiter = ""): string {
        $string = "";
        foreach ($array as $value) {
            if (\is_array($value)) {
                $string .= ArrayUtil::arrayToString($value, $delimiter) . $delimiter;
            } else {
                $string .= $value . $delimiter;
            }
        }
        return $string;
    }

    /**
     * returns a boolean that indicates whether a sequence sums up to a value or not
     *
     * @param array $numbers
     * @param int $target
     * @return bool
     */
    public static function hasSum(array $numbers, int $target): bool {
        $collection = ArrayUtil::sumCollection($numbers, $target);
        if (null === $collection) return false;
        if (0 === \count($collection)) return false;
        return true;
    }

    /**
     * returns an array that contains all numbers that sums up to $val
     *
     * @param array $numbers
     * @param int $target
     * @return array|null
     */
    public static function sumCollection(array $numbers, int $target): ?array {
        $size = count($numbers);
        if ($size < 3) return null;
        $collection = [];

        for ($i = 0; $i < $size; $i++) {
            for ($j = $i + 1; $j < $size; $j++) {
                for ($k = $j + 1; $k < $size; $k++) {
                    $sum = $numbers[$i] + $numbers[$j] + $numbers[$k];

                    if ($sum === $target) {
                        $collection[] = [$i, $j, $k];
                        $sum = 0;
                    }
                    if ($sum > $target) continue;
                }
            }
        }
        return $collection;
    }
}