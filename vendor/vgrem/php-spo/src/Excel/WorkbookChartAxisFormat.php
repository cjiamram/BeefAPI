<?php

/**
 * Modified: 2020-05-26T22:05:50+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;

use Office365\Runtime\ResourcePath;
class WorkbookChartAxisFormat extends Entity
{
    /**
     * @return WorkbookChartFont
     */
    public function getFont()
    {
        if (!$this->isPropertyAvailable("Font")) {
            $this->setProperty("Font", new WorkbookChartFont($this->getContext(), new ResourcePath("Font", $this->getResourcePath())));
        }
        return $this->getProperty("Font");
    }
    /**
     * @return WorkbookChartLineFormat
     */
    public function getLine()
    {
        if (!$this->isPropertyAvailable("Line")) {
            $this->setProperty("Line", new WorkbookChartLineFormat($this->getContext(), new ResourcePath("Line", $this->getResourcePath())));
        }
        return $this->getProperty("Line");
    }
}