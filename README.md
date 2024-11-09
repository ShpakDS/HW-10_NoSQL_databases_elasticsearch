# HW-10_NoSQL_databases_elasticsearch

## Description

This project uses Elasticsearch for autocomplete, query processing, and search within a word index. Using Docker, Elasticsearch is run alongside a PHP application to perform various operations such as creating the index and loading a word list.

## Instructions

### 1) Starting the project

To start the project, use the following command:

```bash
docker-compose up -d
```

This will run all the necessary services in Docker, including Elasticsearch and the PHP application.

### 2) Create an index in Elasticsearch

To create the index for autocomplete, run the following command:

```bash
docker-compose exec app php /var/www/html/create_index.php
```

This command will create an index in Elasticsearch to store words.

### 3) Upload the wordlist to the Elasticsearch index

To upload the word list into the created index, use the command:

```bash
docker-compose exec app php /var/www/html/load_wordlist.php
```

This will upload the words from the `elasticsearch-wordlist.txt` file into Elasticsearch.

### 4) Test autocomplete

To test autocomplete functionality, run the command:

```bash
docker-compose exec app php /var/www/html/autocomplete.php
```

Afterward, input a search word. For example:

```bash
Input search query: app
```

### Result:

After entering the search word, you will get a list of relevant words:

```
1. apple
2. applesauce
3. application
4. applications
5. api
6. apricot
7. _security/api_key
```

## Notes

- To work correctly, Elasticsearch must be accessible through port 9200 on localhost.
- The wordlist for autocomplete is stored in the `elasticsearch-wordlist.txt` file.