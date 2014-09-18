<?php

namespace Plu\PhorgBundle\Editor;


use Doctrine\ORM\EntityManager;
use Plu\PhorgBundle\Entity\File;
use Plu\PhorgBundle\Entity\Tag;

class FileEditor
{

    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getAvailableTagsFor(File $file)
    {
        $repo = $this->em->getRepository("PluPhorgBundle:Tag");
        $usedTags = $this->getAllTags($file);
        if ($usedTags == array()) {
            // doctrine bugs.
            return $repo->findAll();
        }
        $qb = $repo->createQueryBuilder("t")->where("t not in ( :tags )")->setParameter("tags", $usedTags);
        return $qb->getQuery()->getResult();
    }

    private function getAllTags(File $file)
    {
        $list = array();
        foreach ($file->getTags() as $tag) {
            $list = $this->collectTags($tag, $list);
        }
        return $list;
    }

    private function collectTags(Tag $tag, $list)
    {
        $list[] = $tag;
        foreach ($tag->getParents() as $parent) {
            $list = $this->collectTags($parent, $list);
        }
        return $list;
    }

} 