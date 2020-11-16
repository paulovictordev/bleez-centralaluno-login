<?php

namespace Bleez\CentralAlunoLogin\Cron;

use Magento\Framework\Filesystem\DirectoryList;

class ExecutarIntegracaoLogin
{
    /** @var DirectoryList */
    protected $directoryList;

    /**
     * ExecutarIntegracaoLogin constructor.
     * @param DirectoryList $directoryList
     */
    public function __construct(
        DirectoryList $directoryList
    )
    {
        $this->directoryList = $directoryList;
    }

    /**
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
    }
}
