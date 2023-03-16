<?php
namespace App\Services;

use GuzzleHttp\Client;

class SymfonyApi
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://symfony-skeleton.q-tests.com/api/',
        ]);
    }

    public function login(string $email, string $password)
    {
        $response = $this->client->request('POST', 'v2/token', [
            'json' => [
                'email' => $email,
                'password' => $password,
            ],
        ]);

        $statusCode = $response->getStatusCode();

        if ($statusCode === 200) {
            $content = $response->getBody()->getContents();
            $data = json_decode($content, true);

            return $data['token_key'];
        } else {
            return redirect()->back()->with('message','Invalid Credentials');
        }
    }
    public function getLoggedInUser(string $accessToken)
    {
        $response = $this->client->request('GET', 'v2/me', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);
        

        $statusCode = $response->getStatusCode();

        if ($statusCode === 200) {
            $content = $response->getBody()->getContents();
            $data = json_decode($content, false);

            return $data;
        } else {
            // handle error
        }
    }

    public function getAllAuthors(string $accessToken)
    {
        $response = $this->client->request('GET', 'v2/authors?orderBy=id&direction=ASC&limit=12&page=1', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);
        

        $statusCode = $response->getStatusCode();

        if ($statusCode === 200) {
            $content = $response->getBody()->getContents();
            $data = json_decode($content, false);

            return $data;
        } else {
            // handle error
        }
    }

    public function deleteAuthor(string $id,string $accessToken)
    {
        $response = $this->client->request('DELETE', 'v2/authors/'.$id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);
        

        $statusCode = $response->getStatusCode();

        if ($statusCode === 204) {
            return redirect()->back();
        } else {
            // handle error
        }
    }

    public function deleteBook(string $id,string $accessToken)
    {
        $response = $this->client->request('DELETE', 'v2/books/'.$id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);
        

        $statusCode = $response->getStatusCode();

        if ($statusCode === 204) {
            return redirect()->back();
        } else {
            // handle error
        }
    }

    public function getAuthor(string $id,string $accessToken)
    {
        $response = $this->client->request('GET', 'v2/authors/'.$id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);
        

        $statusCode = $response->getStatusCode();

        if ($statusCode === 200) {
            $content = $response->getBody()->getContents();
            $data = json_decode($content, false);

            return $data;
        } else {
            // handle error
        }
    }

    public function CreateBook(string $accessToken,string $author_id,string $title,string $release_date,string $description,string $isbn,string $format,string $number_of_pages)
    {
        
        $response = $this->client->request('POST', 'v2/books', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
            'json' => [
                'author' => ["id" =>$author_id],
                'title' => $title,
                'release_date' => $release_date,
                'description' => $description,
                'isbn' => $isbn,
                'format' => $format,
                'number_of_pages' => $number_of_pages,
            ],
        ]);

        $statusCode = $response->getStatusCode();

        if ($statusCode === 200) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back();
        }
    }
}
