<?php

namespace DataReader\CSV;

use DataReader\Exception\InvalidConfigException;
use DataReader\IFace\ConfigurationInterface;

/**
 * @author Juliardi <ardi93@gmail.com>
 */
class ReaderConfig implements ConfigurationInterface
{
    /**
     * @var int
     */
    protected $length;

    /**
     * @var string
     */
    protected $delimiter;

    /**
     * @var string
     */
    protected $enclosureChar;

    /**
     * @var string
     */
    protected $escapeChar;

    /**
     * @var bool
     */
    protected $firstLineAttributes;

    public function __construct($length = 0, $delimiter = ',', $enclosure = '"', $escape = '\\', $firstLineAttributes = true)
    {
        $this->setLength($length);
        $this->setDelimiter($delimiter);
        $this->setEnclosureChar($enclosure);
        $this->setEscapeChar($escape);
        $this->setFirstLineAsAttributes($firstLineAttributes);
    }

    /**
     * {@inheritdoc}
     */
    public function setLength($value)
    {
        if ($value < 0) {
            throw new InvalidConfigException('Length must be more or equal to 0');
        }
        $this->length = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * {@inheritdoc}
     */
    public function setDelimiter($delimiter)
    {
        if (strlen($delimiter) != 1) {
            throw new InvalidConfigException('Delimiter must be a single character');
        }

        $this->delimiter = $delimiter;
    }

    /**
     * {@inheritdoc}
     */
    public function getDelimiter()
    {
        return $this->delimiter;
    }

    /**
     * {@inheritdoc}
     */
    public function setEnclosureChar($enclosureChar)
    {
        if (strlen($enclosureChar) != 1) {
            throw new InvalidConfigException('Enclosure Character must be a single character');
        }

        $this->enclosureChar = $enclosureChar;
    }

    /**
     * {@inheritdoc}
     */
    public function getEnclosureChar()
    {
        return $this->enclosureChar;
    }

    /**
     * {@inheritdoc}
     */
    public function setEscapeChar($escapeChar)
    {
        if (strlen($escapeChar) != 1) {
            throw new InvalidConfigException('Escape Character must be a single character');
        }

        $this->escapeChar = $escapeChar;
    }

    /**
     * {@inheritdoc}
     */
    public function getEscapeChar()
    {
        return $this->escapeChar;
    }

    /**
     * Sets first line of CSV file as attributes list.
     *
     * @param bool $value
     */
    public function setFirstLineAsAttributes($value = true)
    {
        $this->firstLineAttributes = $value;
    }

    /**
     * Checks whether first line of CSV must be treated as attributes name list.
     *
     * @return bool
     */
    public function isFirstLineAsAttributes()
    {
        return $this->firstLineAttributes;
    }
}
