# teste-Crawly

Para executar este teste primeiro é necessário criar a imagem Docker com o comando `docker build . -t teste-crawly` na raiz do projeto.

Em seguida execute o container com o comando `docker run -p 8080:80 teste-crawly`.

Pronto, o resultado já estará acessivel em http://localhost:8080/

Para rodar os testes deve execurar comando `docker run -it teste-crawly bash` na raiz do projeto em seguida rodar o comando `./vendor/bin/phpunit tests` no bash do container.