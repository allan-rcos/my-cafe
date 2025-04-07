<?php

namespace App\Libraries;

use CodeIgniter\View\Table;

class TableHandler
{
    /** @var array<string, string> */
    protected $template = [
        'table_open' => '<table class="table">',

        'thead_open'  => '<thead>',
        'thead_close' => '</thead>',

        'heading_row_start'  => '<tr>',
        'heading_row_end'    => '</tr>',
        'heading_cell_start' => '<th scope="col">',
        'heading_cell_end'   => '</th>',

        'tfoot_open'  => '<tfoot>',
        'tfoot_close' => '</tfoot>',

        'footing_row_start'  => '<tr>',
        'footing_row_end'    => '</tr>',
        'footing_cell_start' => '<td>',
        'footing_cell_end'   => '</td>',

        'tbody_open'  => '<tbody>',
        'tbody_close' => '</tbody>',

        'row_start'  => '<tr>',
        'row_end'    => '</tr>',
        'cell_start' => '<td>',
        'cell_end'   => '</td>',

        'row_alt_start'  => '<tr>',
        'row_alt_end'    => '</tr>',
        'cell_alt_start' => '<td>',
        'cell_alt_end'   => '</td>',

        'table_close' => '</table>',
    ];

    private string $dir;

    private Table $table;

    function __construct()
    {
        $this->table = new Table();
        $this->table->setTemplate($this->template);
        $this->table->setSyncRowsWithHeading(true);
    }

    public function createTable(string $dir): void
    {
        $this->table->clear();
        $this->dir = $dir;
    }

    public function setPaginator(string $pager_links): void
    {
        $this->table->setCaption($pager_links);
    }

    /** @param array<string, string> $heading */
    public function setHeading(array $heading): void
    {
        $heading['links'] = $this->getHeadingLinks();
        $this->table->setHeading($heading);
    }

    /** @param array<string, string> $row */
    public function addRow(array $row): void
    {
        $row['links'] = $this->getLinks($row['id']);
        $this->table->addRow($row);
    }

    public function generate(): string
    {
        return $this->table->generate();
    }

    private function getHeadingLinks(): string
    {
        $url = url_to($this->dir.'-create');
        return "<a href=\"$url\"><i class=\"icon ion-plus icon-badge bg-success\"></i></a>";
    }

    private function getLinks(string $id): string
    {
        $edit_url = url_to($this->dir.'-edit', $id);
        $edit_anchor = "<a href=\"$edit_url\"><i class=\"icon ion-edit icon-badge\"></i></a>";
        $remove_url = url_to($this->dir.'-remove', $id);
        $remove_anchor = "<a href=\"$remove_url\"><i class=\"icon ion-trash-b icon-badge\"></i></a>";
        return $edit_anchor.$remove_anchor;
    }
}