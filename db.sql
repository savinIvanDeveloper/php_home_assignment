CREATE DATABASE IF NOT EXISTS `php_home_assignment` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `php_home_assignment`;

-- LOCATIONS TABLE
CREATE TABLE locations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  building_id INT,
  mapcode INT,
  building VARCHAR(255),
  room VARCHAR(50),
  waze JSON
);

-- DEPARTMENTS TABLE
CREATE TABLE departments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  depbranch JSON,
  section JSON,
  facdiv JSON
);

-- CONTACTS TABLE
CREATE TABLE contacts (
id INT AUTO_INCREMENT PRIMARY KEY,
  n_title VARCHAR(255),
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255),
  person_id VARCHAR(50),
  picture VARCHAR(255),
  emptype JSON,
  workphone JSON,
  location_id INT,
  department_id INT,
  FOREIGN KEY (location_id) REFERENCES locations(id),
  FOREIGN KEY (department_id) REFERENCES departments(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO locations (building_id, mapcode, building, room, waze)
VALUES (
  7,
  5,
  'Stone Administration Building',
  '308',
  '{"building_name":"Stone Building","cord_x":"31.90438","cord_y":"34.80847"}'
);

INSERT INTO departments (depbranch, section, facdiv)
VALUES (
  '{"name":"Communications and Spokesperson Department","url":"http://wis-wander.weizmann.ac.il/"}',
  '{"name":"Social Media Section","url":null}',
  '{"name":"Development and Communications Division","url":null}'
);

INSERT INTO contacts (n_title, name, email, person_id, picture, emptype, workphone, location_id, department_id)
VALUES (
  '',
  'Karen Bar Lev',
  'karenba@weizmann.ac.il',
  '86296',
  '/photos/86296.jpg',
  '["ראש תחום"]',
  '["+972-8-934-3088"]',
  1,
  1
);
