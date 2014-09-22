<?php

namespace Plu\PhorgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

abstract class AbstractMeta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var File
     *
     * @ORM\ManyToOne(targetEntity="File", inversedBy="stringMeta")
     */
    protected $file;

    /**
     * @var ProtoMeta
     *
     * @ORM\ManyToOne(targetEntity="ProtoMeta")
     */
    protected $proto;

    /**
     * @var Tag
     *
     * @ORM\ManyToOne(targetEntity="Tag")
     */
    protected $tag;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return Meta
     */
    abstract public function setValue($value);

    /**
     * Get value
     *
     * @return string
     */
    abstract public function getValue();

    /**
     * @param \Plu\PhorgBundle\Entity\File $file
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return \Plu\PhorgBundle\Entity\File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param \Plu\PhorgBundle\Entity\ProtoMeta $proto
     */
    public function setProto($proto)
    {
        $this->proto = $proto;
        return $this;
    }

    /**
     * @return \Plu\PhorgBundle\Entity\ProtoMeta
     */
    public function getProto()
    {
        return $this->proto;
    }

    /**
     * @param \Plu\PhorgBundle\Entity\Tag $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @return \Plu\PhorgBundle\Entity\Tag
     */
    public function getTag()
    {
        return $this->tag;
    }

    public static function createFromProto(ProtoMeta $proto)
    {
        if ($proto->getType() == ProtoMeta::TYPE_DATE) {
            return new DateMeta();
        } elseif ($proto->getType() == ProtoMeta::TYPE_STRING) {
            return new StringMeta();
        }
    }

}
