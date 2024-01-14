<?php
namespace App\Model;

use App\Service\Config;

class Lesson
{
    private ?int $id = null;

    private ?string $title = null;
    private ?string $content = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Lesson
    {
        $this->id = $id;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }


    public function setContent(?string $content): Lesson
    {
        $this->content = $content;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): Lesson
    {
        $this->title = $title;

        return $this;
    }
    public static function fromArray($array): Lesson
    {
        $lesson = new self();
        $lesson->fill($array);

        return $lesson;
    }

    public function fill($array): Lesson
    {
        if (isset($array['id']) && ! $this->getId()) {
            $this->setId($array['id']);
        }
        if (isset($array['title'])) {
            $this->setTitle($array['title']);
        }
        if (isset($array['content'])) {
            $this->setContent($array['content']);
        }
        return $this;
    }

    public static function findAll(): array
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM lesson';
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $lessons = [];
        $lessonsArray = $statement->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($lessonsArray as $lessonArray) {
            $lessons[] = self::fromArray($lessonArray);
        }

        return $lessons;
    }

    public static function find($id): ?Lesson
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM lesson WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        $lessonArray = $statement->fetch(\PDO::FETCH_ASSOC);
        if (! $lessonArray) {
            return null;
        }
        $lesson = Lesson::fromArray($lessonArray);

        return $lesson;
    }

    public function save(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        if (! $this->getId()) {
            $sql = "INSERT INTO lesson (title, content) VALUES (:title, :content)";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                'title' => $this->getTitle(),
                'content' => $this->getContent(),
            ]);

            $this->setId($pdo->lastInsertId());
        } else {
            $sql = "UPDATE lesson SET title = :title, content = :content WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':title' => $this->getTitle(),
                ':content' => $this->getContent(),
                ':id' => $this->getId(),
            ]);
        }
    }

    public function delete(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = "DELETE FROM lesson WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':id' => $this->getId(),
        ]);

        $this->setId(null);
        $this->setTitle(null);
        $this->setContent(null);
    }
}
