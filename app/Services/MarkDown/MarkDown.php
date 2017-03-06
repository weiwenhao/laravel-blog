<?php
/**
 * Created by PhpStorm.
 * User: weiwenhao
 * Date: 17-3-5
 * Time: 下午9:02
 */

namespace App\Services\MarkDown;


class MarkDown
{
    protected $parser;

    /**
     * MarkDown constructor.
     * @param $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function convertToHtml($text)
    {
        return $this->parser->makeHtml($text);
    }

}