<?php
namespace App\Helpers;
use Exception;
class ZplPrinter
{
    protected $socket;
    public function __construct(string $host, int $port){
        $this->connect($host, $port);
    }
    public function __destruct(){
        $this->disconnect();
    }

    public static function printer(string $host, int $port): self{
        return new static($host, $port);
    }

    protected function connect(string $host, int $port): void{
        $this->socket = @socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if (!$this->socket || !@socket_connect($this->socket, $host, $port)) {
            $error = $this->getLastError();
            throw new Exception("Connection failed: " . $error['message'], $error['code']);
        }
    }

    protected function disconnect(): void
    {
        @socket_close($this->socket);
    }

    public function send(string $zpl): void
    {
        if (!@socket_write($this->socket, $zpl)) {
            $error = $this->getLastError();
            throw new Exception("Sending data failed: " . $error['message'], $error['code']);
        }
    }

    protected function getLastError(): array
    {
        $code = socket_last_error($this->socket);
        $message = socket_strerror($code);
        return compact('code', 'message');
    }
}
