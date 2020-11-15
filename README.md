# Modelo de pacote Bleez

Repositório com modelo de pacote para desenvolvimentos de pacotes Bleez.

Esse modelo já tem:

* Pasta dedicada ao código do pacote
* Pasta dedicada ao código de testes unitários
* Arquivos para uso do composer
* Arquivos para registro do módulo no Magento
* Arquivos iniciais para configurar CI no CircleCI

## Padrão de nome

Estamos usando como nome do pacote o mesmo padrão do Magento e usando o prefixo  `module-`.

Se você for, por exemplo, fazer um módulo que se integra com a Cielo crie seu modulo como `module-cielo`.

## O que você deve mudar ANTES de começar

Uma vez que você criar seu projeto usando este pacote como template você não pode se esquecer de alterar os seguintes arquivos.

### registration.php

Uma vez que o mesmo for instalado pelo composer, este arquivo registra o pacote no Magento como um módulo.

```php
<?php

\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE, <-- mude aqui caso seu pacote não seja um módulo, mas sim um tema ou uma tradução
    'Bleez_Modelo', <---- altere aqui
    __DIR__ . '/src'
);
```

Esse é o "código" que seu pacote terá no Magento. Você irá usá-lo para habilitar/desabilitar e outras coisas.

### composer.json

Este arquivo é o que registra seu pacote para ser instalavel pelo Magento. A função principal dele é setar os namespaces e as dependências (outros pacotes que você usa e que se não tiverem instalados seu pacote não funciona).

#### Seção `name`

Na seção `name` é onde você informa qual o nome do pacote. Esse é o nome que será informado no `composer.json` próprio Magento para que o pacote seja instalado.

```json

    ...

    "name": "bleez/module-modelo",

    ...
```

#### Seção `require`

A seção `require` é onde colocamos todas as dependencias dos nossos módulos.

```json
    ...

    "require": {
        "php": "^7.2.0",
        "magento/product-community-edition": "^2.3"
    }

    ...
```

Atualmente trabalhamos como padrão a versão 7.2 do PHP e a 2.3 do Magento. É importante manter essa informação.

Caso seu pacote dependa de algum outro pacote você deve informar aqui. Por exemplo, o [Bleez Correios](https://github.com/Bleez/module-correios-adapter) depende do [Bleez Shippings](https://github.com/Bleez/module-shippings) e do [PHP Correios](https://github.com/brunoviana/php-correios), potanto seu `composer.json` tem essa informação:

```json
    ...

    "require": {
        "php": "^7.2.0",
        "magento/product-community-edition": "^2.3",
        "brunoviana/php-correios": "^1.0",
        "bleez/module-shippings": "~1.0"
    }

    ...
```

Se você não sabe se deve usar `~` ou `^` nas suas versões consulte a [documentação do Composer onde ele fala sobre Version Constraints](https://getcomposer.org/doc/articles/versions.md#writing-version-constraints).

#### Seção `autoload`

Nessa seção, dentro da sub-seção `psr-4`, você irá registrar os namespaces do seu pacote para o composer fazer os devidos *requires* bonitinho.

```json
    ...

    "autoload": {
        "files": [
            "registration.php"
        ],
        "psr-4": {
            "Bleez\\Modelo\\": "src/",
            "Bleez\\Modelo\\Test\\": "tests/"
        }
    },

    ...
```

### /etc/module.xml

Este arquivo também ajuda a definir o seu pacote como um módulo do Magento e define qual a versão dele **dentro do Magento**. Essa versão pode ser diferente da versão do seu pacote no Github.

```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
        xsi:noNamespaceSchemaLocation="urn:magento:framework:Module/etc/module.xsd">

    <module name="Bleez_Modelo" setup_version="0.0.1"></module>

</config>
```

Mude `name` para o código usado em `registrarion.php`.

## O que mudar DEPOIS que começar

Uma vez que **a primeira funcionalidade do módulo** estiver pronta você precisa alterar alguns aquivos.

### README.md

Altere o `README.md` com a documentação do seu pacote.

Lembre-se daqui a 6 meses você não vai lembrar de mais nada. Da mesma forma evite que as pessoas fiquem te fazendo as mesmas perguntas idiotas. Mantendo tudo documentado você garante menos preenchimento de saco.

Use como modelo o [Bleez Correios](https://github.com/Bleez/module-correios-adapter) e o [Bleez Shippings](https://github.com/Bleez/module-shippings) para escrever uma documentação útil.

### CHANGELOG.md

Sempre documente o que está alterando, assim facilitar a vida de quem vai testar, de quem vai revisar o código e de quem vai usar o pacote, além de ter menos gente de aporrrinhando.

Leia o [Keep a Changelog](https://keepachangelog.com/pt-BR/1.0.0/) que é o padrão de Changelog que estamos usando nos pacotes.

#### Importante

Não seja um cuzão. Documente esta porra que você tá criando.

## Considerações finais

Aconselho fortemente usar o nosso [Ambiente de Desenvolvimento](https://github.com/Bleez/docker-dev-magento) em conjunto do nosso [Magento para desenvolvimento de pacotes](https://github.com/Bleez/magento-dev-pacotes).

Eles te darão de forma mastigada ferramentas para desenvolver pacotes.