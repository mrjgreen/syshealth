<?php namespace Syshealth;

class RequestException extends \Exception
{

}
class RequestHttpException extends RequestException
{

}
class RequestCurlException extends RequestException
{

}

class Request
{
    protected $endPoint;

    protected $secure;

    protected $user;

    protected $pass;

    public function __construct($endPoint, $secure = false)
    {
        $this->endPoint = rtrim($endPoint, '/');

        $this->secure = $secure;
    }

    public function useBasicAuth($user, $pass)
    {
        $this->user = $user;

        $this->pass = $pass;
    }

    public function post(array $payload = array())
    {
        $protocol = $this->secure ? 'https' : 'http';

        $host = $protocol . '://' . $this->endPoint;
        // Setup cURL
        $ch = curl_init($host);

        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_POSTFIELDS => $payload
        ));

        if($this->secure)
        {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }

        if($this->user)
        {
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, $this->user . ":" . $this->pass);
        }

        // Send the request
        $response = curl_exec($ch);

        // Check for errors
        if ($response === false) {
            throw new RequestCurlException(curl_error($ch));
        }

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpcode != 200) {
            throw new RequestHttpException("CURL received HTTP code [ $httpcode ] from host [ $host ]");
        }

        return $response;
    }
}