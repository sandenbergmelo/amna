# Blog da Associação dos Moradores do Bairro Novo Altiplano

Projeto sendo feito para as disciplinas de Engenharia de Software, Programação Web e Inteligência Artificial.


## Como rodar o projeto
1. Instalar as dependências
```bash
npm install
composer install
```

2. Criar o arquivo .env e **preencher as variáveis de ambiente**
```bash
cp .env.example .env
```

3. Gerar a chave da aplicação
```bash
php artisan key:generate
```

4. Rodar as migrations e seeders
```bash
php artisan migrate --seed
```

5. Buildar arquivos estáticos
```bash
npm run build
```

6. Rodar o servidor
```bash
php artisan serve
```
