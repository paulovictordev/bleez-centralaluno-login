<?php

namespace Bleez\CentralAlunoLogin\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class CentralAlunoLogin
 * @package Bleez\CentralAlunoLogin\Model\ResourceModel
 */
class CentralAlunoLogin extends AbstractDb
{

    /**
     * CentralAlunoLogin constructor.
     * @param Context $context
     */
    public function __construct(
        Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('centralaluno_login', 'id');
    }
}
