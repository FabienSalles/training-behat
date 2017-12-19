<?php

use Behat\Behat\Context\Context;
use Training\Math;

class FeatureContext implements Context
{
    private $math;
    private $result;

    public function __construct()
    {
        $this->math = new Math();
    }


    /**
     * @When /^I add (\d+) to (\d+)$/
     */
    public function iHaveTheNumberAndTheNumber(float $a, float $b)
    {
        $this->result = $this->math->sum($a, $b);
    }

    /**
    * @Then /^I should get (\d+)$/
    */
    public function iShouldGet($sum)
    {
        if ($this->result != $sum) {
            throw new Exception("Actual sum: ".$this->result);
        }
    }
}
