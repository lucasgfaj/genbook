<?php

namespace Core\Http;

class Request
{
    private string $method;
    private string $uri;

    /** @var mixed[] */
    private array $params;

    /** @var array<string, string> */
    private array $headers;

    public function __construct()
    {
        $this->method = $_REQUEST['_method'] ?? $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->params = $_REQUEST;
        $this->headers = function_exists('getallheaders') ? getallheaders() : [];
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    /** @return mixed[] */
    public function getParams(): array
    {
        return $this->params;
    }

    /** @return array<string, string>*/
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /** @param mixed[] $params*/
    public function addParams(array $params): void
    {
        $this->params = array_merge($this->params, $params);
    }

    public function acceptJson(): bool
    {
        return (isset($_SERVER['HTTP_ACCEPT']) && $_SERVER['HTTP_ACCEPT'] === 'application/json');
    }

    public function getParam(string $key, mixed $default = null): mixed
    {
        return $this->params[$key] ?? $default;
    }

    public function hasFile(string $key): bool
    {
        return isset($_FILES[$key]) && is_uploaded_file($_FILES[$key]['tmp_name']);
    }
    /**
     * Retorna os dados do arquivo enviado.
     *
     * @param string $key Chave do arquivo no array $_FILES
     * @return array|null Retorna os dados do arquivo ou null se não existir
     */
    public function file(string $key): ?array
    {
        return $this->hasFile($key) ? $_FILES[$key] : null;
    }
}
