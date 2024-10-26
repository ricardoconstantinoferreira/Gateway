<?php

declare(strict_types=1);

namespace RCFerreira\Gateway\Model;

use Magento\Framework\Api\SearchResults;
use RCFerreira\Gateway\Api\Data\GatewaySearchResultsInterface;

class GatewaySearchResults extends SearchResults implements GatewaySearchResultsInterface
{

}
