<?php

namespace C45\Calculator;

class GainCalculator extends AbstractCalculator
{

    private $infoGain;
    private $infoEntropy;
    private $infoAttributeName;
    private $infoAttributeValue;

    public function setInfoGain($gain)
    {
        $this->infoGain[] = $gain;
    }

    public function getInfoGain()
    {
        return $this->infoGain;
    }

    public function setInfoEntropy($entropy)
    {
        $this->infoEntropy[] = $entropy;
    }

    public function getInfoEntropy()
    {
        return $this->infoEntropy;
    }

    public function setAttributeName($attributeName)
    {
        // foreach($attributeName as $key => $value) {
        //     if($value != $this->targetAttribute) {
        //         $this->infoAttributeName[] = $attributeName;
        //     }
        // }
        $this->infoAttributeName[] = $attributeName;
    }

    public function getAttributeName()
    {
        return $this->infoAttributeName;
    }

    public function setAttributeValue($attributeValue)
    {   
        $this->infoAttributeValue[] = $attributeValue;
    }

    public function getAttributeValue()
    {
        return $this->infoAttributeValue;
    }

    /**
     * Calculates all attributes gain.
     *
     * @param array $criteria
     *
     * @return float[] Array of gain
     */
    public function calculateGainAllAttributes($criteria = [])
    {
        $attributeNames = $this->getAttributeNames($criteria);

        $gain = [];


        foreach ($attributeNames as $value) {
            if ($value != $this->targetAttribute) {
                $gain[$value] = $this->calculateGainOfAttribute($value, $criteria);
            }
        }

        $this->setInfoGain($gain);

        return $gain;
    }

    // Menampilkan Semua Entropy Dan Info Gain

    public function getAttributesTotal($criteria = [])
    {
        $attribute = [];

        $attributeNames = $this->getAttributeNames($criteria);

        foreach($attributeNames as $value) {
            if($value != $this->targetAttribute) {
                $attribute[$value] = $this->getCountAttribute($value, $criteria);
            }
        }

        $total = 0;

        foreach($attribute as $key => $value) {
            foreach($value as $key2 => $value2) {
                $attribute[$key]['InfoGain'] = $this->gain($this->targetCount, $value);
                $attribute[$key][$key2]['entropy'] = $this->entropy($value2);
                $attribute[$key]['Column'] = count($attribute[$key]) - 1;
            }
            $total += $attribute[$key]['Column']; 
            $attribute['totalColumn'] = $total;
        }

        return $attribute;
    }

    // Menampilkan Attribute Target

    public function getTargetAttribute()
    {
        $attributeTarget = [];
        foreach($this->targetCount as $key => $value) {
            $attributeTarget['target'] = $this->targetAttribute;
            $attributeTarget[$key] = $value;
            $attributeTarget['entropy'] = $this->entropy($this->targetCount);
        }

        return $attributeTarget;
    }

    // Menghitung Attribute Sesuai Kriteria
    
    public function getCountAttribute($attributeName, $criteria = [])
    {
        $attributeCount = [];

        $attributeValues = $this->getAttributeValues($attributeName);

        foreach ($attributeValues as $value) {
            $criteria[$attributeName] = $value;
            foreach ($this->targetValues as $targetValue) {
                $criteria[$this->targetAttribute] = $targetValue;
                $attributeCount[$value][$targetValue] = $this->reader->countByCriteria($criteria);
            }
        }

        return $attributeCount;
    }

    /**
     * Menghitung Gain sesuai attribut
     * Calculates gain of an attribute.
     *
     * @param string $attributeName
     * @param array  $criteria
     *
     * @return float Gain value of the attribute
     */
    public function calculateGainOfAttribute($attributeName, $criteria = [])
    {
        $gain = 0;
        $attributeCount = [];

        $attributeValues = $this->getAttributeValues($attributeName);

        $this->setAttributeName($attributeName);

        foreach ($attributeValues as $value) {
            $criteria[$attributeName] = $value;
            foreach ($this->targetValues as $targetValue) {
                $criteria[$this->targetAttribute] = $targetValue;
                $attributeCount[$value][$targetValue] = $this->reader->countByCriteria($criteria);
            }
        }

        $gain = $this->gain($this->targetCount, $attributeCount);

        return $gain;
    }

    /**
     * Menghitung Gain
     * Calculates gain.
     *
     * @param array $classifier_values Array of classes count in format
     *                                 ```
     *                                 [
     *                                 'class1' => 100,
     *                                 'class2' => 200,
     *                                 ......,
     *                                 'classN' => count,
     *                                 ]
     *                                 ```
     * @param array $values            Array of classes count in format
     *                                 ```
     *                                 [
     *                                 'attribute1' => [
     *                                 'class1' => 100,
     *                                 'class2' => 200,
     *                                 ......,
     *                                 'classN' => count,
     *                                 ],
     *                                 'attribute2' => [
     *                                 'class1' => 100,
     *                                 'class2' => 200,
     *                                 ......,
     *                                 'classN' => count,
     *                                 ],
     *                                 .....,
     *                                 'attributeN' => [
     *                                 'class1' => 100,
     *                                 'class2' => 200,
     *                                 ......,
     *                                 'classN' => count,
     *                                 ],
     *                                 ]
     *                                 ```
     */
    private function gain($classifier_values, $values)
    {

        $entropy_all = $this->entropy($classifier_values);


        $total_records = 0;

        foreach ($values as $sub_values) {
            $total_records += array_sum($sub_values);
        }

        $gain = 0;

        foreach ($values as $sub_values) {
            try {
                $sub_total_values = array_sum($sub_values);
                $entropy = $this->entropy($sub_values);
                $gain += ($sub_total_values / $total_records) * $entropy;
            } catch (\Exception $e) {
                error_log($e->getMessage());
                error_log($e->getTraceAsString());
            }
        }

        $gain = $entropy_all - $gain;

        return $gain;
    }

    /**
     * Menghitung Entropy
     * Calculates entropy.
     *
     * @param array $values Array of classes count in format
     *                      ```
     *                      [
     *                      'class1' => 100,
     *                      'class2' => 200,
     *                      ......,
     *                      'classN' => count,
     *                      ]
     *                      ```
     *
     * @return float
     */
    private function entropy(array $values)
    {

        $result = 0;
        $sum = array_sum($values);

        foreach ($values as $value) {
            if ($value > 0) {
                $proportion = $value / $sum;
                $result += - ($proportion * log($proportion, 2));
            }
        }

        return $result;
    }
}
