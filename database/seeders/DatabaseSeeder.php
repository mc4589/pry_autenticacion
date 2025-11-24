<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
    {
        public function run(): void
        {
             // 1. Crea un usuario específico 
        User::factory()->create([
            'nombre' => 'Camilo López',
            'email' => 'camilo@example.com',
            'perfil' => 'administrador',
        ]);
        }
    }
    
            
