<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$summary="El club de fútbol turco Galatasaray informó este domingo en su cuenta oficial de Twitter que el portero uruguayo Fernando Muslera sufrió una fractura de tibia y peroné durante el partido por la Superliga Turca contra el Caykur Rizespor, que el conjunto de Muslera perdió por 2-0.";
    	$content="<p>El equipo napolitano marc&oacute; sus cuatro penales, con Lorenzo Insigne, Matteo Politano, el serbio Nemanja Maksimovic y el polaco Arkadiusz Milik mientras que en el Juventus fallaron el argentino Paulo Dybala y el brasile&ntilde;o Danilo Luiz Da Silva, lo que coron&oacute; campe&oacute;n al equipo del t&eacute;cnico Gennaro Gattuso.</p><p>Tambi&eacute;n en los 90 minutos Napoli habia tenido las mejores oportunidades, pero se topo con el poste con una falta directa de Lorenzo Insigne y con un Buffon que realiz&oacute; tres paradas de m&eacute;rito, la &uacute;ltima de ellas a pocos segundos del final.</p><p>Rodrigo Bentancur disput&oacute; los 90 minutos del juego en un equipo que tuvo un pobre rendimiento, igualmente, el uruguayo tuvo una actuaci&oacute;n aceptable.</p>";

        $news = [
        	['id' => 1, 'image' => 'noticia3de5.png', 'title' => 'El Universitario FC anuncia el compromiso del entrenador Carlos Marín Lópezes', 'slug' => 'el-universitario-fc-anuncia-el-compromiso-del-entrenador-carlos-marin-lopezes', 'summary' => $summary, 'content' => $content, 'video' => 'https://www.youtube.com/watch?v=Y-NeVAOkMlI', 'featured' => '1', 'comment' => '1', 'state' => '1', 'created_at' => Carbon\Carbon::create(2020, 07, 02)],
        	['id' => 2, 'image' => 'noticia5de5.png', 'title' => 'Una nueva Generación de Campeones', 'slug' => 'una-nueva-generacion-de-campeones', 'summary' => $summary, 'content' => $content, 'video' => 'https://www.youtube.com/watch?v=Y-NeVAOkMlI', 'featured' => '1', 'comment' => '1', 'state' => '1', 'created_at' => Carbon\Carbon::create(2020, 07, 03)],
        	['id' => 3, 'image' => 'noticia2de5.png', 'title' => 'El Nápoles, festeja y va directo a la Final de la Copa', 'slug' => 'el-napoles-festeja-y-va-directo-a-la-final-de-la-copa', 'summary' => $summary, 'content' => $content, 'video' => 'https://www.youtube.com/watch?v=Y-NeVAOkMlI', 'featured' => '1', 'comment' => '1', 'state' => '1', 'created_at' => Carbon\Carbon::create(2020, 07, 03)],
        	['id' => 4, 'image' => 'noticia4de5.png', 'title' => 'Un gol que lo cambio todo...', 'slug' => 'un-gol-que-lo-cambio-todo', 'summary' => $summary, 'content' => $content, 'video' => 'https://www.youtube.com/watch?v=Y-NeVAOkMlI', 'featured' => '1', 'comment' => '1', 'state' => '1', 'created_at' => Carbon\Carbon::create(2020, 07, 03)],
        	['id' => 5, 'image' => 'noticia1de5.png', 'title' => 'Real Sociedad se hizo respetar en la última etapa y cambio el fixture en un interesante partido', 'slug' => 'real-sociedad-se-hizo-respetar-en-la-ultima-etapa-y-cambio-el-fixture-en-un-interesante-partido', 'summary' => $summary, 'content' => $content, 'video' => 'https://www.youtube.com/watch?v=Y-NeVAOkMlI', 'featured' => '1', 'comment' => '1', 'state' => '1', 'created_at' => Carbon\Carbon::create(2020, 07, 04)],
        	['id' => 6, 'image' => 'noticiadestacada4de4.png', 'title' => 'Siete curiosidades del estadio Alfredo Di Stéfano', 'slug' => 'siete-curiosidades-del-estadio-alfredo-di-stefano', 'summary' => $summary, 'content' => $content, 'video' => 'https://www.youtube.com/watch?v=Y-NeVAOkMlI', 'featured' => '2', 'comment' => '1', 'state' => '1', 'created_at' => Carbon\Carbon::create(2020, 07, 04)],
        	['id' => 7, 'image' => 'noticiadestacada3de4.png', 'title' => 'Nuevamente el talento femenino se apodero del Clásico', 'slug' => 'nuevamente-el-talento-femenino-se-apodero-del-clasico', 'summary' => $summary, 'content' => $content, 'video' => 'https://www.youtube.com/watch?v=Y-NeVAOkMlI', 'featured' => '2', 'comment' => '1', 'state' => '1', 'created_at' => Carbon\Carbon::create(2020, 07, 04)],
        	['id' => 8, 'image' => 'noticiadestacada2de4.png', 'title' => 'Mallorca derrota 1 a 0 a Barcelona', 'slug' => 'mallorca-derrota-1-a-0-a-barcelona', 'summary' => $summary, 'content' => $content, 'video' => 'https://www.youtube.com/watch?v=Y-NeVAOkMlI', 'featured' => '2', 'comment' => '1', 'state' => '1', 'created_at' => Carbon\Carbon::create(2020, 07, 04)],
        	['id' => 9, 'image' => 'noticiadestacada1de4.png', 'title' => 'Ronaldo y Messi vuelven a las canchas en los tiempos del COVID-19', 'slug' => 'ronaldo-y-messi-vuelven-a-las-canchas-en-los-tiempos-del-covid-19', 'summary' => $summary, 'content' => $content, 'video' => 'https://www.youtube.com/watch?v=Y-NeVAOkMlI', 'featured' => '2', 'comment' => '1', 'state' => '1', 'created_at' => Carbon\Carbon::create(2020, 07, 04)],
        	['id' => 10, 'image' => 'noticiadestacada3.jpg', 'title' => 'Zidane: "We are not goint to change the way we play at the Calderón"', 'slug' => 'zidane-we-are-not-goint-to-change-the-way-we-play-at-the-calderon', 'summary' => $summary, 'content' => $content, 'video' => 'https://www.youtube.com/watch?v=Y-NeVAOkMlI', 'featured' => '3', 'comment' => '1', 'state' => '1', 'created_at' => Carbon\Carbon::create(2020, 07, 04)],
        	['id' => 11, 'image' => 'noticiadestacada3.jpg', 'title' => "NFL will handle referee Pete Morelli's use of profanity internally", 'slug' => "nfl-will-handle-referee-pete-morellis-use-of-profanity-internally", 'summary' => $summary, 'content' => $content, 'video' => 'https://www.youtube.com/watch?v=Y-NeVAOkMlI', 'featured' => '3', 'comment' => '1', 'state' => '1', 'created_at' => Carbon\Carbon::create(2020, 07, 04)],
    	];
    	DB::table('news')->insert($news);
    }
}
