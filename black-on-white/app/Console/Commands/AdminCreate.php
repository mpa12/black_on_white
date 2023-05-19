<?php

namespace App\Console\Commands;

use App\Mail\UserDataEmail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создание администратора';

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:users', 'max:255'],
            'email' => ['required', 'email', 'unique:users', 'max:255'],
        ];
    }

    public function handle(): int
    {
        $name = $this->ask('Введите имя пользователя');
        $email = $this->ask('Введите e-mail пользователя');
        $password = Str::random(32);
        $token = Str::random(32);

        $validator = Validator::make(['name' => $name, 'email' => $email], $this->rules());

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) $this->error($error);
            return Command::FAILURE;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'api_token' => $token,
            'is_admin' => true
        ]);

        Mail::to($user->email)->queue(new UserDataEmail($user, $password));

        $this->info("Администратор создан!");
        return Command::SUCCESS;
    }
}
