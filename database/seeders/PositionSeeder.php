<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            'Data Scientist' => 'Data scientists are analytical experts who utilize their skills in both technology and social science to find trends and manage data. They use industry knowledge, contextual understanding, skepticism of existing assumptions – to uncover solutions to business challenges.',
            'Software Developer' => 'Software developers are the creative, brainstorming masterminds behind computer programs of all sorts. While some software developers may focus on a specific program or app, others create giant networks or underlying systems that help trigger and power other programs. This is why there are two main classifications of developers: applications software developers and systems software developers.',
            'Information Security Analyst' => 'Information security analysts plan and carry out security measures to protect an organizations computer networks and systems. Work Environment. Most information security analysts work for computer companies, consulting firms, or business and financial companies.',
            'Computer Systems Analyst' => 'Employment of computer systems analysts is projected to grow 7 percent from 2020 to 2030, about as fast as the average for all occupations.About 47,500 openings for computer systems analysts are projected each year, on average, over the decade. Many of those openings are expected to result from the need to replace workers who transfer to different occupations or exit the labor force, such as to retire.',
            'Web Developer' => 'A web developer is a programmer or a coder who specializes in, or is specifically engaged in, the development of World Wide Web applications using a client–server model.',
            'Sales Engineer' => 'Sales engineering is a hybrid of sales and engineering that exists in industrial and commercial markets. Buying decisions in these markets are made differently than those in many consumer contexts, being based more on technical information and rational analysis and less on style, fashion, or impulse.'
        ];

        foreach ($positions as $name => $description) {
            Position::create([
                'name' => $name,
                'description' => $description
            ]);
        }
    }
}
