<?php

namespace Webimpress\GithubLabels;

class User extends \Github\Api\User
{
    public function repositories($username, $type = 'owner', $sort = 'full_name', $direction = 'asc', $page = 1)
    {
        return $this->get('/users/' . rawurlencode($username) . '/repos', [
            'type'      => $type,
            'sort'      => $sort,
            'direction' => $direction,
            'page'      => $page,
        ]);
    }
}
