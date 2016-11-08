<?php

namespace Behat\YiiExtension\Context;

class YiiContext implements YiiAwareContextInterface
{
	private $yii;

	public function setYiiWebApplication(\CWebApplication $yii)
    {
        $this->yii = $yii;
    }

     /**
     * Returns Mink instance.
     *
     * @return Mink
     */
    public function getYii()
    {
        if (null === $this->yii) {
            throw new \RuntimeException(
                'Yii instance has not been set on Yii context class. ' . 
                'Have you enabled the Yii Extension?'
            );
        }

        return $this->yii;
    }
}