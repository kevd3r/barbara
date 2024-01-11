<?php
function getAllEvents(PDo $pdo, int $limit, int $page): array
{
  $sql = 'SELECT * FROM events ORDER BY date_debut ASC ';
  if ($limit && !$page) {
    $sql .= " LIMIT :limit";
  }
  if ($page) {
    $sql .= " LIMIT :offset, :limit";
  }

  $query = $pdo->prepare($sql);

  if ($limit) {
    $query->bindValue(':limit', $limit, PDO::PARAM_INT);
  }
  if ($page) {
    $offset = ($page - 1) * $limit;
    $query->bindValue(':offset', $offset, PDO::PARAM_INT);
  }
  $query->execute();
  $events = $query->fetchAll(PDO::FETCH_ASSOC);
  return $events;
}


function getEvents(PDO $pdo, int $limit = null, int $page = null): array
{
  $sql = 'SELECT * FROM events WHERE date_fin >= NOW() ORDER BY date_debut ASC ';
  if ($limit && !$page) {
    $sql .= " LIMIT :limit";
  }
  if ($page) {
    $sql .= " LIMIT :offset, :limit";
  }

  $query = $pdo->prepare($sql);

  if ($limit) {
    $query->bindValue(':limit', $limit, PDO::PARAM_INT);
  }
  if ($page) {
    $offset = ($page - 1) * $limit;
    $query->bindValue(':offset', $offset, PDO::PARAM_INT);
  }
  $query->execute();
  $events = $query->fetchAll(PDO::FETCH_ASSOC);
  return $events;
}

function getEventById(PDO $pdo, int $id): array|bool
{
  $sql = 'SELECT * FROM events WHERE id=:id';

  $query = $pdo->prepare($sql);

  $query->bindValue(':id', $id, PDO::PARAM_INT);

  $query->execute();
  $event = $query->fetch(PDO::FETCH_ASSOC);
  return $event;
}

function getEventImage(string|null $image)
{
  if ($image === null) {
    return _ASSETS_IMAGE_FOLDER_ . "article-default.jpg";
  } else {
    return _EVENTS_IMAGES_FOLDER_ . htmlentities($image);
  }
}

function getGender(PDO $pdo, array $event): array|bool
{
  $sql = 'SELECT name FROM gender WHERE id = :genderId';
  $query = $pdo->prepare($sql);
  $query->bindValue(':genderId', $event['gender_id'], PDO::PARAM_STR);
  $query->execute();
  $gender = $query->fetch(PDO::FETCH_ASSOC);
  return $gender;
}

function getCategory(PDO $pdo, array $event): array|bool
{
  $sql = 'SELECT name FROM category WHERE id = :categoryId';
  $query = $pdo->prepare($sql);
  $query->bindValue(':categoryId', $event['category_id'], PDO::PARAM_STR);
  $query->execute();
  $category = $query->fetch(PDO::FETCH_ASSOC);
  return $category;
}

// juste un ajout de fonction pour ne pas avoir à tout péter 
function getCategories($pdo) {
  $sql = 'SELECT * FROM category';
  $query = $pdo->prepare($sql);
  $query->execute();
  
  return $query->fetchAll();
}

function getGenders($pdo) {
  $sql = 'SELECT * FROM gender';
  $query = $pdo->prepare($sql);
  $query->execute();
  
  return $query->fetchAll();
}


function getTotalEvents(PDO $pdo): int
{
  $sql = 'SELECT count(*) AS total FROM events';
  $query = $pdo->prepare($sql);
  $query->execute();
  $result = $query->fetch(PDO::FETCH_ASSOC);
  return $result['total'];
}

function linesToArray(string $string)
{
  return explode(PHP_EOL, $string);
}


function slugify($text, string $divider = '-')
{
  // replace non letter or digits by divider
  $text = preg_replace('~[^\pL\d.]+~u', $divider, $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w.]+~', '', $text);

  // trim
  $text = trim($text, $divider);

  // remove duplicate divider
  $text = preg_replace('~-+~', $divider, $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}


function saveArticle(
  PDO $pdo, 
  string $title,
  int $category_id,
  int $gender_id,
  string $date_debut,
  string $date_fin,
  string $location,
  string $content, 
  ?string $image,
  ?int $id = null
): bool {
    if ($id === null) {
        $query = $pdo->prepare("INSERT INTO events (title, category_id, gender_id, date_debut, date_fin, location, content, image) 
                                VALUES (:title, :category_id, :gender_id, :date_debut, :date_fin, :location, :content, :image)");
    } else {
        $query = $pdo->prepare("UPDATE events SET title = :title, 
                                category_id = :category_id,
                                gender_id = :gender_id,
                                date_debut = :date_debut,
                                date_fin = :date_fin,
                                location = :location,
                                content = :content,
                                image = :image
                                WHERE id = :id");

        $query->bindValue(':id', $id, PDO::PARAM_INT);
    }

    $query->bindValue(':title', $title, PDO::PARAM_STR);
    $query->bindValue(':category_id', $category_id, PDO::PARAM_INT);
    $query->bindValue(':gender_id', $gender_id, PDO::PARAM_INT);
    $query->bindValue(':date_debut', $date_debut, PDO::PARAM_STR);
    $query->bindValue(':date_fin', $date_fin, PDO::PARAM_STR);
    $query->bindValue(':location', $location, PDO::PARAM_STR);
    $query->bindValue(':content', $content, PDO::PARAM_STR);
    $query->bindValue(':image', $image, PDO::PARAM_STR);

    return $query->execute();
}

function deleteEvent(PDO $pdo, int $id):bool
{
    
    $query = $pdo->prepare("DELETE FROM events WHERE id = :id");
    $query->bindValue(':id', $id, $pdo::PARAM_INT);

    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

function formatDate($date){
  return date("d-m-Y", strtotime($date));
}
