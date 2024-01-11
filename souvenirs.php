<?php
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . '/lib/menu.php';
require_once __DIR__ . '/templates/header.php';



$contentPages = [
  [
    'sentence' => 'Entourée de pépites ...',
    'text' => "Quatre jours ressourçant entourés de Pépites, de belles Rencontres et de Surprises ....
  tous ça orchestré par la belle et douce Barbara qui m’inspire : ses mots me nourrissent.
  Quand j'observe le chemin parcouru depuis notre 1ère rencontre, il me tarde d'expérimenter
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
  de conflits de personne. Ces exercices m'ont fait beaucoup de bien et je vais les refaire
  pour en tirer tout le bénéfice.
  Merci encore pour ce beau voyage que vous nous avez proposé, pour se reconnecter à soi-même.
  Bien à vous",
    'name' => "Céline",
    'image' =>  _ASSETS_IMAGE_FOLDER_."tree_sketch.jpg"
  ],
  [
    'sentence' => 'Un des moments les plus forts de ma vie ...',
    'text' => "J’ai fais ce voyage extraordinaire en novembre et c’était un des moments le plus fort
  de ma vie. Le désert est propice à l’introspection et Barbara est un guide exceptionnel.
  J’ai appris à respirer, à être ancrée dans mon corps, à me libérer des tensions,
  à ne plus être dans mon mental mais juste là, à l’écoute des signes de l’univers.
  Je recommande cette aventure hors du commun à 100% !",
    'name' => "Françoise",
    'image' => _ASSETS_IMAGE_FOLDER_."desert_shadows.jpg"
  ],
  [
    'sentence' => "Une Aventure Incroyable à s'offrir ...",
    'text' => "Magnifique texte Barbara qui me relie aux moments précieux vécus dans le désert
  pour m’accueillir, partager, m'écouter, danser, cheminer, me retrouver, ...
  Une aventure incroyable à s’offrir",
    'name' => "",
    'image' => _ASSETS_IMAGE_FOLDER_."desert_landscape.jpg"
  ],
  [
    'sentence' => "Simplement Respirer ...",
    'text' => "Coucou, merci de ce partage attentionné en plus de ce stage si enrichissant et nourrissant.
  Il m'aura en effet aidé à cela et bien plus encore comme reprendre confiance en moi,
  redéfinir des objectifs et surtout des limites vis à vis de ma famille.
  Je suis en chemin intérieur depuis de longues années. je reviens déjà de loin,
  (7 années de prise de neuroleptiques, passage d'anorexie, tentative de suicides car j'ignorais
  mon hypersensibilité et mes dons mediumniques en plus d'une santé fragile non reconnue 
  par la médecine occidentale. je me remet doucement depuis 6 ans après avoir été dans des dérives
  destructrices ou trop perchées dans l'ésoterisme etc... Et recommence à méditer en pleine conscience
  depuis 2 ans mais à pas de fourmis car cela ouvre mes antennes davantage et que mon ancrage est
  franchement limite comme tu as pu le constater. Grâce au stage j'ai pu redécouvrir
  que simplement respirer, me détendre, et ressentir du plaisir m'aide à redescendre sur terre!
  Merci de tout ce que tu as transmis et en toute humilité en plus ça j'adore !
  Au plaisir de te revoir à l'occasion d'un stage ou autre ! Bisous",
    'name' => "Maylis",
    'image' => _ASSETS_IMAGE_FOLDER_."feet_by_the_chemney.jpg"
  ],
  [
    'sentence' => "Décrocher les étoiles ...",
    'text' => "Bonjour Barbara, merci de m'avoir permise de décrocher les étoiles et
  allumer les réverbères pendant ce stage. À ta façon, avec ta personnalité,
  avec ton humour et tes surprises. J'ai adoré ce weekend de partager et de lumière entre femmes
  qui a été subtilement amené avec toute ta féminité, merci infiniment à toi
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
</div>

<?php
require_once __DIR__ . '/templates/footer.php';
?>