<?php

namespace Drupal\marina_cf_cachetags\Plugin\Purge\TagsHeader;

use Drupal\purge\Plugin\Purge\TagsHeader\TagsHeaderBase;
use Drupal\purge\Plugin\Purge\TagsHeader\TagsHeaderInterface;

/**
 * Exports cache tags in the header consumed by the CloudFront integration.
 *
 * @PurgeTagsHeader(
 *   id = "marina_cf_cachetags",
 *   header_name = "x-amz-meta-cache-tag",
 * )
 */
final class MarinaCfCachetagsHeader extends TagsHeaderBase implements TagsHeaderInterface {}
