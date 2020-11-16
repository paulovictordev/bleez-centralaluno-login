<?php

namespace Bleez\CentralAlunoLogin\Model\ResourceModel\CentralAlunoLogin;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Bleez\CentralAlunoLogin\Model\ResourceModel\CentralAlunoLogin
 */
class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'centralaluno_login_collection';
    protected $_eventObject = 'login_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Bleez\CentralAlunoLogin\Model\CentralAlunoLogin',
            'Bleez\CentralAlunoLogin\Model\ResourceModel\CentralAlunoLogin'
        );
    }
}
