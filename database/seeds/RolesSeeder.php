<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles=[[1,'admin','Admin'],[2,'manager','Manager']
        ,[3,'workadmin','Workadmin'],[4,'worker','Worker']];
        foreach($roles as $role){
              DB::table('roles')->insert([
            'id' => $role[0],     
            'name' => $role[1],
            'label' => $role[2],
        ]);
        };

        $roleusers=[
        [1,1],[1,2],[1,3],[1,4],  //root 1,2,3,4
        [2,2],[2,3],[2,4],  //manager 2,3,4
      //  [2,2],[2,3], //manager és workadmin 2,3
      //  [3,3],[4,3], //workadminok 3
      //  [5,4],[6,4], //workerek 4
    ];
        foreach($roleusers as $roleuser){
              DB::table('role_user')->insert([
            'role_id' => $roleuser[1],
            'user_id' => $roleuser[0],
        ]);
        }
    }
}
