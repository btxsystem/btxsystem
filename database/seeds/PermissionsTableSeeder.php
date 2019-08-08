<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [

            [ 'id' => '200'  , 'name' => 'System.Users.Create'],
            [ 'id' => '201'  , 'name' => 'System.Users.Edit'],  
            [ 'id' => '202'  , 'name' => 'System.Users.Delete'],
            [ 'id' => '203'  , 'name' => 'System.Roles.Create'],
            [ 'id' => '204'  , 'name' => 'System.Roles.Edit'],  
            [ 'id' => '205'  , 'name' => 'System.Roles.Delete'],
            [ 'id' => '206'  , 'name' => 'System.Users.View'],  
            [ 'id' => '207'  , 'name' => 'System.Roles.View'],  
            [ 'id' => '208'  , 'name' => 'Member.Member.View'], 
            [ 'id' => '209'  , 'name' => 'Member.Member.Create'],
            [ 'id' => '210'  , 'name' => 'Member.Member.Edit'], 
            [ 'id' => '211'  , 'name' => 'Member.Member.Delete'],      
            [ 'id' => '212'  , 'name' => 'Customer.Customer.View'],  
            [ 'id' => '213'  , 'name' => 'Customer.Customer.Create'],
            [ 'id' => '214'  , 'name' => 'Customer.Customer.Edit'],  
            [ 'id' => '215'  , 'name' => 'Customer.Customer.Delete'],
            [ 'id' => '216'  , 'name' => 'Tree.Tree.View'],          
            [ 'id' => '217'  , 'name' => 'Tree.Tree.Create'],          
            [ 'id' => '218'  , 'name' => 'Tree.Tree.Edit'],          
            [ 'id' => '219'  , 'name' => 'Tree.Tree.Delete'],          
            [ 'id' => '220'  , 'name' => 'Training.Management.View'],
            [ 'id' => '221'  , 'name' => 'Training.Class.View'],       
            [ 'id' => '222'  , 'name' => 'Bitrex.Points.View'],      
            [ 'id' => '223'  , 'name' => 'Bitrex.Points.Create'],      
            [ 'id' => '224'  , 'name' => 'Bitrex.Points.Edit'],      
            [ 'id' => '225'  , 'name' => 'Bitrex.Points.Delete'],      
            [ 'id' => '226'  , 'name' => 'Bitrex.Cash.View'],          
            [ 'id' => '227'  , 'name' => 'Bitrex.Cash.Create'],      
            [ 'id' => '228'  , 'name' => 'Bitrex.Cash.Edit'],          
            [ 'id' => '229'  , 'name' => 'Bitrex.Cash.Delete']

        ];

        Permission::insert($permissions);
    }
}
