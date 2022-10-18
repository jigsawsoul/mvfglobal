<?php

namespace MVFGlobal;


class Github
{
    private $data = [];

    private function query($endpoint)
    {   
        // Query github
        $response = wp_remote_get("https://api.github.com/users/$endpoint", [
            'timeout' => 5000,
            'headers' => [
                'Authorization' => 'Bearer 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',
            ],
        ]);

        $body = wp_remote_retrieve_body($response);

        // Decode response to array
        $body = json_decode($body, true);

        $status = wp_remote_retrieve_response_code($response);

        // Check status is succesful from github
        if ($status !== 200) {
            return $this->data = [
                'data' => $body['message'],
                'status' => $status
            ];
        }

        // Check if there as been an internal error
        if (is_wp_error($body)) {
            return $this->data = [
                'data' => 'An internal error has occurred',
                'status' => 500
            ];
        }

        return $this->data = [
            'data' => $body,
            'status' => $status
        ];
    }

    public function queryUser(string $username)
    {
        $this->query($username);
        return $this;       
    }

    public function queryUserRepos(string $username)
    {
        $this->query("$username/repos");
        return $this;       
    }

    public function data(): array
    {
        return $this->data;
    }

    public function mostPopularLanguage()
    {
        // Check data response status
        if ($this->data['status'] !== 200) {
            return $this->data;
        }

        // Pluck values from 'language' column
        $data = array_column($this->data['data'], 'language');

        // Remove 'null' values
        $data = array_filter($data);

        // Count array values and their frequency
        $data = array_count_values($data);
        
        // Order by most frequent
        arsort($data);

        // Return most frequent language
        return array_key_first($data);
    }
}
