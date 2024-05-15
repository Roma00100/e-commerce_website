<?php

function clearData($input)
{
    $cleanData = trim($input);
    $cleanData = strip_tags($cleanData);
    $cleanData = htmlspecialchars($cleanData);

    return $cleanData;
};
