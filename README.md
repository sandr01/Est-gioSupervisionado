# Estágio Supervisionado

Neste repositório estará tudo que fizemos na disciplina de Estágio Supervisionado do curso de Sistemas de Informação na Universidade Federal do Acre.

## Equipe

<a href="https://github.com/sandr01/Est-gioSupervisionado/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=sandr01/Est-gioSupervisionado" />
</a>


## Descrição do Projeto
Este projeto é uma aplicação web que visa gerenciar o controle de estoque de equipamentos, permitindo o cadastro, solicitação e relatórios de equipamentos utilizados no setor de TI.

## Tecnologias Utilizadas
- **Frontend:** [Angular] (https://angular.dev/)
- **Backend:** [SpringBoot] (https://spring.io/projects/spring-boot)
- **Banco de Dados:** MySQL [MySQL] (https://www.mysql.com/)

## Instruções para Execução
Para executar o sistema, siga as etapas abaixo:

### 1. Configuração do Banco de Dados
- Certifique-se de ter o MySQL instalado e em execução.
- Crie um banco de dados com o nome desejado.
- Importe o arquivo de script SQL.

### 2. Como inciar a aplicação

<h3>Back-end</h3>

A aplicação back-end pode ser iniciada pelo Spring Boot Dashboard ou com o Maven.

1. Se optar pelo Maven, no prompt de comandos, a partir do diretório `./back-huerb`:

a. Para iniciar a aplicação com o Maven:

    ```console
        mvn spring-boot:run
    ```
Ou

b. Para compilar o pacote e depois executar o JAR gerado:

    ```console
    mvn package
    java -jar target\sgcmapi.jar
    ```

> [!IMPORTANT]
> A aplicação vai iniciar no endereço <https://localhost:9000/>, com acesso local a base de dados MySQL, por meio da porta padrão 3306, além de usuário e senha "root".

<h3>Front-end</h3>

     As dependências do projeto não são compartilhadas no repositório. Para instalar as dependências, a partir do diretório `./sgcmapp`, no prompt de comandos, digite:

        ```console
        npm install
        ```

        Para iniciar a aplicação, a partir do diretório `./front`, execute o comando:

        ```console
        ng serve
        ```

> [!IMPORTANT]
> O frontend será executado em http://localhost:4200.


## License
Huerb é licenciado sob a [MIT License](LICENSE).
