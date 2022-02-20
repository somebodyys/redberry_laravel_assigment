<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = [
            'Gatsby.js (web framework)' => 'GatsbyJS is a free, open-source, React-based framework designed to help developers build performant websites and apps. Put simply, GatsbyJS is a static site generator that leverages React.',
            'AWS Big Data' => 'AWS provides the broadest selection of analytics services that fit all your data analytics needs and enables organizations of all sizes and industries to reinvent their business with data. From data movement, data storage, data lakes, big data analytics, log analytics, streaming analytics, and machine learning (ML) to anything in between, AWS offers purpose-built services that provide the best price-performance, scalability , and lowest cost.',
            'React Hooks' => 'This new function useState is the first “Hook” we’ll learn about, but this example is just a teaser. Don’t worry if it doesn’t make sense yet!',
            'Microsoft Azure Architecture' => 'Today, the way applications are being designed, depends on how rapidly the cloud is evolving. Applications are now broken down into smaller and decentralized services instead of having them as monoliths. These services communicate through APIs or by using asynchronous messaging or eventing. Applications scale horizontally, adding new instances as demand requires.',
            'Next.js (web framework)' => 'Next.js is an open-source development framework built on top of Node.js enabling React based web applications functionalities such as server-side rendering and generating static websites.',
            'Apache Airflow (data processing)' => 'Apache Airflow is an open-source workflow management platform for data engineering pipelines. It started at Airbnb in October 2014 as a solution to manage the companys increasingly complex workflows.'
        ];

        foreach ($skills as $name => $description) {
            Skill::create([
                'name' => $name,
                'description' => $description
            ]);
        }
    }
}
