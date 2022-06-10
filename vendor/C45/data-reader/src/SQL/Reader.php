<?php

namespace DataReader\SQL;

use DataReader\Exception\InvalidConfigException;
use DataReader\IFace\DataReaderInterface;
use DataReader\IFace\ConfigurationInterface;


class Reader implements DataReaderInterface
{

  /**
   * @author Nugraha <aidenstacks3@gmail.com>
   */

  protected $data;
  protected $attributes;
  protected $classes;

  public function __construct($array_data, $array_classes)
  {
    $this->data = $this->populateData($array_data);
    $this->attributes = $this->populateAttributes();
    $this->populateClasses($array_classes);
  }

  protected function populateData($array_data)
  {
    return $this->data = $array_data;
  }

  protected function populateAttributes()
  {
    $attr = array();
    foreach ($this->data[0] as $key => $values) {
      $attr[] = $key;
    }
    return $attr;
  }

  protected function populateClasses($array_classes = null)
  {
    if (empty($array_classes)) {
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
      return $this->classes;
    } else {
      $this->classes = $array_classes;
      return $this->classes;
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
