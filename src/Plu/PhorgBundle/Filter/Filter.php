<?php

namespace Plu\PhorgBundle\Filter;

use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityManager;

use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use \Plu\PhorgBundle\Entity\Filter as FilterEntity;
use Plu\PhorgBundle\Tag\TagFinder;

class Filter
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * @var \Plu\PhorgBundle\Tag\TagFinder
     */
    private $tagFinder;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->tagFinder = new TagFinder();
    }

    public function findMatching(FilterEntity $filter)
    {
        $tags = $this->findMatchingByTags($filter);
        $meta = $this->findMatchingByMeta($filter);
        $ids = $this->getFileIds($tags, $meta);

        return $this->em->getRepository("PluPhorgBundle:File")->findBy(array( "id" => $ids));
    }

    private function findMatchingByTags(FilterEntity $filter)
    {
        $tags = $this->tagFinder->getAllTagsForFilter($filter);
        $tagIds = array_unique(array_map(function ($e) {
            return $e->getId();
        }, $tags));
        return $tagIds;
    }

    private function findMatchingByMeta(FilterEntity $filter)
    {
        return array_unique(array_map(function ($e) {
            return $e->getId();
        }, (array) $filter->getMeta()));
    }

    private function getFileIds($tagIds, $meta)
    {
        $sql = $this->craftSql($tagIds, $meta);
        $rsm = new ResultSetMapping($this->em);
        $rsm->addScalarResult("file_id", "id");

        $list = $this->em->createNativeQuery($sql, $rsm)->getScalarResult();
        // clean up the list so it's a flat array of integers
        return array_map(function ($e) {
            return (int) $e['id'];
        }, $list);
    }

    /**
     * We have to use native queries because doctrine does not support the UNION operator, which will be by far the
     * best way to search for files matching multiple tags (barring except INTERSECT, which mysql does not support)
     */
    private function craftSql($tagIds, $metaIds)
    {
        $tagChunks = array();
        foreach ($tagIds as $tag) {
            $tagChunks[] = $this->makeTagSql($tag);
        }
        $metaChunks = array();
        foreach ($metaIds as $meta) {
            $metaChunks = array_merge($metaChunks, $this->makeMetaSql($meta));
        }
        $chunks = array_merge($tagChunks, $metaChunks);
        return "select file_id from (" . implode(" union all ", $chunks) . ") as search_table group by file_id";
    }

    private function makeTagSql($tag)
    {
        return "select t.file_id from FileTag t where t.tag_id = " . (int) $tag;
    }

    private function makeMetaSql($meta)
    {
        return array(
            "select m.file_id from StringMeta m where m.proto_id = " . (int) $meta,
            "select m.file_id from DateMeta m where m.proto_id = " . (int) $meta
        );
    }

} 