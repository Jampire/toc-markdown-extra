<?php

namespace Jampire\Markdown\Toc;

use Michelf\MarkdownExtra as BaseMarkdownExtra;

/**
 * Class MarkdownExtra
 *
 * TOC capability is ported from @link https://sculpin.io/ Sculpin project.
 * @see generateHeaderId()
 *
 * @author Dzianis Kotau <jampire.blr@gmail.com>
 * @package Jampire\Markdown\Toc
 */
class MarkdownExtra extends BaseMarkdownExtra
{
    public function __construct()
    {
        parent::__construct();
        $this->header_id_func = array($this, 'generateHeaderId');
    }

    /**
     * This method is called to generate an id="" attribute for a header.
     *
     * TOC capability is ported from @link https://sculpin.io/ Sculpin project.
     *
     * @param string $headerText raw markdown input for the header name
     *
     * @return string
     * @author Dragonfly Development Inc. <info@dflydev.com>
     * @author Beau Simensen <beau@dflydev.com>
     */
    public function generateHeaderId($headerText)
    {

        // $headerText is completely raw markdown input. We need to strip it
        // from all markup, because we are only interested in the actual 'text'
        // part of it.

        // Step 1: Remove html tags.
        $result = strip_tags($headerText);

        // Step 2: Remove all markdown links. To do this, we simply remove
        // everything between ( and ) if the ( occurs right after a ].
        $result = preg_replace('%
            (?<= \\]) # Look behind to find ]
            (
                \\(     # match (
                [^\\)]* # match everything except )
                \\)     # match )
            )

            %x', '', $result);

        // Step 3: Convert spaces to dashes, and remove unwanted special
        // characters.
        $map = array(
            ' ' => '-',
            '(' => '',
            ')' => '',
            '[' => '',
            ']' => '',
        );

        return rawurlencode(strtolower(
            strtr($result, $map)
        ));
    }
}
