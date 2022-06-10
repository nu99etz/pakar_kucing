<?php

namespace DataReader\IFace;

/**
 * @author Juliardi <ardi93@gmail.com>
 */
interface ConfigurationInterface
{
    /**
     * Sets maximum line length.
     *
     * @param int $value
     *
     * @throws InvalidConfigException If $value is less than  0
     */
    public function setLength($value);

    /**
     * Retrieves maximum line length.
     *
     * @return null|int
     */
    public function getLength();

    /**
     * Sets delimiter character.
     *
     * @param string $delimiter
     *
     * @throws InvalidConfigException If $delimiter is not a single character
     */
    public function setDelimiter($delimiter);

    /**
     * Retrieves delimiter character.
     *
     * @return string
     */
    public function getDelimiter();

    /**
     * Sets enclosure character.
     *
     * @param string $enclosureChar
     *
     * @throws InvalidConfigException If $enclosureChar is not a single character
     */
    public function setEnclosureChar($enclosureChar);

    /**
     * Retrieces enclosure character.
     *
     * @return string
     */
    public function getEnclosureChar();

    /**
     * Sets escape character.
     *
     * @param string $escapeChar
     *
     * @throws InvalidConfigException If $escapeChar is not a single character
     */
    public function setEscapeChar($escapeChar);

    /**
     * Retrieves escape character.
     *
     * @return string
     */
    public function getEscapeChar();
}
