<?php

namespace Bleez\CentralAlunoLogin\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;

/**
 * Class InstallSchema
 * @package Bleez\CentralAlunoLogin\Setup
 * Instalação do Schema do banco de dados da integração central do aluno,
 * definindo o nome das colunas da nova tabela
 */
class InstallSchema implements InstallSchemaInterface
{

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * Função padrão do magento para instalar um novo Schema de banco de dados de um módulo
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $table = $setup->getConnection()->newTable(
             "centralaluno_login"
        )->addColumn(
            "id",
            Table::TYPE_INTEGER,
            null,
            [
                'identity' => true,
                'nullable' => false,
                'primary' => true
            ],
            'ID'
        )->addColumn(
            "cod_escola",
            Table::TYPE_INTEGER,
            null,
            [
                'nullable' => true
            ],
            "Codigo da Escola"
        )->addColumn(
            "ano",
            Table::TYPE_INTEGER,
            null,
            [
                'nullable' => true
            ],
            "Ano Letivo"
        )->addColumn(
            "cod_aluno",
            Table::TYPE_INTEGER,
            null,
            [
                'nullable' => true
            ],
            "Código do Aluno"
        )->addColumn(
            "Serie",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Série Aluno"
        )->addColumn(
            "cod_serie",
            Table::TYPE_INTEGER,
            null,
            [
                'nullable' => true
            ],
            "Código da Série"
        )->addColumn(
            "Turma",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Turma"
        )->addColumn(
            "Aluno",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Nome do Aluno"
        )->addColumn(
            "Data_Nasc",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Data Nascimento Aluno"
        )->addColumn(
            "Email_Aluno",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "E-mail do Aluno"
        )->addColumn(
            "ResponsavelFinanceiro",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Nome Responsável Financeiro"
        )->addColumn(
            "CPF_Resp_Financeiro",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Cpf Responsável Financeiro"
        )->addColumn(
            "RG_Resp_Financeiro",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "RG Responsável Financeiro"
        )->addColumn(
            "Email_Resp_Financeiro",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "E-mail Responsável Financeiro"
        )->addColumn(
            "Endereco_Resp_Financeiro",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Enderenço Responsável Financeiro"
        )->addColumn(
            "Bairro_Resp_Financeiro",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Bairro Responsável Financeiro"
        )->addColumn(
            "UF_Resp_Financeiro",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Uf Responsável Financeiro"
        )->addColumn(
            "Cidade_Resp_Financeiro",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Cidade Responsável Financeiro"
        )->addColumn(
            "CEP_Resp_Financeiro",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "CEP Responsável Financeiro"
        )->addColumn(
            "Fone_Residencial_Resp_Financeiro",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Telefone Residencial Responsável Financeiro"
        )->addColumn(
            "Celular_Resp_Financeiro",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Celular Responsável Financeiro"
        )->addColumn(
            "Fone_Comercial_Resp_Financeiro",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Fone Comercial Responsável Financeiro"
        )->addColumn(
            "Responsavel_Legal",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Responsável Legal"
        )->addColumn(
            "CPF_Resp_Legal",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "CPF Responsável Legal"
        )->addColumn(
            "RG_Resp_Legal",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "RG Responsável Legal"
        )->addColumn(
            "Email_Resp_Legal",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "E-mail Responsável Legal"
        )->addColumn(
            "Endereco_Resp_Legal",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Endereço Responsável Legal"
        )->addColumn(
            "Bairro_Resp_Legal",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Bairro Responsável Legal"
        )->addColumn(
            "UF_Resp_Legal",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "UF Responsável Legal"
        )->addColumn(
            "Cidade_Resp_Legal",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Cidade Responsável Legal"
        )->addColumn(
            "CEP_Resp_Legal",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "CEP Responsável Legal"
        )->addColumn(
            "Fone_Residencial_Resp_legal",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Fone Residencial Responsável Legal"
        )->addColumn(
            "Celular_Resp_legal",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Celular Responsável Legal"
        )->addColumn(
            "Fone_Comercial_Resp_legal",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Fone Comercial Responsável Legal"
        )->addColumn(
            "Nome_Pai",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Nome do Pai"
        )->addColumn(
            "CPF_Pai",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "CPF do Pai"
        )->addColumn(
            "RG_Pai",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "RG do Pai"
        )->addColumn(
            "End_Pai",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Endereço do Pai"
        )->addColumn(
            "Bairro_Pai",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Bairro do Pai"
        )->addColumn(
            "Cidade_Pai",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Cidade do Pai"
        )->addColumn(
            "UF_Pai",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "UF do Pai"
        )->addColumn(
            "CEP_Pai",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "CEP do Pai"
        )->addColumn(
            "Fone_Pai",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Fone do Pai"
        )->addColumn(
            "Pendencias_Pai",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Pendencias do Pai"
        )->addColumn(
            "Mae",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Nome da Mãe"
        )->addColumn(
            "CPF_Mae",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "CPF da Mãe"
        )->addColumn(
            "RG_Mae",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "RG da Mãe"
        )->addColumn(
            "End_Mae",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Endereço da Mãe"
        )->addColumn(
            "Bairro_Mae",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Bairro da Mãe"
        )->addColumn(
            "Cidade_Mae",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Cidade da Mãe"
        )->addColumn(
            "UF_Resp_mae",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "UF da Mãe"
        )->addColumn(
            "CEP_Mae",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "CEP da Mãe"
        )->addColumn(
            "Fone_Mae",
            Table::TYPE_TEXT,
            255,
            [
                'nullable' => true
            ],
            "Fone da Mãe"
        );

        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }

}
