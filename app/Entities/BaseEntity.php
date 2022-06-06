<?php

namespace App\Entities;

use LaravelOrm\Entities\Entity;
use DateTime;

class BaseEntity extends Entity
{
    private ?string $CreatedBy = null;
    private ?string $ModifiedBy = null;
    private ?DateTime $Created = null;
    private ?DateTime $Modified = null;

    public function getCreatedBy()
    {
        return $this->CreatedBy;
    }

    public function setCreatedBy(?string $CreatedBy)
    {
        $this->CreatedBy = $CreatedBy;
        return $this;
    }

    public function getModifiedBy()
    {
        return $this->ModifiedBy;
    }

    public function setModifiedBy(?string $ModifiedBy)
    {
        $this->ModifiedBy = $ModifiedBy;
        return $this;
    }

    public function getCreated()
    {
        return $this->Created;
    }

    public function setCreated(?DateTime $Created)
    {
        $this->Created = $Created;
        return $this;
    }

    public function getModified()
    {
        return $this->Modified;
    }

    public function setModified(?DateTime $Modified)
    {
        $this->Modified = $Modified;
        return $this;
    }
}
