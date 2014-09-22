<?php

namespace Plu\PhorgBundle\Tag;


use Plu\PhorgBundle\Entity\File;
use Plu\PhorgBundle\Entity\Filter;
use Plu\PhorgBundle\Entity\Tag;

class TagFinder
{

    public function getAllTagsForFile(File $file)
    {
        $list = array();
        foreach ($file->getTags() as $tag) {
            $list = $this->collectTagsByParent($tag, $list);
        }
        return $list;
    }

    private function collectTagsByParent(Tag $tag, $list)
    {
        $list[] = $tag;
        foreach ($tag->getParents() as $parent) {
            $list = $this->collectTagsByParent($parent, $list);
        }
        return $list;
    }

    public function getAllTagsForFilter(Filter $filter)
    {
        $list = array();
        foreach ($filter->getTags() as $tag) {
            $list = $this->collectTagsByChild($tag, $list);
        }
        return $list;
    }

    private function collectTagsByChild(Tag $tag, $list)
    {
        $list[] = $tag;
        foreach ($tag->getChildren() as $child) {
            $list = $this->collectTagsByChild($child, $list);
        }
        return $list;
    }


} 