<?php

namespace Bleez\CentralAlunoLogin\Controller\Adminhtml\Sinc;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Filesystem\DirectoryList;
use Magento\Framework\Controller\Result\JsonFactory;

class Executarsincronizacaologin extends Action
{
    /** @var DirectoryList */
    protected $directoryList;

    /** @var JsonFactory */
    protected $jsonFactory;

    /**
     * ExecutarSincronizacaoLogin constructor.
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param DirectoryList $directoryList
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        DirectoryList $directoryList
    )
    {
        $this->jsonFactory = $jsonFactory;
        $this->directoryList = $directoryList;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function execute()
    {
        $commandLine = "php {$this->directoryList->getRoot()}/bin/magento centralaluno:sincronizacaoLogin";

        $pathMedia = $this->directoryList->getPath(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);

        $currentDate = (new \DateTime());
        $currentDate = $currentDate->format('Y-m-d H:i:s');

        $path = "{$pathMedia}/syncDadosLoginPais";

        if(!is_dir($path)) {
            mkdir($path);
        }

        shell_exec("{$commandLine} > {$path}/logSincronizacaoLogin{$currentDate}.log &");

        $response = $this->jsonFactory->create();

        $response->setData(
            [
                'sucess_message' => __('Execução Enviada para o Servidor'),
                'status' => 200
            ]
        );

        return $response;
    }
}
