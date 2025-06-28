<?php

return [
    "labels" => [
        "search" => "Search",
        "base_url" => "Base URL",
    ],

    "auth" => [
        "none" => "This API is not authenticated.",
        "instruction" => [
            "query" => <<<TEXT
                To authenticate requests, include a query parameter **`:parameterName`** in the request.
                TEXT,
            "body" => <<<TEXT
                To authenticate requests, include a parameter **`:parameterName`** in the body of the request.
                TEXT,
            "query_or_body" => <<<TEXT
                To authenticate requests, include a parameter **`:parameterName`** either in the query string or in the request body.
                TEXT,
            "bearer" => <<<TEXT
                To authenticate requests, include an **`Authorization`** header with the value **`"Bearer :placeholder"`**.
                TEXT,
            "basic" => <<<TEXT
                To authenticate requests, include an **`Authorization`** header in the form **`"Basic {credentials}"`**.
                The value of `{credentials}` should be your username/id and your password, joined with a colon (:),
                and then base64-encoded.
                TEXT,
            "header" => <<<TEXT
                Для аутентификации запросов включите заголовок **`:parameterName`** со значением **`":placeholder"`**.
                TEXT,
            "static_key" => <<<TEXT
                sdfsd
                TEXT,

        ],
        "details" => <<<TEXT
            All authenticated endpoints are marked with a `requires authentication` badge in the documentation below.
            TEXT,
    ],

    "headings" => [
        "introduction" => "Вступление",
        "auth" => "Авторизация запросов",
    ],

    "endpoint" => [
        "request" => "Запрос",
        "headers" => "Заголовки",
        "url_parameters" => "URL Parameters",
        "body_parameters" => "Body Parameters",
        "query_parameters" => "Query Parameters",
        "response" => "Ответ",
        "response_fields" => "Response Fields",
        "example_request" => "Пример запроса",
        "example_response" => "Пример ответа",
        "responses" => [
            "binary" => "Binary data",
            "empty" => "Empty response",
        ],
    ],

    "try_it_out" => [
        "open" => "Протестировать ⚡",
        "cancel" => "Отмена 🛑",
        "send" => "Отправить запрос 💥",
        "loading" => "⏱ Отправка...",
        "received_response" => "Полученный ответ",
        "request_failed" => "Request failed with error",
        "error_help" => <<<TEXT
            Tip: Check that you're properly connected to the network.
            If you're a maintainer of ths API, verify that your API is running and you've enabled CORS.
            You can check the Dev Tools console for debugging information.
            TEXT,
    ],

    "links" => [
        "postman" => "View Postman collection",
        "openapi" => "View OpenAPI spec",
    ],
];
