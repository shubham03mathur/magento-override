<?php
namespace Excellence\Override\Api;

use Excellence\Override\Model\LoginInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface LoginRepositoryInterface 
{
    public function save(LoginInterface $page);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(LoginInterface $page);

    public function deleteById($id);
}
