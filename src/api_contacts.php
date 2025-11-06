<?php
// src/api_contacts.php
require_once __DIR__ . '/db.php';

function find_contacts_by_name(string $name) {
  $pdo = get_pdo();
    $sql = "
        SELECT 
            c.*,
            l.building_id AS location_building_id,
            l.mapcode AS location_mapcode,
            l.building AS location_building,
            l.room AS location_room,
            l.waze AS location_waze,
            d.depbranch AS department_depbranch,
            d.section AS department_section,
            d.facdiv AS department_facdiv
        FROM contacts c
        LEFT JOIN locations l ON c.location_id = l.id
        LEFT JOIN departments d ON c.department_id = d.id
        WHERE c.name LIKE :name
        ORDER BY c.name
    ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $result = [];
    foreach ($rows as $row) {
        $result[] = [
            'n_title' => $row['n_title'],
            'name' => $row['name'],
            'email' => $row['email'],
            'person_id' => $row['person_id'],
            'picture' => $row['picture'],
            'emptype' => json_decode($row['emptype'], true),
            'workphone' => json_decode($row['workphone'], true),
            'location' => [
                'building_id' => $row['location_building_id'],
                'mapcode' => $row['location_mapcode'],
                'building' => $row['location_building'],
                'room' => $row['location_room'],
                'waze' => json_decode($row['location_waze'], true)
            ],
            'department' => [
                'depbranch' => json_decode($row['department_depbranch'], true),
                'section' => json_decode($row['department_section'], true),
                'facdiv' => json_decode($row['department_facdiv'], true)
            ]
        ];
    }
    return $result;
}
