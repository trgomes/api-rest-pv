**1 - SERVIÇO - REST**

### Pré-requisito
- PHP 7 - Definido no path da máquina para execução em linha de comando
- Mysql 5.4 ou superior
- Servidor Apache

***obs.: Se preferir instale toda stack de uma só vez, utilizando o XAMP, WAMP server... De acordo com sua preferência.***

### Instalação da API ou Serviço (como preferir)
1. Clone o projeto `git clone https://github.com/trgomes/api-rest-pv.git`.
2. Crie um banco de dados (plano_voo).
3. Modifique o arquivo `.env` que fica na raiz do projeto com os dados do seu banco (DB_DATABASE=plano_voo, DB_USERNAME= user, DB_PASSWORD=password)
4. Dentro da pasta do projeto execute o comando `php artisan migrate `, para criar as tabelas no banco de dados.
6. No mesmo local icie o servidor web, como o comando `php artisan serve`.
7. Acesse o link [http://localhost:8000](http://localhost:8000). Se aparecer a tela de boas vindas do laravel, sucesso! O serviço rest já está funcionando.


### MER
O modelo de dados definido para o projeto foi o seguinte:

[![N|Solid](https://uploaddeimagens.com.br/images/001/211/454/full/MER-plano-de-voo.png?1513225716)](https://nodesource.com/products/nsolid)


### Rotas:

| Método | URI | DESCRIÇÃO |
| ------ | ------ | ------ |
| GET    | api/aeronaves       | Retorna todos as aeronaves cadastradas
| POST   | api/aeronaves       | Cadastra uma nova aeronave
| DELETE | api/aeronaves/{id}  | Exclui uma aeronave
| PUT    | api/aeronaves/{id}  | Altera o resigtro de uma aeronave identificada pelo ID
| GET    | api/aeronaves/{id}  | Retorna o registro de uma aeronave especificada pelo ID
| POST   | api/aeroportos      | Cadastra um novo aeroporto
| GET    | api/aeroportos      | Retorna todos as aeroportos cadastrados
| GET    | api/aeroportos/{id} | Retorna o registro de um aeroporto especificado pelo ID
| PUT    | api/aeroportos/{id} | Altera o resigtro de um aeroporto identificado pelo ID
| DELETE | api/aeroportos/{id} | Exclui um aeroporto
| POST   | api/voos            | Cadastra um novo voo
| GET    | api/voos            | Retorna todos os voos cadastrados
| DELETE | api/voos/{id}       | Exclui um voo
| PUT    | api/voos/{id}       | Altera o registro de um voos identificado pelo ID
| GET    | api/voos/{id}       | Retorna o registro de um voo especificado pelo ID
| POST   | api/tipos           | Cadastra um novo tipo para aeronave
| GET    | api/tipos           | Retorna todos os tipos de aeronaves cadastrados


### Código fonte: 
1)  Repositório: [https://github.com/trgomes/api-rest-pv](https://github.com/trgomes/api-rest-pv)
2)  Models: [https://github.com/trgomes/api-rest-pv/tree/master/app](https://github.com/trgomes/api-rest-pv/tree/master/app)
3)  Controllers: [https://github.com/trgomes/api-rest-pv/tree/master/app/Http/Controllers](https://github.com/trgomes/api-rest-pv/tree/master/app/Http/Controllers)
4)  Routs: [https://github.com/trgomes/api-rest-pv/blob/master/routes/api.php](https://github.com/trgomes/api-rest-pv/blob/master/routes/api.php)
