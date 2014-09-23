<?php

namespace Plu\PhorgBundle\Editor;


use Doctrine\ORM\EntityManager;
use Plu\PhorgBundle\Entity\Tag;
use Plu\PhorgBundle\Entity\TagRelation;

class TagEditor {

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function makeNewTag( Tag $tag, Tag $parent ) {
        $rel = new TagRelation();
        $rel->setParent($parent);
        $rel->setChild($tag);
        $rel->setPrimaryParent(true);
        $tag->addParentRelation($rel);
        $parent->addChildRelation($rel);
        $this->em->persist($rel);
        $this->em->persist($tag);
    }

} 