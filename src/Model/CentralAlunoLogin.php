<?php

namespace Bleez\CentralAlunoLogin\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

/**
 * Class CentralAlunoLogin
 * @package Bleez\CentralAlunoLogin\Model
 * Classe Model, onde o magento utiliza para criar a model do tabela do banco
 */
class CentralAlunoLogin extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'centralaluno_login';

    protected $_cacheTag = 'centralaluno_login';

    protected $_eventPrefix = 'centralaluno_login';

    protected function _construct()
    {
        $this->_init('Bleez\CentralAlunoLogin\Model\ResourceModel\CentralAlunoLogin');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
