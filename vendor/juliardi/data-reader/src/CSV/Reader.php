<?php

namespace DataReader\CSV;

use DataReader\Exception\InvalidConfigException;
use DataReader\IFace\DataReaderInterface;
use DataReader\IFace\ConfigurationInterface;

/**
 * @author Juliardi <ardi93@gmail.com>
 */
class Reader implements DataReaderInterface
{
    protected $data;
    protected $attributes;
    protected $classes;

    /**
     * @param string                 $filename
     * @param ConfigurationInterface $config
     *
     * @throws InvalidConfigException
     */
    public function __construct($filename, ConfigurationInterface $config = null)
    {
        if (strtolower(pathinfo($filename, PATHINFO_EXTENSION)) != 'csv') {
            throw new InvalidConfigException("Filename must contain a 'csv' extension");
        }

        if (is_null($config)) {
            $config = new ReaderConfig();
        }

        $this->data = $this->parseCsv($filename, $config);
        $this->populateClasses();
    }

    /**
     * Parses CSV file.
     *
     * @param string                 $filename
     * @param ConfigurationInterface $config
     */
    protected function parseCsv($filename, ConfigurationInterface $config)
    {
        $length = $config->getLength();
        $delimiter = $config->getDelimiter();
        $enclosure = $config->getEnclosureChar();
        $escape = $config->getEscapeChar();
        $result = [];

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, $length, $delimiter, $enclosure, $escape)) !== false) {
                $temp = [];

                if (empty($this->attributes)) {
                    if ($config->isFirstLineAsAttributes()) {
                        $this->attributes = $row;
                    } else {
                        $cRow = count($row);
                        for ($i = 0; $i < $cRow; ++$i) {
                            $attrName = 'attribute '.$i;
                            $this->attributes[] = $attrName;
                            $temp[$attrName] = trim($row[$i]);
                        }
                        $result[] = $temp;
                    }
                } else {
                    $cRow = count($row);
                    for ($i = 0; $i < $cRow; ++$i) {
                        $attrName = $this->attributes[$i];
                        $temp[$attrName] = trim($row[$i]);
                    }
                    $result[] = $temp;
                }
            }
            fclose($handle);
        }

        return $result;
    }

    /**
     * Populates classes.
     */
    protected function populateClasses()
    {
        $this->classes = [];
        $cData = count($this->data);

        for ($i = 0; $i < $cData; ++$i) {
            $data = $this->data[$i];

            foreach ($data as $key => $value) {
                if (array_key_exists($key, $this->classes)) {
                    if (array_search($value, $this->classes[$key]) === false) {
                        array_push($this->classes[$key], $value);
                    }
                } else {
                    $this->classes[$key] = [$value];
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAttribute($attribute)
    {
        return array_search($attribute, $this->attributes) !== false;
    }

    /**
     * {@inheritdoc}
     */
    public function getClasses(array $attributes = [])
    {
        if (!empty($attributes)) {
            $result = [];

            foreach ($attributes as $value) {
                if ($this->hasAttribute($value)) {
                    $result[$value] = $this->classes[$value];
                }
            }

            return $result;
        } else {
            return $this->classes;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getData($start = 0, $length = null)
    {
        if ($length == null) {
            return $this->data;
        } else {
            return array_slice($this->data, $start, $length);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getByCriteria(array $criteria, $length = null)
    {
        $result = [];

        foreach ($this->data as $row) {
            if ($length === 0) {
                break;
            }
            if ($this->isMatch($row, $criteria)) {
                array_push($result, $row);
                --$length;
            }
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function countByCriteria(array $criteria)
    {
        $result = 0;

        foreach ($this->data as $row) {
            if ($this->isMatch($row, $criteria)) {
                ++$result;
            }
        }

        return $result;
    }

    /**
     * Checks whether $data matched $criteria.
     *
     * @param array $data
     * @param array $criteria
     *
     * @return bool True, if matched. False if otherwise.
     */
    private function isMatch($data, $criteria)
    {
        $result = true;

        foreach ($criteria as $key => $value) {
            if ($this->hasAttribute($key)) {
                if ($data[$key] != $value) {
                    $result = $result && false;
                }
            }
        }

        return $result;
    }
}
