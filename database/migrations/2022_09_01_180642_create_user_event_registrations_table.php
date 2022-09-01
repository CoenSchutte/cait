<?php

use App\Models\EventRegistration;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('user_event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(EventRegistration::class);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_event_registrations');
    }
};
