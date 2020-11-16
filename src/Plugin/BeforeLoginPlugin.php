<?php

namespace Bleez\CentralAlunoLogin\Plugin;

use Magento\Framework\Message\ManagerInterface;
use Magento\Customer\Controller\Account\LoginPost;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Bleez\CentralAlunoLogin\Model\CentralAlunoLoginFactory;

class BeforeLoginPlugin
{
    const INTEGRACAO_ATIVA = 'customer/configurations/enable_integration';

    /** * @var ManagerInterface */
    protected $messageManager;

    /** @var ScopeConfigInterface */
    protected $scopeConfig;

    /** @var CentralAlunoLoginFactory */
    protected $centralAlunoLoginFactory;

    /**
     * BeforeLoginPlugin constructor.
     * @param ManagerInterface $messageManager
     * @param ScopeConfigInterface $scopeConfig
     * @param CentralAlunoLoginFactory $centralAlunoLoginFactory
     */
    public function __construct(
        ManagerInterface $messageManager,
        ScopeConfigInterface $scopeConfig,
        CentralAlunoLoginFactory $centralAlunoLoginFactory
    )
    {
        $this->scopeConfig = $scopeConfig;
        $this->messageManager = $messageManager;
        $this->centralAlunoLoginFactory = $centralAlunoLoginFactory;
    }

    public function beforeExecute(LoginPost $customerAccountLoginController)
    {
        if ($this->getIntegracaoAtiva()) {
            try {
                $customerLogin = $customerAccountLoginController->getRequest()->getParams('login');
                $userEmail = $customerLogin['login']['username'];

                if (!$this->verificaSeExisteEmailRespFinanceiro($userEmail)) {
                    throw new LocalizedException(__("Login Não autorizado"));
                }

                if(!$this->verificaSeExisteEmailRespLegal($userEmail)) {
                    throw new LocalizedException(__("Login Não autorizado"));
                }

            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return;
            }
        }
        return;
    }

    /**
     * @return mixed
     */
    private function getIntegracaoAtiva()
    {
        return $this->scopeConfig->getValue(self::INTEGRACAO_ATIVA);
    }

    /**
     * @param string $email
     */
    private function verificaSeExisteEmailRespFinanceiro(string $email)
    {
        $centralAlunoLogin = $this->centralAlunoLoginFactory->create();
        $dados = $centralAlunoLogin->getCollection()->addFieldToFilter('Email_Resp_Financeiro', $email)->load();

        if ($dados->getFirstItem()->getData()){
            return $dados;
        }

        return null;
    }

    /**
     * @param string $email
     */
    private function verificaSeExisteEmailRespLegal(string $email) {
        $centralAlunoLogin = $this->centralAlunoLoginFactory->create();
        $dados = $centralAlunoLogin->getCollection()->addFieldToFilter('Email_Resp_Legal', $email)->load();

        if ($dados->getFirstItem()->getData()){
            return $dados;
        }

        return null;
    }
}
