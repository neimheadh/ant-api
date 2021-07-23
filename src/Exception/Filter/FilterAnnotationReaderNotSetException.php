<?php


namespace App\Exception\Filter;

use Throwable;

/**
 * Filter annotation reader not set exception.
 *
 * @package App\Exception\Filter
 */
class FilterAnnotationReaderNotSetException extends \RuntimeException
{
    /**
     * Default message.
     */
    const DEFAULT_MESSAGE = 'An annotation reader must be provided.';

    /**
     * Default message when class is given.
     */
    const DEFAULT_MESSAGE_CLASS = 'An annotation reader must be provided in %s.';

    /**
     * Default message when setter is given.
     */
    const DEFAULT_MESSAGE_FUNCTION = 'An annotation reader must be provided. Be sure you call %s';

    /**
     * FilterAnnotationReaderNotSetException constructor.
     *
     * @param string|null    $class    Filter class.
     * @param string|null    $setter   Setter function.
     * @param string|null    $message  Exception message.
     * @param int            $code     Exception error code.
     * @param Throwable|null $previous Previous exception.
     */
    public function __construct(
        string $class = null,
        string $setter = null,
        string $message = null,
        int $code = 0,
        Throwable $previous = null
    ) {
        if ($message === null) {
            if ($class === null && $setter === null) {
                $message = self::DEFAULT_MESSAGE;
            } elseif ($setter === null) {
                $message = sprintf(self::DEFAULT_MESSAGE_CLASS, $class);
            } else {
                $message = sprintf(
                    self::DEFAULT_MESSAGE_FUNCTION,
                    $class === null ? $setter : "$class::$setter"
                );
            }
        }

        parent::__construct($message, $code, $previous);
    }
}