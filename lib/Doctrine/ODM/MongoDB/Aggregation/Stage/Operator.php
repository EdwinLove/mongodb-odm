<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace Doctrine\ODM\MongoDB\Aggregation\Stage;

use Doctrine\ODM\MongoDB\Aggregation\Builder;
use Doctrine\ODM\MongoDB\Aggregation\Expr;
use Doctrine\ODM\MongoDB\Aggregation\Stage;

/**
 * Fluent interface for adding operators to aggregation stages.
 *
 * @author alcaeus <alcaeus@alcaeus.org>
 * @since 1.2
 * @method $this switch()
 * @method $this case(mixed|Expr $expression)
 * @method $this then(mixed|Expr $expression)
 * @method $this default(mixed|Expr $expression)
 */
abstract class Operator extends Stage
{
    /**
     * @var Expr
     */
    protected $expr;

    /**
     * {@inheritdoc}
     */
    public function __construct(Builder $builder)
    {
        parent::__construct($builder);

        $this->expr = $builder->expr();
    }

    /**
     * @param string $method
     * @param array $args
     * @return $this
     */
    public function __call($method, $args)
    {
        $this->expr->$method(...$args);

        return $this;
    }

    /**
     * Returns the absolute value of a number.
     *
     * The <number> argument can be any valid expression as long as it resolves
     * to a number.
     *
     * @see https://docs.mongodb.org/manual/reference/operator/aggregation/abs/
     * @see Expr::abs
     * @param mixed|Expr $number
     * @return $this
     *
     * @since 1.3
     */
    public function abs($number)
    {
        $this->expr->abs($number);

        return $this;
    }

    /**
     * Adds numbers together or adds numbers and a date. If one of the arguments
     * is a date, $add treats the other arguments as milliseconds to add to the
     * date.
     *
     * The arguments can be any valid expression as long as they resolve to either all numbers or to numbers and a date.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/add/
     * @see Expr::add
     * @param mixed|Expr $expression1
     * @param mixed|Expr $expression2
     * @param mixed|Expr $expression3,... Additional expressions
     * @return $this
     */
    public function add($expression1, $expression2 /* , $expression3, ... */)
    {
        $this->expr->add(...func_get_args());

        return $this;
    }

    /**
     * Add one or more $and clauses to the current expression.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/and/
     * @see Expr::addAnd
     * @param array|Expr $expression
     * @return $this
     */
    public function addAnd($expression /* , $expression2, ... */)
    {
        $this->expr->addAnd(...func_get_args());

        return $this;
    }

    /**
     * Add one or more $or clauses to the current expression.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/or/
     * @see Expr::addOr
     * @param array|Expr $expression
     * @return $this
     */
    public function addOr($expression /* , $expression2, ... */)
    {
        $this->expr->addOr(...func_get_args());

        return $this;
    }

    /**
     * Evaluates an array as a set and returns true if no element in the array
     * is false. Otherwise, returns false. An empty array returns true.
     *
     * The expression must resolve to an array.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/allElementsTrue/
     * @see Expr::allElementsTrue
     * @param mixed|Expr $expression
     * @return $this
     */
    public function allElementsTrue($expression)
    {
        $this->expr->allElementsTrue($expression);

        return $this;
    }

    /**
     * Evaluates an array as a set and returns true if any of the elements are
     * true and false otherwise. An empty array returns false.
     *
     * The expression must resolve to an array.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/anyElementTrue/
     * @see Expr::anyElementTrue
     * @param array|Expr $expression
     * @return $this
     */
    public function anyElementTrue($expression)
    {
        $this->expr->anyElementTrue($expression);

        return $this;
    }

    /**
     * Returns the element at the specified array index.
     *
     * The <array> expression can be any valid expression as long as it resolves
     * to an array.
     * The <idx> expression can be any valid expression as long as it resolves
     * to an integer.
     *
     * @see https://docs.mongodb.org/manual/reference/operator/aggregation/arrayElemAt/
     * @see Expr::arrayElemAt
     * @param mixed|Expr $array
     * @param mixed|Expr $index
     * @return $this
     *
     * @since 1.3
     */
    public function arrayElemAt($array, $index)
    {
        $this->expr->arrayElemAt($array, $index);

        return $this;
    }

    /**
     * Returns the smallest integer greater than or equal to the specified number.
     *
     * The <number> expression can be any valid expression as long as it
     * resolves to a number.
     *
     * @see https://docs.mongodb.org/manual/reference/operator/aggregation/ceil/
     * @see Expr::ceil
     * @param mixed|Expr $number
     * @return $this
     *
     * @since 1.3
     */
    public function ceil($number)
    {
        $this->expr->ceil($number);

        return $this;
    }

    /**
     * Compares two values and returns:
     * -1 if the first value is less than the second.
     * 1 if the first value is greater than the second.
     * 0 if the two values are equivalent.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/cmp/
     * @see Expr::cmp
     * @param mixed|Expr $expression1
     * @param mixed|Expr $expression2
     * @return $this
     */
    public function cmp($expression1, $expression2)
    {
        $this->expr->cmp($expression1, $expression2);

        return $this;
    }

    /**
     * Concatenates strings and returns the concatenated string.
     *
     * The arguments can be any valid expression as long as they resolve to
     * strings. If the argument resolves to a value of null or refers to a field
     * that is missing, $concat returns null.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/concat/
     * @see Expr::concat
     * @param mixed|Expr $expression1
     * @param mixed|Expr $expression2
     * @param mixed|Expr $expression3,... Additional expressions
     * @return $this
     */
    public function concat($expression1, $expression2 /* , $expression3, ... */)
    {
        $this->expr->concat(...func_get_args());

        return $this;
    }

    /**
     * Concatenates arrays to return the concatenated array.
     *
     * The <array> expressions can be any valid expression as long as they
     * resolve to an array.
     *
     * @see https://docs.mongodb.org/manual/reference/operator/aggregation/concatArrays/
     * @see Expr::concatArrays
     * @param mixed|Expr $array1
     * @param mixed|Expr $array2
     * @param mixed|Expr $array3, ... Additional expressions
     * @return $this
     *
     * @since 1.3
     */
    public function concatArrays($array1, $array2 /* , $array3, ... */)
    {
        $this->expr->concatArrays(...func_get_args());

        return $this;
    }

    /**
     * Evaluates a boolean expression to return one of the two specified return
     * expressions.
     *
     * The arguments can be any valid expression.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/cond/
     * @see Expr::cond
     * @param mixed|Expr $if
     * @param mixed|Expr $then
     * @param mixed|Expr $else
     * @return $this
     */
    public function cond($if, $then, $else)
    {
        $this->expr->cond($if, $then, $else);

        return $this;
    }

    /**
     * Converts a date object to a string according to a user-specified format.
     *
     * The format string can be any string literal, containing 0 or more format
     * specifiers.
     * The date argument can be any expression as long as it resolves to a date.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/dateToString/
     * @see Expr::dateToString
     * @param string $format
     * @param mixed|Expr $expression
     * @return $this
     */
    public function dateToString($format, $expression)
    {
        $this->expr->dateToString($format, $expression);

        return $this;
    }

    /**
     * Returns the day of the month for a date as a number between 1 and 31.
     *
     * The argument can be any expression as long as it resolves to a date.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/dayOfMonth/
     * @see Expr::dayOfMonth
     * @param mixed|Expr $expression
     * @return $this
     */
    public function dayOfMonth($expression)
    {
        $this->expr->dayOfMonth($expression);

        return $this;
    }

    /**
     * Returns the day of the week for a date as a number between 1 (Sunday) and
     * 7 (Saturday).
     *
     * The argument can be any expression as long as it resolves to a date.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/dayOfWeek/
     * @see Expr::dayOfWeek
     * @param mixed|Expr $expression
     * @return $this
     */
    public function dayOfWeek($expression)
    {
        $this->expr->dayOfWeek($expression);

        return $this;
    }

    /**
     * Returns the day of the year for a date as a number between 1 and 366.
     *
     * The argument can be any expression as long as it resolves to a date.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/dayOfYear/
     * @see Expr::dayOfYear
     * @param mixed|Expr $expression
     * @return $this
     */
    public function dayOfYear($expression)
    {
        $this->expr->dayOfYear($expression);

        return $this;
    }

    /**
     * Divides one number by another and returns the result. The first argument
     * is divided by the second argument.
     *
     * The arguments can be any valid expression as long as the resolve to numbers.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/divide/
     * @see Expr::divide
     * @param mixed|Expr $expression1
     * @param mixed|Expr $expression2
     * @return $this
     */
    public function divide($expression1, $expression2)
    {
        $this->expr->divide($expression1, $expression2);

        return $this;
    }

    /**
     * Compares two values and returns whether they are equivalent.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/eq/
     * @see Expr::eq
     * @param mixed|Expr $expression1
     * @param mixed|Expr $expression2
     * @return $this
     */
    public function eq($expression1, $expression2)
    {
        $this->expr->eq($expression1, $expression2);

        return $this;
    }

    /**
     * Raises Euler’s number to the specified exponent and returns the result.
     *
     * The <exponent> expression can be any valid expression as long as it
     * resolves to a number.
     *
     * @see https://docs.mongodb.org/manual/reference/operator/aggregation/exp/
     * @see Expr::exp
     * @param mixed|Expr $exponent
     * @return $this
     *
     * @since 1.3
     */
    public function exp($exponent)
    {
        $this->expr->exp($exponent);

        return $this;
    }

    /**
     * Used to use an expression as field value. Can be any expression
     *
     * @see http://docs.mongodb.org/manual/meta/aggregation-quick-reference/#aggregation-expressions
     * @see Expr::expression
     * @param mixed|Expr $value
     * @return $this
     */
    public function expression($value)
    {
        $this->expr->expression($value);

        return $this;
    }

    /**
     * Set the current field for building the expression.
     *
     * @see Expr::field
     * @param string $fieldName
     * @return $this
     */
    public function field($fieldName)
    {
        $this->expr->field($fieldName);

        return $this;
    }

    /**
     * Selects a subset of the array to return based on the specified condition.
     *
     * Returns an array with only those elements that match the condition. The
     * returned elements are in the original order.
     *
     * @see https://docs.mongodb.org/manual/reference/operator/aggregation/filter/
     * @see Expr::filter
     * @param mixed|Expr $input
     * @param mixed|Expr $as
     * @param mixed|Expr $cond
     * @return $this
     *
     * @since 1.3
     */
    public function filter($input, $as, $cond)
    {
        $this->expr->filter($input, $as, $cond);

        return $this;
    }

    /**
     * Returns the largest integer less than or equal to the specified number.
     *
     * The <number> expression can be any valid expression as long as it
     * resolves to a number.
     *
     * @see https://docs.mongodb.org/manual/reference/operator/aggregation/floor/
     * @see Expr::floor
     * @param mixed|Expr $number
     * @return $this
     *
     * @since 1.3
     */
    public function floor($number)
    {
        $this->expr->floor($number);

        return $this;
    }

    /**
     * Compares two values and returns:
     * true when the first value is greater than the second value.
     * false when the first value is less than or equivalent to the second value.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/gt/
     * @see Expr::gt
     * @param mixed|Expr $expression1
     * @param mixed|Expr $expression2
     * @return $this
     */
    public function gt($expression1, $expression2)
    {
        $this->expr->gt($expression1, $expression2);

        return $this;
    }

    /**
     * Compares two values and returns:
     * true when the first value is greater than or equivalent to the second value.
     * false when the first value is less than the second value.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/gte/
     * @see Expr::gte
     * @param mixed|Expr $expression1
     * @param mixed|Expr $expression2
     * @return $this
     */
    public function gte($expression1, $expression2)
    {
        $this->expr->gte($expression1, $expression2);

        return $this;
    }

    /**
     * Returns the hour portion of a date as a number between 0 and 23.
     *
     * The argument can be any expression as long as it resolves to a date.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/hour/
     * @see Expr::hour
     * @param mixed|Expr $expression
     * @return $this
     */
    public function hour($expression)
    {
        $this->expr->hour($expression);

        return $this;
    }

    /**
     * Returns a boolean indicating whether a specified value is in an array.
     *
     * Unlike the $in query operator, the aggregation $in operator does not
     * support matching by regular expressions.
     *
     * @see https://docs.mongodb.com/manual/reference/operator/aggregation/in/
     * @see Expr::in
     * @since 1.5
     * @param mixed|Expr $expression
     * @param mixed|Expr $arrayExpression
     * @return $this
     */
    public function in($expression, $arrayExpression)
    {
        $this->expr->in($expression, $arrayExpression);

        return $this;
    }

    /**
     * Searches an array for an occurence of a specified value and returns the
     * array index (zero-based) of the first occurence. If the value is not
     * found, returns -1.
     *
     * @see https://docs.mongodb.com/manual/reference/operator/aggregation/indexOfArray/
     * @see Expr::indexOfArray
     * @since 1.5
     * @param mixed|Expr $arrayExpression Can be any valid expression as long as it resolves to an array.
     * @param mixed|Expr $searchExpression Can be any valid expression.
     * @param mixed|Expr $start Optional. An integer, or a number that can be represented as integers (such as 2.0), that specifies the starting index position for the search. Can be any valid expression that resolves to a non-negative integral number.
     * @param mixed|Expr $end An integer, or a number that can be represented as integers (such as 2.0), that specifies the ending index position for the search. Can be any valid expression that resolves to a non-negative integral number.
     * @return $this
     */
    public function indexOfArray($arrayExpression, $searchExpression, $start = null, $end = null)
    {
        $this->expr->indexOfArray($arrayExpression, $searchExpression, $start, $end);

        return $this;
    }

    /**
     * Searches a string for an occurence of a substring and returns the UTF-8
     * byte index (zero-based) of the first occurence. If the substring is not
     * found, returns -1.
     *
     * @see https://docs.mongodb.com/manual/reference/operator/aggregation/indexOfBytes/
     * @since 1.5
     * @param mixed|Expr $stringExpression Can be any valid expression as long as it resolves to a string.
     * @param mixed|Expr $substringExpression Can be any valid expression as long as it resolves to a string.
     * @param int|null $start An integral number that specifies the starting index position for the search. Can be any valid expression that resolves to a non-negative integral number.
     * @param int|null $end An integral number that specifies the ending index position for the search. Can be any valid expression that resolves to a non-negative integral number.
     *
     * @return $this
     */
    public function indexOfBytes($stringExpression, $substringExpression, $start = null, $end = null)
    {
        $this->expr->indexOfBytes($stringExpression, $substringExpression, $start, $end);

        return $this;
    }

    /**
     * Searches a string for an occurence of a substring and returns the UTF-8
     * code point index (zero-based) of the first occurence. If the substring is
     * not found, returns -1.
     *
     * @see https://docs.mongodb.com/manual/reference/operator/aggregation/indexOfCP/
     * @since 1.5
     * @param mixed|Expr $stringExpression Can be any valid expression as long as it resolves to a string.
     * @param mixed|Expr $substringExpression Can be any valid expression as long as it resolves to a string.
     * @param int|null $start An integral number that specifies the starting index position for the search. Can be any valid expression that resolves to a non-negative integral number.
     * @param int|null $end An integral number that specifies the ending index position for the search. Can be any valid expression that resolves to a non-negative integral number.
     *
     * @return $this
     */
    public function indexOfCP($stringExpression, $substringExpression, $start = null, $end = null)
    {
        $this->expr->indexOfCP($stringExpression, $substringExpression, $start, $end);

        return $this;
    }

    /**
     * Evaluates an expression and returns the value of the expression if the
     * expression evaluates to a non-null value. If the expression evaluates to
     * a null value, including instances of undefined values or missing fields,
     * returns the value of the replacement expression.
     *
     * The arguments can be any valid expression.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/ifNull/
     * @see Expr::ifNull
     * @param mixed|Expr $expression
     * @param mixed|Expr $replacementExpression
     * @return $this
     */
    public function ifNull($expression, $replacementExpression)
    {
        $this->expr->ifNull($expression, $replacementExpression);

        return $this;
    }

    /**
     * Determines if the operand is an array. Returns a boolean.
     *
     * The <expression> can be any valid expression.
     *
     * @see https://docs.mongodb.org/manual/reference/operator/aggregation/isArray/
     * @see Expr::isArray
     * @param mixed|Expr $expression
     * @return $this
     *
     * @since 1.3
     */
    public function isArray($expression)
    {
        $this->expr->isArray($expression);

        return $this;
    }

    /**
     * Returns the weekday number in ISO 8601 format, ranging from 1 (for Monday)
     * to 7 (for Sunday).
     *
     * The argument can be any expression as long as it resolves to a date.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/isoDayOfWeek/
     * @since 1.5
     * @param mixed|Expr $expression
     * @return $this
     */
    public function isoDayOfWeek($expression)
    {
        $this->expr->isoDayOfWeek($expression);

        return $this;
    }

    /**
     * Returns the week number in ISO 8601 format, ranging from 1 to 53.
     *
     * Week numbers start at 1 with the week (Monday through Sunday) that
     * contains the year’s first Thursday.
     *
     * The argument can be any expression as long as it resolves to a date.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/isoWeek/
     * @since 1.5
     * @param mixed|Expr $expression
     * @return $this
     */
    public function isoWeek($expression)
    {
        $this->expr->isoWeek($expression);

        return $this;
    }

    /**
     * Returns the year number in ISO 8601 format.
     *
     * The year starts with the Monday of week 1 (ISO 8601) and ends with the
     * Sunday of the last week (ISO 8601).
     *
     * The argument can be any expression as long as it resolves to a date.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/isoWeek/
     * @since 1.5
     * @param mixed|Expr $expression
     * @return $this
     */
    public function isoWeekYear($expression)
    {
        $this->expr->isoWeekYear($expression);

        return $this;
    }

    /**
     * Binds variables for use in the specified expression, and returns the
     * result of the expression.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/let/
     * @see Expr::let
     * @param mixed|Expr $vars Assignment block for the variables accessible in the in expression. To assign a variable, specify a string for the variable name and assign a valid expression for the value.
     * @param mixed|Expr $in   The expression to evaluate.
     * @return $this
     */
    public function let($vars, $in)
    {
        $this->expr->let($vars, $in);

        return $this;
    }

    /**
     * Returns a value without parsing. Use for values that the aggregation
     * pipeline may interpret as an expression.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/literal/
     * @see Expr::literal
     * @param mixed|Expr $value
     * @return $this
     */
    public function literal($value)
    {
        $this->expr->literal($value);

        return $this;
    }

    /**
     * Calculates the natural logarithm ln (i.e loge) of a number and returns
     * the result as a double.
     *
     * The <number> expression can be any valid expression as long as it
     * resolves to a non-negative number.
     *
     * @see https://docs.mongodb.org/manual/reference/operator/aggregation/log/
     * @see Expr::ln
     * @param mixed|Expr $number
     * @return $this
     *
     * @since 1.3
     */
    public function ln($number)
    {
        $this->expr->ln($number);

        return $this;
    }

    /**
     * Calculates the log of a number in the specified base and returns the
     * result as a double.
     *
     * The <number> expression can be any valid expression as long as it
     * resolves to a non-negative number.
     * The <base> expression can be any valid expression as long as it resolves
     * to a positive number greater than 1.
     *
     * @see https://docs.mongodb.org/manual/reference/operator/aggregation/log/
     * @see Expr::log
     * @param mixed|Expr $number
     * @param mixed|Expr $base
     * @return $this
     *
     * @since 1.3
     */
    public function log($number, $base)
    {
        $this->expr->log($number, $base);

        return $this;
    }

    /**
     * Calculates the log base 10 of a number and returns the result as a double.
     *
     * The <number> expression can be any valid expression as long as it
     * resolves to a non-negative number.
     * The <base> expression can be any valid expression as long as it resolves
     * to a positive number greater than 1.
     *
     * @see https://docs.mongodb.org/manual/reference/operator/aggregation/log/
     * @see Expr::log10
     * @param mixed|Expr $number
     * @return $this
     *
     * @since 1.3
     */
    public function log10($number)
    {
        $this->expr->log10($number);

        return $this;
    }

    /**
     * Compares two values and returns:
     * true when the first value is less than the second value.
     * false when the first value is greater than or equivalent to the second value.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/lt/
     * @see Expr::lt
     * @param mixed|Expr $expression1
     * @param mixed|Expr $expression2
     * @return $this
     */
    public function lt($expression1, $expression2)
    {
        $this->expr->lt($expression1, $expression2);

        return $this;
    }

    /**
     * Compares two values and returns:
     * true when the first value is less than or equivalent to the second value.
     * false when the first value is greater than the second value.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/lte/
     * @see Expr::lte
     * @param mixed|Expr $expression1
     * @param mixed|Expr $expression2
     * @return $this
     */
    public function lte($expression1, $expression2)
    {
        $this->expr->lte($expression1, $expression2);

        return $this;
    }

    /**
     * Applies an expression to each item in an array and returns an array with
     * the applied results.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/map/
     * @see Expr::map
     * @param mixed|Expr $input An expression that resolves to an array.
     * @param string $as        The variable name for the items in the input array. The in expression accesses each item in the input array by this variable.
     * @param mixed|Expr $in    The expression to apply to each item in the input array. The expression accesses the item by its variable name.
     * @return $this
     */
    public function map($input, $as, $in)
    {
        $this->expr->map($input, $as, $in);

        return $this;
    }

    /**
     * Returns the metadata associated with a document in a pipeline operations.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/meta/
     * @see Expr::meta
     * @param $metaDataKeyword
     * @return $this
     */
    public function meta($metaDataKeyword)
    {
        $this->expr->meta($metaDataKeyword);

        return $this;
    }

    /**
     * Returns the millisecond portion of a date as an integer between 0 and 999.
     *
     * The argument can be any expression as long as it resolves to a date.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/millisecond/
     * @see Expr::millisecond
     * @param mixed|Expr $expression
     * @return $this
     */
    public function millisecond($expression)
    {
        $this->expr->millisecond($expression);

        return $this;
    }

    /**
     * Returns the minute portion of a date as a number between 0 and 59.
     *
     * The argument can be any expression as long as it resolves to a date.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/minute/
     * @see Expr::minute
     * @param mixed|Expr $expression
     * @return $this
     */
    public function minute($expression)
    {
        $this->expr->minute($expression);

        return $this;
    }

    /**
     * Divides one number by another and returns the remainder. The first
     * argument is divided by the second argument.
     *
     * The arguments can be any valid expression as long as they resolve to numbers.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/mod/
     * @see Expr::mod
     * @param mixed|Expr $expression1
     * @param mixed|Expr $expression2
     * @return $this
     */
    public function mod($expression1, $expression2)
    {
        $this->expr->mod($expression1, $expression2);

        return $this;
    }

    /**
     * Returns the month of a date as a number between 1 and 12.
     *
     * The argument can be any expression as long as it resolves to a date.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/month/
     * @see Expr::month
     * @param mixed|Expr $expression
     * @return $this
     */
    public function month($expression)
    {
        $this->expr->month($expression);

        return $this;
    }

    /**
     * Multiplies numbers together and returns the result.
     *
     * The arguments can be any valid expression as long as they resolve to numbers.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/multiply/
     * @see Expr::multiply
     * @param mixed|Expr $expression1
     * @param mixed|Expr $expression2
     * @param mixed|Expr $expression3,... Additional expressions
     * @return $this
     */
    public function multiply($expression1, $expression2 /* , $expression3, ... */)
    {
        $this->expr->multiply(...func_get_args());

        return $this;
    }

    /**
     * Compares two values and returns:
     * true when the values are not equivalent.
     * false when the values are equivalent.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/ne/
     * @see Expr::ne
     * @param mixed|Expr $expression1
     * @param mixed|Expr $expression2
     * @return $this
     */
    public function ne($expression1, $expression2)
    {
        $this->expr->ne($expression1, $expression2);

        return $this;
    }

    /**
     * Evaluates a boolean and returns the opposite boolean value.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/not/
     * @see Expr::not
     * @param mixed|Expr $expression
     * @return $this
     */
    public function not($expression)
    {
        $this->expr->not($expression);

        return $this;
    }

    /**
     * Raises a number to the specified exponent and returns the result.
     *
     * The <number> expression can be any valid expression as long as it
     * resolves to a non-negative number.
     * The <exponent> expression can be any valid expression as long as it
     * resolves to a number.
     *
     * @see https://docs.mongodb.org/manual/reference/operator/aggregation/pow/
     * @see Expr::pow
     * @param mixed|Expr $number
     * @param mixed|Expr $exponent
     * @return $this
     *
     * @since 1.3
     */
    public function pow($number, $exponent)
    {
        $this->expr->pow($number, $exponent);

        return $this;
    }

    /**
     * Returns an array whose elements are a generated sequence of numbers.
     *
     * $range generates the sequence from the specified starting number by successively incrementing the starting number by the specified step value up to but not including the end point.
     *
     * @see https://docs.mongodb.com/manual/reference/operator/aggregation/range/
     * @see Expr::range
     * @since 1.5
     * @param mixed|Expr $start An integer that specifies the start of the sequence. Can be any valid expression that resolves to an integer.
     * @param mixed|Expr $end An integer that specifies the exclusive upper limit of the sequence. Can be any valid expression that resolves to an integer.
     * @param mixed|Expr $step Optional. An integer that specifies the increment value. Can be any valid expression that resolves to a non-zero integer. Defaults to 1.
     * @return $this
     */
    public function range($start, $end, $step = 1)
    {
        $this->expr->range($start, $end, $step);

        return $this;
    }

    /**
     * Applies an expression to each element in an array and combines them into
     * a single value.
     *
     * @see https://docs.mongodb.com/manual/reference/operator/aggregation/reduce/
     * @see Expr::reduce
     * @since 1.5
     * @param mixed|Expr $input Can be any valid expression that resolves to an array.
     * @param mixed|Expr $initialValue The initial cumulative value set before in is applied to the first element of the input array.
     * @param mixed|Expr $in A valid expression that $reduce applies to each element in the input array in left-to-right order. Wrap the input value with $reverseArray to yield the equivalent of applying the combining expression from right-to-left.
     * @return $this
     */
    public function reduce($input, $initialValue, $in)
    {
        $this->expr->reduce($input, $initialValue, $in);

        return $this;
    }

    /**
     * Accepts an array expression as an argument and returns an array with the
     * elements in reverse order.
     *
     * @see https://docs.mongodb.com/manual/reference/operator/aggregation/reverseArray/
     * @see Expr::reverseArray
     * @since 1.5
     * @param mixed|Expr $expression
     * @return $this
     */
    public function reverseArray($expression)
    {
        $this->expr->reverseArray($expression);

        return $this;
    }

    /**
     * Returns the second portion of a date as a number between 0 and 59, but
     * can be 60 to account for leap seconds.
     *
     * The argument can be any expression as long as it resolves to a date.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/second/
     * @see Expr::second
     * @param mixed|Expr $expression
     * @return $this
     */
    public function second($expression)
    {
        $this->expr->second($expression);

        return $this;
    }

    /**
     * Takes two sets and returns an array containing the elements that only
     * exist in the first set.
     *
     * The arguments can be any valid expression as long as they each resolve to an array.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/setDifference/
     * @see Expr::setDifference
     * @param mixed|Expr $expression1
     * @param mixed|Expr $expression2
     * @return $this
     */
    public function setDifference($expression1, $expression2)
    {
        $this->expr->setDifference($expression1, $expression2);

        return $this;
    }

    /**
     * Compares two or more arrays and returns true if they have the same
     * distinct elements and false otherwise.
     *
     * The arguments can be any valid expression as long as they each resolve to an array.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/setEquals/
     * @see Expr::setEquals
     * @param mixed|Expr $expression1
     * @param mixed|Expr $expression2
     * @param mixed|Expr $expression3,...   Additional sets
     * @return $this
     */
    public function setEquals($expression1, $expression2 /* , $expression3, ... */)
    {
        $this->expr->setEquals(...func_get_args());

        return $this;
    }

    /**
     * Takes two or more arrays and returns an array that contains the elements
     * that appear in every input array.
     *
     * The arguments can be any valid expression as long as they each resolve to an array.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/setIntersection/
     * @see Expr::setIntersection
     * @param mixed|Expr $expression1
     * @param mixed|Expr $expression2
     * @param mixed|Expr $expression3,...   Additional sets
     * @return $this
     */
    public function setIntersection($expression1, $expression2 /* , $expression3, ... */)
    {
        $this->expr->setIntersection(...func_get_args());

        return $this;
    }

    /**
     * Takes two arrays and returns true when the first array is a subset of the
     * second, including when the first array equals the second array, and false
     * otherwise.
     *
     * The arguments can be any valid expression as long as they each resolve to an array.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/setIsSubset/
     * @see Expr::setIsSubset
     * @param mixed|Expr $expression1
     * @param mixed|Expr $expression2
     * @return $this
     */
    public function setIsSubset($expression1, $expression2)
    {
        $this->expr->setIsSubset($expression1, $expression2);

        return $this;
    }

    /**
     * Takes two or more arrays and returns an array containing the elements
     * that appear in any input array.
     *
     * The arguments can be any valid expression as long as they each resolve to an array.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/setUnion/
     * @see Expr::setUnion
     * @param mixed|Expr $expression1
     * @param mixed|Expr $expression2
     * @param mixed|Expr $expression3,...   Additional sets
     * @return $this
     */
    public function setUnion($expression1, $expression2 /* , $expression3, ... */)
    {
        $this->expr->setUnion(...func_get_args());

        return $this;
    }

    /**
     * Counts and returns the total the number of items in an array.
     *
     * The argument can be any expression as long as it resolves to an array.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/size/
     * @see Expr::size
     * @param mixed|Expr $expression
     * @return $this
     */
    public function size($expression)
    {
        $this->expr->size($expression);

        return $this;
    }

    /**
     * Returns a subset of an array.
     *
     * @see https://docs.mongodb.org/manual/reference/operator/aggregation/slice/
     * @see Expr::slice
     * @param mixed|Expr $array
     * @param mixed|Expr $n
     * @param mixed|Expr|null $position
     * @return $this
     *
     * @since 1.3
     */
    public function slice($array, $n, $position = null)
    {
        $this->expr->slice($array, $n, $position);

        return $this;
    }

    /**
     * Divides a string into an array of substrings based on a delimiter.
     *
     * $split removes the delimiter and returns the resulting substrings as
     * elements of an array. If the delimiter is not found in the string, $split
     * returns the original string as the only element of an array.
     *
     * @see https://docs.mongodb.com/manual/reference/operator/aggregation/split/
     * @since 1.5
     * @param mixed|Expr $string The string to be split. Can be any valid expression as long as it resolves to a string.
     * @param mixed|Expr $delimiter The delimiter to use when splitting the string expression. Can be any valid expression as long as it resolves to a string.
     *
     * @return $this
     */
    public function split($string, $delimiter)
    {
        $this->expr->split($string, $delimiter);

        return $this;
    }

    /**
     * Calculates the square root of a positive number and returns the result as
     * a double.
     *
     * The argument can be any valid expression as long as it resolves to a
     * non-negative number.
     *
     * @see https://docs.mongodb.org/manual/reference/operator/aggregation/sqrt/
     * @see Expr::sqrt
     * @param mixed|Expr $expression
     * @return $this
     */
    public function sqrt($expression)
    {
        $this->expr->sqrt($expression);

        return $this;
    }

    /**
     * Performs case-insensitive comparison of two strings. Returns
     * 1 if first string is “greater than” the second string.
     * 0 if the two strings are equal.
     * -1 if the first string is “less than” the second string.
     *
     * The arguments can be any valid expression as long as they resolve to strings.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/strcasecmp/
     * @see Expr::strcasecmp
     * @param mixed|Expr $expression1
     * @param mixed|Expr $expression2
     * @return $this
     */
    public function strcasecmp($expression1, $expression2)
    {
        $this->expr->strcasecmp($expression1, $expression2);

        return $this;
    }

    /**
     * Returns the number of UTF-8 encoded bytes in the specified string.
     *
     * @see https://docs.mongodb.com/manual/reference/operator/aggregation/strLenBytes/
     * @since 1.5
     * @param mixed|Expr $string
     *
     * @return $this
     */
    public function strLenBytes($string)
    {
        $this->expr->strLenBytes($string);

        return $this;
    }

    /**
     * Returns the number of UTF-8 code points in the specified string.
     *
     * @see https://docs.mongodb.com/manual/reference/operator/aggregation/strLenCP/
     * @since 1.5
     * @param mixed|Expr $string
     *
     * @return $this
     */
    public function strLenCP($string)
    {
        $this->expr->strLenCP($string);

        return $this;
    }

    /**
     * Returns a substring of a string, starting at a specified index position
     * and including the specified number of characters. The index is zero-based.
     *
     * The arguments can be any valid expression as long as long as the first argument resolves to a string, and the second and third arguments resolve to integers.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/substr/
     * @see Expr::substr
     * @param mixed|Expr $string
     * @param mixed|Expr $start
     * @param mixed|Expr $length
     * @return $this
     */
    public function substr($string, $start, $length)
    {
        $this->expr->substr($string, $start, $length);

        return $this;
    }

    /**
     * Returns the substring of a string.
     *
     * The substring starts with the character at the specified UTF-8 byte index
     * (zero-based) in the string and continues for the number of bytes
     * specified.
     *
     * @see https://docs.mongodb.com/manual/reference/operator/aggregation/substrBytes/
     * @since 1.5
     * @param mixed|Expr $string The string from which the substring will be extracted. Can be any valid expression as long as it resolves to a string.
     * @param mixed|Expr $start Indicates the starting point of the substring. Can be any valid expression as long as it resolves to a non-negative integer or number that can be represented as an integer.
     * @param mixed|Expr $count Can be any valid expression as long as it resolves to a non-negative integer or number that can be represented as an integer.
     *
     * @return $this
     */
    public function substrBytes($string, $start, $count)
    {
        $this->expr->substrBytes($string, $start, $count);

        return $this;
    }

    /**
     * Returns the substring of a string.
     *
     * The substring starts with the character at the specified UTF-8 code point
     * (CP) index (zero-based) in the string for the number of code points
     * specified.
     *
     * @see https://docs.mongodb.com/manual/reference/operator/aggregation/substrBytes/
     * @since 1.5
     * @param mixed|Expr $string The string from which the substring will be extracted. Can be any valid expression as long as it resolves to a string.
     * @param mixed|Expr $start Indicates the starting point of the substring. Can be any valid expression as long as it resolves to a non-negative integer or number that can be represented as an integer.
     * @param mixed|Expr $count Can be any valid expression as long as it resolves to a non-negative integer or number that can be represented as an integer.
     *
     * @return $this
     */
    public function substrCP($string, $start, $count)
    {
        $this->expr->substrCP($string, $start, $count);

        return $this;
    }

    /**
     * Subtracts two numbers to return the difference. The second argument is
     * subtracted from the first argument.
     *
     * The arguments can be any valid expression as long as they resolve to numbers and/or dates.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/subtract/
     * @see Expr::subtract
     * @param mixed|Expr $expression1
     * @param mixed|Expr $expression2
     * @return $this
     */
    public function subtract($expression1, $expression2)
    {
        $this->expr->subtract($expression1, $expression2);

        return $this;
    }

    /**
     * Converts a string to lowercase, returning the result.
     *
     * The argument can be any expression as long as it resolves to a string.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/toLower/
     * @see Expr::toLower
     * @param mixed|Expr $expression
     * @return $this
     */
    public function toLower($expression)
    {
        $this->expr->toLower($expression);

        return $this;
    }

    /**
     * Converts a string to uppercase, returning the result.
     *
     * The argument can be any expression as long as it resolves to a string.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/toUpper/
     * @see Expr::toUpper
     * @param mixed|Expr $expression
     * @return $this
     */
    public function toUpper($expression)
    {
        $this->expr->toUpper($expression);

        return $this;
    }

    /**
     * Truncates a number to its integer.
     *
     * The <number> expression can be any valid expression as long as it
     * resolves to a number.
     *
     * @see https://docs.mongodb.org/manual/reference/operator/aggregation/trunc/
     * @see Expr::trunc
     * @param mixed|Expr $number
     * @return $this
     *
     * @since 1.3
     */
    public function trunc($number)
    {
        $this->expr->trunc($number);

        return $this;
    }

    /**
     * Returns a string that specifies the BSON type of the argument.
     *
     * The argument can be any valid expression.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/type/
     * @since 1.5
     * @param mixed|Expr $expression
     *
     * @return $this
     */
    public function type($expression)
    {
        $this->expr->type($expression);

        return $this;
    }

    /**
     * Returns the week of the year for a date as a number between 0 and 53.
     *
     * The argument can be any expression as long as it resolves to a date.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/week/
     * @see Expr::week
     * @param mixed|Expr $expression
     * @return $this
     */
    public function week($expression)
    {
        $this->expr->week($expression);

        return $this;
    }

    /**
     * Returns the year portion of a date.
     *
     * The argument can be any expression as long as it resolves to a date.
     *
     * @see http://docs.mongodb.org/manual/reference/operator/aggregation/year/
     * @see Expr::year
     * @param mixed|Expr $expression
     * @return $this
     */
    public function year($expression)
    {
        $this->expr->year($expression);

        return $this;
    }

    /**
     * Transposes an array of input arrays so that the first element of the
     * output array would be an array containing, the first element of the first
     * input array, the first element of the second input array, etc.
     *
     * @see https://docs.mongodb.com/manual/reference/operator/aggregation/zip/
     * @see Expr::zip
     * @since 1.5
     * @param mixed|Expr $inputs An array of expressions that resolve to arrays. The elements of these input arrays combine to form the arrays of the output array.
     * @param bool|null $useLongestLength A boolean which specifies whether the length of the longest array determines the number of arrays in the output array.
     * @param mixed|Expr|null $defaults An array of default element values to use if the input arrays have different lengths. You must specify useLongestLength: true along with this field, or else $zip will return an error.
     * @return $this
     */
    public function zip($inputs, $useLongestLength = null, $defaults = null)
    {
        $this->expr->zip($inputs, $useLongestLength, $defaults);

        return $this;
    }
}
