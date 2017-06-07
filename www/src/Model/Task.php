<?php

namespace Masha\Model;

use Masha\Exception\SimpleException;

class Task extends AbstractModel
{
    const VALID_EXTENSIONS = ['jpg', 'gif', 'png'];
    const DEFAULT_SORT = 'id';
    const DEFAULT_ORDER = 'DESC';

    /**
     * @param string $username
     * @param string $email
     * @param string $content
     * @param array $images
     * @throws SimpleException
     */

    public function create($username, $email, $content, array $images = [])
    {
        $fileCount = isset($images['name']) ? count($images['name']) : 0;
        $preparedImages = [];

        for ($i = 0; $i < $fileCount; $i++) {
            $extension = strtolower(pathinfo($images['name'][$i], PATHINFO_EXTENSION));
            $destination = './uploads/' . $username . '_' . $images['name'][$i];

            if (!in_array($extension, self::VALID_EXTENSIONS)) {
                throw new SimpleException('Not valid extension');
            }

            move_uploaded_file($images['tmp_name'][$i], $destination);

            $preparedImages[] = $destination;
        }

        $serializedImages = serialize($preparedImages);

        $stmt = $this->getPdo()->prepare(
            'INSERT INTO `tasks` (username, email, content, images) VALUES(:username, :email, :content, :images)'
        );
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':content' => $content,
            ':images' => $serializedImages
        ]);
    }

    /**
     * @param int $limit
     * @param int $offset
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getList($limit = 3, $offset = 0, $sort = self::DEFAULT_SORT, $order = self::DEFAULT_ORDER)
    {
        $sort = in_array($sort, ['username', 'email', 'is_completed']) ? $sort : self::DEFAULT_SORT;
        $order = in_array($order, ['ASC', 'DESC']) ? $order : self::DEFAULT_ORDER;

        $stmt = $this->getPdo()->prepare(
            "SELECT * FROM `tasks` ORDER BY $sort $order"
        );

        /**
         * TODO: Implement pagination
         */
//        $stmt->bindValue(':limit', (int)$offset, \PDO::PARAM_INT);
//        $stmt->bindValue(':offset', (int)$limit, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($result as $key => $item) {
            $result[$key]['images'] = (array)unserialize($item['images']);
        }

        return $result;
    }

    public function count()
    {
        $stmt = $this->getPdo()->prepare(
            'SELECT COUNT(*) FROM `tasks`'
        );
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function get($id)
    {
        $stmt = $this->getPdo()->prepare(
            'SELECT * FROM `tasks` WHERE id = :id'
        );
        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $id
     * @param string $content
     */
    public function update($id, $content)
    {
        $stmt = $this->getPdo()->prepare(
            'UPDATE `tasks` SET content=:content WHERE id=:id'
        );

        $stmt->execute([
            ':id' => $id,
            ':content' => $content
        ]);
    }

    public function mark($id)
    {
        $stmt = $this->getPdo()->prepare(
            'UPDATE `tasks` SET is_completed = 1 WHERE id=:id'
        );
        $stmt->execute([
            ':id' => $id,
        ]);
    }
}
