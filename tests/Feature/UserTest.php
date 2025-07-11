<?php

use App\Enums\UserRole;
use App\Models\User;

test('admin can change user role to manager', function () {
    $admin = User::factory()->create();
    $user = User::factory()->create();

    $admin->assignRole(UserRole::ADMIN);
    $user->assignRole(UserRole::USER);

    $this->actingAs($admin);

    $response = $this->post('api/change-role',[
        'user_id' => $user->id,
        'role_name' => UserRole::MANAGER->value
    ])->assertStatus(200);

    $response->assertJsonFragment([
        'name' => $user->name,
        'email' => $user->email,
        'role' => UserRole::MANAGER->value
    ]);


});

test('admin can change manager role to user', function () {
    $admin = User::factory()->create();
    $manager= User::factory()->create();

    $admin->assignRole(UserRole::ADMIN);
    $manager->assignRole(UserRole::MANAGER);

    $this->actingAs($admin);

    $response = $this->post('api/change-role',[
        'user_id' => $manager->id,
        'role_name' => UserRole::USER->value
    ])->assertStatus(200);

    $response->assertJsonFragment([
        'name' => $manager->name,
        'email' => $manager->email,
        'role' => UserRole::USER->value
    ]);


});


test('admin cannot change other admin role',function(){

    $admin_1 = User::factory()->create();
    $admin_2= User::factory()->create();


    $admin_1->assignRole(UserRole::ADMIN);
    $admin_2->assignRole(UserRole::ADMIN);

    $this->actingAs($admin_1);

    $this->post('api/change-role',[
        'user_id'=> $admin_1->id,
        'role_name' => UserRole::USER->value
    ])->assertStatus(403);

    $this->post('api/change-role',[
        'user_id'=> $admin_1->id,
        'role_name' => UserRole::MANAGER->value
    ])->assertStatus(403);

});

test('admin cannot change it\'s own role',function(){
    $admin = User::factory()->create();

    $admin->assignRole(UserRole::ADMIN);

    $this->actingAs($admin);


    $this->post('api/change-role',[
        'user_id'=> $admin->id,
        'role_name'=> UserRole::USER->value
    ])->assertStatus(403);

    $this->post('api/change-role',[
        'user_id'=> $admin->id,
        'role_name'=> UserRole::MANAGER->value
    ])->assertStatus(403);
});

test('non-admin cannot change other user\'s role',function(){
    $user_1 = User::factory()->create();
    $user_2 = User::factory()->create();

    $user_1->assignRole(UserRole::MANAGER);
    $user_2->assignRole(UserRole::USER);

    $this->actingAs($user_1);

    $this->post('api/change-role',[
        'user_id'=> $user_2->id,
        'role_name'=> UserRole::MANAGER->value
    ])->assertStatus(403);

    $this->actingAs($user_2);

    $this->post('api/change-role',[
        'user_id'=> $user_1->id,
        ''=> UserRole::USER->value
    ])->assertStatus(403);

});

