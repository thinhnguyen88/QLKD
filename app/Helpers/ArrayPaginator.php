<?php

namespace App\Helpers;

use JasonGrimes\Paginator;
use Request;

class ArrayPaginator extends Paginator
{
    private $paginator;
    private $result;

    /**
     * @param array $data
     * @param int $page
     * @param int $url_pattern
     * @param int $max_per_page
     */
    public function __construct(Array $data, $page, $url_pattern, $max_per_page = 20)
    {
        $total = count($data);
        $max_page = ceil($total / $max_per_page);

        $this->paginator = '';
        $this->result = $data;

        if ($max_page > 1) {
            $current_page = ($page > 0 && $page <= $max_page) ? $page : 1;

            $offset = ($current_page - 1) * $max_per_page;

            $this->result = array_slice($data, $offset, $max_per_page);

            $this->paginator = new Paginator($total, $max_per_page, $current_page, $url_pattern);
        }
    }

    /**
     * @return Paginator
     */
    public function render()
    {
        return $this->paginator;
    }

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @return int
     */
    public function getMaxPagesToShow()
    {
        return $this->maxPagesToShow;
    }

    /**
     * @return int
     */
    public function getItemsPerPage()
    {
        return $this->itemsPerPage;
    }

    /**
     * @return int
     */
    public function getTotalItems()
    {
        return $this->totalItems;
    }

    /**
     * @return int
     */
    public function getNumPages()
    {
        return $this->numPages;
    }



    /**
     * @return array
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param int $pageNum
     * @return string
     */
    public function getPageUrl($pageNum)
    {
        return str_replace(self::NUM_PLACEHOLDER, $pageNum, $this->urlPattern);
    }

    public function getNextPage()
    {
        if ($this->currentPage < $this->numPages) {
            return $this->currentPage + 1;
        }
        return null;
    }
    public function getPrevPage()
    {
        if ($this->currentPage > 1) {
            return $this->currentPage - 1;
        }
        return null;
    }
}