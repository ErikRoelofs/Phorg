<?php

namespace Plu\PhorgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Meta
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Plu\PhorgBundle\Entity\DateMetaRepository")
 */
class DateMeta extends AbstractMeta
{

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="datetime")
     */
    private $value;

    /**
     * Set value
     *
     * @param string $value
     * @return Meta
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

}
