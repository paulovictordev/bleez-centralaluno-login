<?php

namespace Bleez\CentralAlunoLogin\Console\Command;

use Magento\Framework\HTTP\ZendClientFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Bleez\CentralAlunoLogin\Model\CentralAlunoLoginFactory;

/**
 * Class AtualizarTabelaLogin
 * @package Bleez\CentralAlunoLogin\Console\Command
 */
class AtualizarTabelaLogin extends Command
{

    const URL_API = 'customer/configurations/url_acess';
    const INTEGRACAO_ATIVA = 'customer/configurations/enable_integration';

    /** @var ScopeConfigInterface */
    protected $scopeConfig;

    /** @var ZendClientFactory */
    protected $httpClientFactory;

    /** @var CentralAlunoLoginFactory */
    protected $centralAlunoLoginFactory;

    /**
     * AtualizarTabelaLogin constructor.
     * @param ZendClientFactory $httpClientFactory
     * @param ScopeConfigInterface $scopeConfig
     * @param CentralAlunoLoginFactory $centralAlunoLoginFactory
     * @param string|null $name
     */
    public function __construct(
        ZendClientFactory $httpClientFactory,
        ScopeConfigInterface $scopeConfig,
        CentralAlunoLoginFactory $centralAlunoLoginFactory,
        string $name = null
    ){
        $this->scopeConfig = $scopeConfig;
        $this->httpClientFactory = $httpClientFactory;
        $this->centralAlunoLoginFactory = $centralAlunoLoginFactory;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('centralaluno:sincronizacaoLogin')
            ->setDescription('Integração de Login Pais Responsáveis');

        return parent::configure();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        if ($this->getIntegracaoAtiva()) {
            $dados = $this->getJson();

            if ($dados) {
                foreach ($dados as $key => $dado) {
                    $varificaSeExiste = $this->verificarSeUsuarioExiste($dado);

                    if ($varificaSeExiste) {
                        $this->atualizarDados($varificaSeExiste, $dado);
                    } else {
                        $this->adicionarDados($dado);
                    }

                    $imprimirDados = json_encode($dado);
                    $output->writeln("Foi atualizado/adicionado o seguinte dados {$imprimirDados}");
                }
            }

        }
    }

    /**
     * @return mixed
     */
    private function getIntegracaoAtiva()
    {
        return $this->scopeConfig->getValue(self::INTEGRACAO_ATIVA);
    }

    /**
     * @return mixed
     */
    private function getUrlIntegracao()
    {
        return $this->scopeConfig->getValue(self::URL_API);
    }

    /**
     * @return mixed|string
     */
    private function getJson()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->getUrlIntegracao(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYHOST => 0
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        }

        return json_decode($response, true);
    }

    /**
     * @param array $dado
     * @return \Magento\Framework\Data\Collection\AbstractDb|\Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection|null
     */
    private function verificarSeUsuarioExiste(array $dado)
    {
        $centralAlunoLogin = $this->centralAlunoLoginFactory->create();
        $dados = $centralAlunoLogin->getCollection()
            ->addFieldToFilter('cod_aluno', $dado['cod_aluno'])
            ->addFieldToFilter('cod_escola', $dado['cod_escola'])
            ->load();

        if ($dados->getFirstItem()->getData()){
            return $dados;
        }

        return null;
    }

    /**
     * @param $consulta
     * @param array $dado
     */
    private function atualizarDados($consulta, array $dado)
    {
        $consulta->getFirstItem()->addData($dado)->save();
    }

    /**
     * @param array $dado
     * @throws \Exception
     */
    private function adicionarDados (array $dado)
    {
        $centralAlunoLogin = $this->centralAlunoLoginFactory->create();
        $centralAlunoLogin->addData($dado);
        $centralAlunoLogin->save();
    }


}
