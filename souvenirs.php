<?php
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . '/lib/menu.php';
require_once __DIR__ . '/templates/header.php';



$contentPages = [
  [
    'sentence' => 'Entourée de pépites ...',
    'text' => "Quatre jours ressourçants entourée de Pépites, de belles Rencontres et de Surprises ....
  tout ça orchestré par la belle et douce Barbara qui m’inspire : ses mots me nourrissent.
  Quand j'observe le chemin parcouru depuis notre première rencontre, il me tarde d'expérimenter
  la prochaine étape ... intégrer comme en randonnée.
  Merci infiniment",
    'name' => "Marie Pierre",
    'image' => _ASSETS_IMAGE_FOLDER_ . 'food_on_table.jpg'
  ],
  [
    'sentence' => 'Prendre Soin de Soi ...',
    'text' => "Bonjour Barbara,
  J'ai beaucoup apprécié l'ensemble des exercices, le rythme et la variété des sujets abordés,
  tout particulièrement les PPPP, les dessins, la danse....prendre soin de soi.
  Cela correspondait à une période difficile pour moi, de rupture professionnelle dans un contexte
  de conflit de personne. Ces exercices m'ont fait beaucoup de bien et je vais les refaire
  pour en tirer tout le bénéfice.
  Merci encore pour ce beau voyage que vous nous avez proposé, pour se reconnecter à soi-même.
  Bien à vous",
    'name' => "Céline",
    'image' =>  _ASSETS_IMAGE_FOLDER_."tree_sketch.jpg"
  ],
  [
    'sentence' => 'Un des moments les plus forts de ma vie ...',
    'text' => "J’ai fait ce voyage extraordinaire en novembre et c’était un des moments les plus forts
  de ma vie. Le désert est propice à l’introspection et Barbara est un guide exceptionnel.
  J’ai appris à respirer, à être ancrée dans mon corps, à me libérer des tensions,
  à ne plus être dans mon mental mais juste là, à l’écoute des signes de l’univers.
  Je recommande cette aventure hors du commun à 100% !",
    'name' => "Françoise",
    'image' => _ASSETS_IMAGE_FOLDER_."desert_shadows.jpg"
  ],
  [
    'sentence' => "Une Aventure Incroyable à s'offrir ...",
    'text' => "Barbara me relie aux moments précieux vécus dans le désert
  pour m’accueillir, partager, m'écouter, danser, cheminer, me retrouver, ...
  Une aventure incroyable à s’offrir...",
    'name' => "",
    'image' => _ASSETS_IMAGE_FOLDER_."desert_landscape.jpg"
  ],
  [
    'sentence' => "Simplement Respirer ...",
    'text' => "Coucou, merci de ce partage attentionné en plus de ce stage si enrichissant et nourrissant.
  Il m'aura en effet aidée à cela et bien plus encore comme reprendre confiance en moi,
  redéfinir des objectifs et surtout des limites vis à vis de ma famille.
  Je suis en chemin intérieur depuis de longues années. Je reviens déjà de loin,
  et recommence à méditer en pleine conscience
  depuis 2 ans mais à pas de fourmi. Grâce au stage j'ai pu redécouvrir
  que simplement respirer, me détendre, et ressentir du plaisir m'aide à redescendre sur terre!
  Merci de tout ce que tu as transmis et en toute humilité en plus ça j'adore !
  Au plaisir de te revoir à l'occasion d'un stage ou autre !",
    'name' => "Maylis",
    'image' => _ASSETS_IMAGE_FOLDER_."feet_by_the_chemney.jpg"
  ],
  [
    'sentence' => "Décrocher les étoiles ...",
    'text' => "Bonjour Barbara, merci de m'avoir permis de décrocher les étoiles et
  allumer les réverbères pendant ce stage. À ta façon, avec ta personnalité,
  avec ton humour et tes surprises. J'ai adoré ce weekend de partage et de lumière entre femmes
  qui a été subtilement amené avec toute ta féminité, merci infiniment à toi !
  De gros bisous et merci encore.",
    'name' => "Cécile",
    'image' => _ASSETS_IMAGE_FOLDER_."desert_fire.jpg"
  ],
];

?>

<div class="ego row m-auto">
  
  <h1 class="ego-title my-5 text-center">Souvenirs et Témoignages</h1>
  <div class="row front-image">
    <img src="/assets/images/profile_with_the_sun.jpg" alt="women dancing int the desert" class="p-0">
  </div>


  <?php foreach($contentPages as $key => $contentPage) {?>
  <div class="row justify-content-center">
  
    <div class="ego-big-text">
      <h2><?= $contentPage['sentence'];?></h2>
    </div>
    <div class="ego-text col-lg-7 col-sm-12 my-auto">
      <p><?= $contentPage['text']; ?>
      </p>
      <?php if($contentPage['name']){?>
        <p><?= $contentPage['name']?></p>
      <?php } ?>
    </div>
    <div class="ego-img col-md-4 p-0 text-center m-5">
      <?php if($contentPage['image']){?>
      <img src="<?= $contentPage['image']?>" alt="fire in the desert" class="img-fluid">
      <?php } ?>
    </div>
  </div>
  <?php } ?>
  <h2 class="backlinks ego-text my-5 text-center">Liens & Amis</h2>
  <a href="https://www.jacques-lucas.fr/" class="link text-decoration-none custom-text-color text-center" >Le site de Jacques Lucas, référent tantrique</a>
  <a href="https://lartdelamour.fr/" class="link text-decoration-none custom-text-color text-center" >Le site de Carmen & MIchel</a>
</div>


<?php
require_once __DIR__ . '/templates/footer.php';
?>
