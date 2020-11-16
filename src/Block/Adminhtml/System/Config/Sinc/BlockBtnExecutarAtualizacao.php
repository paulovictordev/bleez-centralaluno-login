<?php

namespace Bleez\CentralAlunoLogin\Block\Adminhtml\System\Config\Sinc;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;


class BlockBtnExecutarAtualizacao extends Field
{
    protected $_template = 'Bleez_CentralAlunoLogin::system/config/sinc/btnexecutaratualizacao.phtml';

    public function __construct(
        Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }

    public function render(AbstractElement $element)
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    protected function _getElementHtml(AbstractElement $element)
    {
        return $this->_toHtml();
    }

    public function getUrlExecutarAtualizacao()
    {
        return $this->getUrl('integracao/sinc/executarsincronizacaologin');
    }

    public function getButtonHtml()
    {
        $button = $this->getLayout()->createBlock(
            'Magento\Backend\Block\Widget\Button'
        )->setData(
            [
                'id' => 'execute_atualizacao',
                'label' => __('Executar Atualizacao'),
            ]
        );

        return $button->toHtml();
    }
}
