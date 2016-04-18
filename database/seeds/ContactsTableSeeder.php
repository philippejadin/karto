<?php

use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag1 = App\Tag::create(['name' => 'Enseignement', 'color' => '#eee', ]);
        $tag2 = App\Tag::create(['name' => 'ASBL', 'color' => '#0ee', ]);
        $tag3 = App\Tag::create(['name' => 'Enfance', 'color' => '#e0e', ]);
        $tag4 = App\Tag::create(['name' => 'Minstère', 'color' => '#e00', ]);

        $contact1 = App\Contact::create(['name' => 'Ecole numéro 1', 'address' => 'rue josaphat, 14', 'postal_code' => '1030', 'country'=> 'Belgique']);
        $contact1->geocode();
        $contact1->save();
        $contact1->tags()->attach($tag1);
        $contact1->tags()->attach($tag3);


        $contact2 = App\Contact::create(['name' => 'Communauté française', 'address' => 'Boulevard Léopold II', 'postal_code' => '1080', 'country'=> 'Belgique']);
        $contact2->geocode();
        $contact2->save();
        $contact2->tags()->attach($tag3);
        $contact2->tags()->attach($tag4);


        $contact3 = App\Contact::create(['name' => 'ASBL machin', 'address' => 'Rue de namur', 'postal_code' => '1300', 'country'=> 'Belgique']);
        $contact3->geocode();
        $contact3->save();
        $contact3->tags()->attach($tag2);
        $contact3->tags()->attach($tag3);

        $contact4 = App\Contact::create(['name' => 'ASBL en Australie', 'country'=> 'Australie']);
        $contact4->geocode();
        $contact4->save();
        $contact4->tags()->attach($tag2);
        $contact4->tags()->attach($tag3);

    }

    
}
