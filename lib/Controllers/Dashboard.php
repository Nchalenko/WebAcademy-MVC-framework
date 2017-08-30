<?php

namespace Controller;

class Dashboard extends Base
{
    public function getIndex()
    {
        // Get last 4 created movies, books, music items
        $data = [
            'Limit'     => 4,
            'SortField' => 'id',
            'SortOrder' => 'desc',
        ];
        $items = [];

        // shuffle($items);
        $this->app->render('index.php', [
            'title'     => gettext('Home'),
            'items'     => $items,
        ]);
    }
}
