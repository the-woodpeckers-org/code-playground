<?php

namespace Database\Seeders;

use App\Models\Cv;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cv = new Cv();
        $cv->user_id = 1;
        $cv->content = '[{"type":"info","name":"John Doe","table1":{"class":"info-table1","label":["Address:","Phone:","Email:"],"content":["123 State St.<br>Oslo, Norway","555-123-4567","john@polygonal.eu"]},"table2":{"class":"info-table2","label":["Website:","Linkedin","Twitter:"],"content":["https://polygonal.eu","https://www.linkedin.com/","@johndoe"]}},{"type":"single-block","title":"About Me","list":["I am a brewer with 12 years of experience, specialized in wild yeast fermentation and barrel-aging."]},{"type":"listing","title":"Professional Experience","list":[{"date":"2017-2020","location":"Polygonal Brewing Co.","position":"\n        \n        \n        \n        Head Brewer\n        \n        \n        \n        ","description":"\n        \n        \n        \n        As head brewer, I partner with the marketing team to plan recipes and the production schedule. I manage a team of 4 people and ensure inventory is up to date.\n        \n        \n        \n        "},{"date":"2015-2017","location":"Polygonal Brewing Co.","position":"\n        \n        \n        \n        Assistant Brewer\n        \n        \n        \n        ","description":"\n        \n        \n        \n        As assistant brewer I was in charge of production, facility sanitation, product packaging, while ensuring proper brewing and hygiene routines.\n        \n        \n        \n        "},{"date":"2013-2015","location":"Polygonal Taproom","position":"\n        \n        \n        \n        Bartender\n        \n        \n        \n        ","description":"\n        \n        \n        \n        On top of customer relations, I maintained cleanliness of taps and beer lines to ensure optimal product quality. I also organized various events and special releases.\n        \n        \n        \n        "}]},{"type":"listing","title":"Education","list":[{"date":"2015","location":"Institute of Brewing","position":"\n        \n        \n        \n        Certificate in Brewing\n        \n        \n        \n        ","description":"\n        \n        \n        \n        This certificate covers all aspects of beer production from recipe inception, to process and packaging.\n        \n        \n        \n        "},{"date":"2012-2014","location":"University of Grenoble","position":"\n        \n        \n        \n        Bachelor in Communications\n        \n        \n        \n        ","description":"\n        \n        \n        \n        This degree trained me in public relations and online communications with a special focus on social media.\n        \n        \n        \n        "}]},{"type":"three-column","title":"Skills","list":["Brewing","Recipe Inception","Barrel Aging","Beersmith","Fluent in French and English","Office Suite","Various Social Media Platforms"]},{"type":"three-column","title":"Interests","list":["Reading","Music","Cooking","Writing","Rock Climbing"]}]';
        $cv->title='test';
        $cv->save();
    }
}
