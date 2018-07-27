<?php
/*
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
    */
    $app->add(new \Tuupola\Middleware\HttpBasicAuthentication([
        "path" => "/",
        "realm" => "Protected",
        "ignore" => ["/login"],
        "authenticator" => new PdoAuthenticator([
            "pdo" => $container['db'],
            "table" => "usuario",
            "user" => "username",
            "hash" => "userpass"
        ]),
        "error" => function ($response, $arguments) {
            $data = [];
            $data["status"] = "error";
            $data["message"] = $arguments["message"];
            return $response->write(json_encode($data, JSON_UNESCAPED_SLASHES));
        }
    ]));
    