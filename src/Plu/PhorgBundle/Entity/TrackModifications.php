<?php

namespace Plu\PhorgBundle\Entity;

interface TrackModifications
{

    function setLastModification($dateTime);

    function getLastModification();

} 