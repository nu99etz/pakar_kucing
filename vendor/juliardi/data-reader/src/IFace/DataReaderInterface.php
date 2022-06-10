<?php

namespace DataReader\IFace;

/**
 * @author Juliardi <ardi93@gmail.com>
 */
interface DataReaderInterface
{
    /**
     * Retrieves attributes list.
     *
     * @return array Array of attributes
     */
    public function getAttributes();

    /**
     * Checks whether the data has an attribute.
     *
     * @param string $attribute Attribute name to be checked
     *
     * @return bool
     */
    public function hasAttribute($attribute);

    /**
     * Retrieves classes list.
     * If $attribute is null then classes from all attributes will be returned.
     *
     * @param array $attributes List of attribute(s)
     *
     * @return array Associative array in format
     *               ````
     *               [attribute => [class => value]]
     *               ````
     */
    public function getClasses(array $attributes = []);

    /**
     * Retrieves a number of data from $start.
     * If $length is null, then all data will be returned.
     *
     * @param int $start
     * @param int $length Amount of data to be retrieved
     *
     * @return array [description]
     */
    public function getData($start = 0, $length = null);

    /**
     * Retrieves rows that matched the $criteria
     * If $length is null, then all data matched the criteria will be returned.
     *
     * @param array $criteria Associative array in format [attribute => value] that
     *                        will be used as a search criteria
     * @param int   $length   Amount of data to be retrieved.
     *
     * @return array
     */
    public function getByCriteria(array $criteria, $length = null);

    /**
     * Counts rows that matched the criteria.
     *
     * @param array $criteria Associative array in format [attribute => value] that
     *                        will be used as a search criteria
     *
     * @return int
     */
    public function countByCriteria(array $criteria);
}
