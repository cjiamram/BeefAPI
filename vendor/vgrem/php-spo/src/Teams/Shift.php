<?php

/**
 * Generated by phpSPO model generator 2020-05-29T07:19:37+00:00 
 */
namespace Office365\Teams;

use Office365\Entity;

/**
 * Represents a unit of scheduled work in a [schedule](schedule.md). 
 */
class Shift extends Entity
{
    /**
     * @return string
     */
    public function getUserId()
    {
        if (!$this->isPropertyAvailable("UserId")) {
            return null;
        }
        return $this->getProperty("UserId");
    }
    /**
     * @var string
     */
    public function setUserId($value)
    {
        $this->setProperty("UserId", $value, true);
    }
    /**
     * @return string
     */
    public function getSchedulingGroupId()
    {
        if (!$this->isPropertyAvailable("SchedulingGroupId")) {
            return null;
        }
        return $this->getProperty("SchedulingGroupId");
    }
    /**
     * @var string
     */
    public function setSchedulingGroupId($value)
    {
        $this->setProperty("SchedulingGroupId", $value, true);
    }
}