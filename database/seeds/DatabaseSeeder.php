<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(TestTableSeeder::class);
        $this->call(BenefitsTableSeeder::class);
        $this->call(CatBenefitsTableSeeder::class);
        $this->call(CampainsTableSeeder::class);
        $this->call(CommissionsTableSeeder::class);
        $this->call(ConfsTableSeeder::class);
        $this->call(ContentsTableSeeder::class);
        $this->call(DichvusTableSeeder::class);
        $this->call(DocsTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(PeopleTableSeeder::class);
        $this->call(PricesTableSeeder::class);
        $this->call(PromotionsTableSeeder::class);
        $this->call(QasTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(WebinfosTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(CustomerDatabaseManagerTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TemplateInvoiceManagersTableSeeder::class);
    }
}
