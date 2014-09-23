<?php

namespace Plu\PhorgBundle\Controller;

use Plu\PhorgBundle\Editor\FileEditor;
use Plu\PhorgBundle\Entity\File;
use Plu\PhorgBundle\Entity\Filter;
use Plu\PhorgBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class FilterController extends Controller
{
    /**
     * @Route("/filters", name="filters")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager()->getRepository("PluPhorgBundle:Filter");
        $filters = $em->findAll();

        return array("filters" => $filters);
    }

    /**
     * @Route("/filter/run/{id}", name="filter_run")
     * @Template()
     */
    public function runAction(Filter $filter)
    {
        $filterControl = new \Plu\PhorgBundle\Filter\Filter($this->getDoctrine()->getManager());
        return array("filter" => $filter, "files" => $filterControl->findMatching($filter));

    }

    /**
     * @Route("/filter/simple/run/{id}", name="filter_run_simple")
     * @Template()
     */
    public function simpleRunAction(Tag $tag)
    {
        $filterControl = new \Plu\PhorgBundle\Filter\Filter($this->getDoctrine()->getManager());
        return array("tag" => $tag, "files" => $filterControl->findMatchingSimpleTag($tag));

    }

}
