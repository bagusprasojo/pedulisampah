<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTrashreportsTable extends Migration
{
    public function up()
{
    $this->forge->addField([
        'id' => [
            'type' => 'INT',
            'constraint' => 5,
            'unsigned' => true,
            'auto_increment' => true,
        ],
        'user_id' => [
            'type' => 'INT',
            'constraint' => 5,
        ],
        'location' => [
            'type' => 'VARCHAR',
            'constraint' => 255,
        ],
        'description' => [
            'type' => 'TEXT',
        ],
        'photo' => [
            'type' => 'LONGTEXT',
            'null' => true, // Jika kolom bisa kosong
        ],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('trashreports');
}


    public function down()
    {
        //
    }
}
