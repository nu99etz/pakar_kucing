<?php

namespace C45;

use C45\Calculator\GainCalculator;
use C45\Calculator\GainRatioCalculator;
use C45\Calculator\SplitInfoCalculator;
use DataReader\SQL\Reader;

class C45
{
    const REQUIRED_CONFIG = [
        'targetAttribute',
        'trainingFile',
        'splitCriterion',
        'classes'
    ];

    const SPLIT_GAIN = 0;
    const SPLIT_GAIN_RATIO = 1;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var int
     */
    protected $splitCriterion;

    /**
     * @var string Target attribute's name
     */
    protected $targetAttribute;

    /**
     * @var array Target attribute's values
     */
    protected $targetValues;

    /**
     * @var array Total target's count split by target value
     */
    protected $targetCount;

    /**
     * @var string
     */
    protected $trainingFile;

    /**
     * @var array
     */
    protected $classes;

    /**
     * @var \DataReader\IFace\DataReaderInterface
     */
    protected $training;

    /**
     * @var GainCalculator
     */
    private $gainCalculator;

    /**
     * @var SplitInfoCalculator
     */
    private $splitInfoCalculator;

    /**
     * @var GainRatioCalculator
     */
    private $gainRatioCalculator;

    protected $infoAttribute;

    public function __construct(array $config = [])
    {
        if ($this->validateConfig($config)) {
            $this->config = $config;
            $this->assignConfig($config);
            $this->initTraining();
            $this->targetValues = $this->getAttributeValues($this->targetAttribute);

            foreach ($this->targetValues as $value) {
                $criteria[$this->targetAttribute] = $value;
                $this->targetCount[$value] = $this->training->countByCriteria($criteria);
            }

            $this->gainCalculator = new GainCalculator($this->training, $this->targetAttribute);
            $this->splitInfoCalculator = new SplitInfoCalculator($this->training, $this->targetAttribute);
            $this->gainRatioCalculator = new GainRatioCalculator($this->training, $this->targetAttribute);
        }
    }

    /**
     * Validates config values.
     *
     * @param array $config
     *
     * @return bool
     *
     * @throws InvalidConfigException
     */
    private function validateConfig(array $config)
    {
        foreach (self::REQUIRED_CONFIG as $value) {
            if (!isset($config[$value])) {
                throw new InvalidConfigException(sprintf("Parameter '%s' is required in C45 configuration", $value));

                return false;
            }
        }

        return true;
    }

    private function assignConfig(array $config)
    {
        foreach (self::REQUIRED_CONFIG as $value) {
            $this->$value = $config[$value];
        }
    }

    private function initTraining()
    {
        $this->training = new Reader($this->trainingFile, $this->classes);
    }

    /**
     * 
     * Menampilkan Informasi Attribute
     * 
     */
    public function setInfoAttribute($attribute)
    {
        $this->infoAttribute[] = $attribute;
    }

    public function getInfoAttribute()
    {
        return $this->infoAttribute;
    }

    /**
     * Membangun Pohon Keputusan
     * Build decision tree using C4.5 algorithm.
     *
     * @param array $criteria
     *
     * @return TreeNode
     */
    public function buildTree(array $criteria = [])
    {

        $treeNode = new TreeNode();


        // PRUNING-PRUNINGAN
        // $classProb = $this->calculateClassProbability($criteria);
        // $biggestClass = $this->getBiggestArrayAttribute($classProb);
        //
        // if ($classProb[$biggestClass] > 0.85) {
        //     $treeNode->setAttribute($this->targetAttribute);
        //     $treeNode->addChild('result', $biggestClass);
        //     $treeNode->setIsLeaf(true);
        //
        //     return $treeNode;
        // }
        // END of PRUNING-PRUNINGAN

        $checkClass = $this->isBelongToOneClass($criteria); // Check apakah attribut terdiri dari satu atau lebih kelas

        // Jika kelas terdiri dari satu atau lebih kelas
        if ($checkClass['return']) {

            $treeNode->setAttribute($this->targetAttribute); // Set Target attribute yang sudah di set
            $treeNode->addChild('result', $checkClass['class']);
            $treeNode->setIsLeaf(true);

            // echo "<pre>";
            // print_r($treeNode);
            // echo "</pre>";

            return $treeNode;
        }

        $splitCriterion = $this->calculateSplitCriterion($criteria); // Untuk mencari nilai gain dan memecah kriteria

        // Ambil Nilai Attribute sesuai criteria untuk ditampilkan

        $attribute = $this->gainCalculator->getAttributesTotal($criteria);

        $this->setInfoAttribute($attribute);

        $bestAttrName = $this->getBiggestArrayAttribute($splitCriterion); // Mencari nilai gain terbesar

        $bestAttrValues = $this->getAttributeValues($bestAttrName); // Atribute value

        $treeNode->setAttribute($bestAttrName); // Set Attribute Pohon dengan nama bernilai gain terbesar

        // echo "<pre>";
        // print_r($bestAttrName);
        // echo "</pre>";

        unset($splitCriterion[$bestAttrName]);

        foreach ($bestAttrValues as $value) {

            $criteria[$bestAttrName] = $value;
            
            $targetCount = $this->countTargetByCriteria($criteria);

            $treeNode->addClassesCount($value, $targetCount);

                if (array_sum($targetCount) == 0) {
                    $targetCount2 = $this->countTargetByCriteria([$bestAttrName => $value]);
                    $biggestClass = $this->getBiggestArrayAttribute($targetCount2);

                    $child = new TreeNode();
                    $child->setParent($treeNode);
                    $child->setAttribute($this->targetAttribute);
                    $child->addChild('result', $biggestClass);
                    $child->setIsLeaf(true);

                    $treeNode->addChild($value, $child);

                } elseif (!empty($splitCriterion)) {
                
                    $child = $this->buildTree($criteria);
                    $child->setParent($treeNode);

                    $treeNode->addChild($value, $child);

                } else {

                    // echo "<pre>";
                    // print_r($criteria);
                    // echo "</pre>";

                    $classProb = $this->calculateClassProbability($criteria);

                    $biggestClass = $this->getBiggestArrayAttribute($classProb);

                    $child = new TreeNode();
                    $child->setParent($treeNode);
                    $child->setAttribute($this->targetAttribute);
                    $child->addChild('result', $biggestClass);
                    $child->setIsLeaf(true);

                    $treeNode->addChild($value, $child);
                }
        }

        return $treeNode;
    }

    public function getInfoGain()
    {
        return $this->gainCalculator->getInfoGain();
    }

    public function getInfoAttributeName()
    {
        return $this->gainCalculator->getAttributeName();
    }

    public function getInfoAttributeValue()
    {
        return $this->gainCalculator->getAttributeValue();
    }

    public function getInfoAttributeTarget()
    {
        return $this->gainCalculator->getTargetAttribute();
    }

    private function calculateSplitCriterion($criteria = [])
    {

        $gain = $this->gainCalculator->calculateGainAllAttributes($criteria);

        if ($this->splitCriterion == self::SPLIT_GAIN) {
            return $gain;
        } else {
            $splitInfo = $this->splitInfoCalculator->calculateSplitInfoAllAttributes($criteria);
            $gainRatio = $this->gainRatioCalculator->calculateGainRatio($gain, $splitInfo);

            return $gainRatio;
        }
    }

    private function calculateClassProbability(array $criteria)
    {
        $cTarget = $this->countTargetByCriteria($criteria);
        $total = array_sum($cTarget);
        $classProb = [];

        foreach ($this->targetValues as $value) {
            $classProb[$value] = $this->classProbability($cTarget[$value], $total);
        }


        return $classProb;
    }

    private function classProbability($cTargetClass, $total)
    {
        if ($total == 0) {
            return 0;
        }

        return $cTargetClass / $total;
    }

    private function isBelongToOneClass(array $criteria)
    {
        $countAll = $this->training->countByCriteria($criteria);

        foreach ($this->targetValues as $value) {
            $criteria[$this->targetAttribute] = $value;
            $countByTarget = $this->training->countByCriteria($criteria);
            unset($criteria[$this->targetAttribute]);
            if ($countAll === $countByTarget) {
                return [
                    'return' => true,
                    'class' => $value,
                ];
            }
        }

        return ['return' => false];
    }

    private function getBiggestArrayAttribute(array $array)
    {
        array_multisort($array, SORT_DESC);
        reset($array);
        $key = key($array);

        return $key;
    }

    private function countTargetByCriteria(array $criteria)
    {
        $targetCount = [];

        foreach ($this->targetValues as $value) {
            $criteria[$this->targetAttribute] = $value;
            $targetCount[$value] = $this->training->countByCriteria($criteria);
        }

        unset($criteria[$this->targetAttribute]);

        return $targetCount;
    }

    private function getAttributeValues($attributeName)
    {
        return $this->training->getClasses([$attributeName])[$attributeName];
    }
}
