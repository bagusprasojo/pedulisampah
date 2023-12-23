<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCreatedAtColumnToTrashreports extends Migration
{
    public function up()
    {
        $this->forge->addColumn('trashreports', [
            'created_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        ]);
    }


    public function down()
    {
        //
    }
}
