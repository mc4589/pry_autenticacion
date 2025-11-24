<?php
namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserFactory extends Factory
{
    protected $model = User::class;
    {
    return [
            'nombre' => fake()->name(),                         
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),              
            'perfil' => 'usuario',                               
            'remember_token' => Str::random(10),
        ];
    }
// Estado para crear administradores
    public function administrador(): static
    {
        return $this->state(fn () => [
            'perfil' => 'administrador',
        ]);
    }
}
    

