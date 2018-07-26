<?php
$pdo = new \PDO("mysql:host=localhost;dbname=databasename", "username");
$app->add(new \Slim\Middleware\HttpBasicAuthentication([
    "path" => "/main",
    "realm" => "Protected",
    "authenticator" => new PdoAuthenticator([
        "pdo" => $pdo,
        "table" => "accounts",
        "user" => "accountUsername",
        "hash" => "accountPassword"
    ]),
    "callback" => function ($request, $response, $arguments) use ($app) {
        return $response->withRedirect('/main/contacts');
    }