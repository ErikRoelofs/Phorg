<?php

namespace Plu\PhorgBundle\Editor;


use Doctrine\ORM\EntityManager;
use Plu\PhorgBundle\Entity\AbstractMeta;
use Plu\PhorgBundle\Entity\File;
use Plu\PhorgBundle\Entity\FileTag;
use Plu\PhorgBundle\Entity\ProtoMeta;
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

    public function canAddTag(File $file, Tag $tag)
    {
        $tags = $this->getAvailableTagsFor($file);
        foreach ($tags as $aTag) {
            if ($aTag->getId() == $tag->getId()) {
                return true;
            }
        }
        return false;
    }

    public function canRemoveTag(File $file, Tag $tag)
    {
        $tags = $file->getTags();
        foreach ($tags as $aTag) {
            if ($aTag->getId() == $tag->getId()) {
                return true;
            }
        }
        return false;
    }

    public function addTag(File $file, Tag $tag)
    {
        $rel = new FileTag();
        $rel->setFile($file);
        $rel->setTag($tag);
        $file->addFileTag($rel);
        $this->updateMeta($file, $tag);
    }

    public function removeTag(File $file, Tag $tag)
    {
        foreach ($file->getFileTags() as $tagRelation) {
            if ($tagRelation->getTag()->getId() == $tag->getId()) {
                $this->em->remove($tagRelation);
            }
        }
    }

    private function updateMeta(File $file, Tag $tag)
    {
        $allMeta = $this->findMetaToAdd($file, $tag);
        foreach ($allMeta as $toAdd) {
            $this->addMetaFromProto($file, $tag, $toAdd);
        }
    }

    private function findMetaToAdd(File $file, Tag $tag)
    {
        $allMeta = $this->getAllMetaFor($tag);
        $currentMeta = $this->getCurrentMeta($file);
        foreach ($allMeta as $key => $newMeta) {
            foreach ($currentMeta as $existingMeta) {
                if ($newMeta->getId() == $existingMeta->getProto()->getId()) {
                    unset($allMeta[$key]);
                }
            }
        }
        return $allMeta;
    }

    private function addMetaFromProto(File $file, Tag $tag, ProtoMeta $toAdd)
    {
        $newMeta = AbstractMeta::createFromProto($toAdd);
        $file->addMeta($newMeta);
        $newMeta->setFile($file);
        $newMeta->setTag($tag);
        $newMeta->setProto($toAdd);
    }

    private function getAllMetaFor(Tag $tag, $metaList = array())
    {
        foreach ($tag->getProtoMeta() as $meta) {
            $metaList[] = $meta;
        }
        foreach ($tag->getParents() as $ptag) {
            $metaList = $this->getAllMetaFor($ptag, $metaList);
        }
        return $metaList;
    }

    private function getCurrentMeta(File $file)
    {
        $currentMeta = array();
        foreach ($file->getDateMeta() as $meta) {
            $currentMeta[] = $meta;
        }
        foreach ($file->getStringMeta() as $meta) {
            $currentMeta[] = $meta;
        }
        return $currentMeta;
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